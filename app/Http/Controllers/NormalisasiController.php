<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\ModelKriteria;
use App\Models\ModelNormalisasi;
use App\Models\ModelSubkriteria;
use App\Models\ModelWinner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NormalisasiController extends Controller
{
    public function calcalulateNormalisasi(Request $request){

        $splitMonth = explode('-',$request->month);
        $cekDataPemenang =  DB::table('tbl_pemenang')
                        ->where('bulan',$splitMonth[1])
                        ->where('tahun',$splitMonth[0])
                        ->first();

        $cekDataHadiah =  DB::table('tbl_hadiah')
                        ->where('bulan',$splitMonth[1])
                        ->where('tahun',$splitMonth[0])
                        ->first();
        
        if($cekDataPemenang != null){
            Session::flash('message', 'Data pemenang untuk bulan dan tahun tersebut sudah dihitung'); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Success !'); 
            return redirect()->back()
                            ->withInput();
        }
        
        if($cekDataHadiah == null){
            Session::flash('message', 'Data Hadiah bulan dan tahun tersebut belum ada, silahkan tambahkan terlebih dahulu'); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Success !'); 
            return redirect()->back()
                            ->withInput();
        }

        $dataNilaiAlternatif = DB::table('tbl_nilai_alternatif')
                                ->select('tbl_nilai_alternatif.id','SB1.nilai_bobot AS volume_belanja','SB2.nilai_bobot AS total_belanja','SB3.nilai_bobot AS ekspedisi','SB4.nilai_bobot AS rating')
                                ->leftJoin('tbl_users','tbl_nilai_alternatif.id_users','=','tbl_users.id')
                                ->leftJoin('tbl_subkriteria AS SB1','tbl_nilai_alternatif.volume_belanja','=','SB1.id')
                                ->leftJoin('tbl_subkriteria AS SB2','tbl_nilai_alternatif.total_belanja','=','SB2.id')
                                ->leftJoin('tbl_subkriteria AS SB3','tbl_nilai_alternatif.ekspedisi','=','SB3.id')
                                ->leftJoin('tbl_subkriteria AS SB4','tbl_nilai_alternatif.rating','=','SB4.id')
                                ->get();
                                
        if($dataNilaiAlternatif != null){
            $dataKriteria = ModelKriteria::all();
            $dataKriteriaCost = ModelKriteria::where('jenis','Cost')->get();
            $dataKriteriaBenefit = ModelKriteria::where('jenis','Benefit')->get();


            $hasilMaxDariSetiapAlternatif = [];
            $hasilMinDariSetiapAlternatif = [];

            $nilaiHasilNormalisasi = [];

            //ambil data max dari setiap alternatif (benefit)
            foreach($dataKriteriaBenefit as $benefit){
                $kriteriaName = str_replace(' ', '_', $benefit->kriteria);
                $hasilMax = DB::table('tbl_nilai_alternatif')->max(strtolower($kriteriaName));
                $idSubKriteria = $hasilMax;
                $readDatasubKriteria = DB::table('tbl_subkriteria')->where('id',$idSubKriteria)->first();
                array_push($hasilMaxDariSetiapAlternatif, array(
                    'kriteria' => strtolower($kriteriaName),
                    'id_subkriteria' => $hasilMax,
                    'hasil' => $readDatasubKriteria->nilai_bobot

                ));
            }
            // ambil data min dari setiap alternatif (cost)
            foreach($dataKriteriaCost as $cost){
                $kriteriaName = str_replace(' ', '_', $cost->kriteria);
                $hasilMin = DB::table('tbl_nilai_alternatif')->min(strtolower($kriteriaName));
                $idSubKriteria = $hasilMin;
                $readDatasubKriteria = DB::table('tbl_subkriteria')->where('id',$idSubKriteria)->first();
                array_push($hasilMinDariSetiapAlternatif, array(
                    'kriteria' => strtolower($kriteriaName),
                    'id_subkriteria' => $hasilMin,
                    'hasil' => $readDatasubKriteria->nilai_bobot

                ));
            }

            foreach ($dataNilaiAlternatif as $n) {
                $c = [];
                // mencari nilai normalisasi (benefit)
                foreach ($hasilMaxDariSetiapAlternatif as $hmxdsk) {
                    $bobotKriteriaMax = $hmxdsk['kriteria'];
                    array_push($c, array(
                        'kriteria' => $hmxdsk['kriteria'],
                        'normalisasi' => $n->$bobotKriteriaMax / $hmxdsk['hasil'],
                    ));
                }

                // mencari nilai normalisasi (cost)
                foreach ($hasilMinDariSetiapAlternatif as $hmndsk) {
                    $bobotKriteriaMin = $hmndsk['kriteria'];
                    array_push($c, [
                        'kriteria' => $hmndsk['kriteria'],
                        'normalisasi'    => $hmndsk['hasil'] / $n->$bobotKriteriaMin
                    ]);
                }
                array_push($nilaiHasilNormalisasi, array(
                    'id_nilai_alternatif' => $n->id,
                    'hasil_normalisasi' => $c,
                ));
            }
            $dataAdd = [];
            foreach ($nilaiHasilNormalisasi as $n) {
                
                // volume belanja
                $nVolumeBelanja = $n['hasil_normalisasi'][0]['normalisasi'] * $dataKriteria[0]->bobot;
                $pangkatVolumeBelanja = pow($n['hasil_normalisasi'][0]['normalisasi'], $dataKriteria[0]->bobot);
                // total belanja
                $nTotalBelanja = $n['hasil_normalisasi'][1]['normalisasi'] * $dataKriteria[1]->bobot;
                $pangkatTotalBelanja = pow($n['hasil_normalisasi'][1]['normalisasi'], $dataKriteria[1]->bobot);
                // ekspedisi
                $nEkspedisi = $n['hasil_normalisasi'][3]['normalisasi'] * $dataKriteria[3]->bobot;
                $pangkatEkspedisi = pow($n['hasil_normalisasi'][3]['normalisasi'], $dataKriteria[3]->bobot);

                $nRating = $n['hasil_normalisasi'][2]['normalisasi'] * $dataKriteria[2]->bobot;
                $pangkatRating = pow($n['hasil_normalisasi'][2]['normalisasi'], $dataKriteria[2]->bobot);
                
                $totalNilaiAlternatif = 0.5 * ($nVolumeBelanja + $nTotalBelanja + $nEkspedisi + $nRating);
                $totalNilaiPangkat = 0.5 * ($pangkatVolumeBelanja * $pangkatTotalBelanja + $pangkatEkspedisi + $pangkatRating);

                array_push($dataAdd,[
                    'id_nilai_alternatif' => $n['id_nilai_alternatif'],
                    'n_volume_belanja'      => $n['hasil_normalisasi'][0]['normalisasi'],
                    'n_total_belanja'      => $n['hasil_normalisasi'][1]['normalisasi'],
                    'n_ekspedisi'      => $n['hasil_normalisasi'][3]['normalisasi'],
                    'n_rating'      => $n['hasil_normalisasi'][2]['normalisasi'],
                    'n_total'       => $totalNilaiPangkat + $totalNilaiAlternatif,
                    'date' => date('Y-m-d')
                ]);
            }
            

            ModelNormalisasi::truncate();
            DB::table('tbl_normalisasi')->insert($dataAdd);

            $dataPemenang = DB::table('tbl_normalisasi')
                                ->leftJoin('tbl_nilai_alternatif','tbl_normalisasi.id_nilai_alternatif','=','tbl_nilai_alternatif.id')
                                ->orderBy('n_total','desc')->first();
            ModelWinner::create([
                'id_users'  => $dataPemenang->id_users,
                'bulan'     => $splitMonth[1],
                'tahun'     => $splitMonth[0],
            ]);
            $dataWinner = DB::table('tbl_pemenang')
                            ->leftJoin('tbl_users','tbl_pemenang.id_users','=','tbl_users.id')
                            ->first();
            Mail::to($dataWinner->email)->send(new SendEmail($dataWinner,'reward'));

            Session::flash('message', 'Berhasil menghitung pelanggan terbaik bulan ini'); 
            Session::flash('icon', 'success'); 
            Session::flash('title', 'Success !'); 
            return redirect()->back();
        }else{
            Session::flash('message', 'Tidak ada yang dihitung.'); 
            Session::flash('icon', 'warning'); 
            Session::flash('title', 'Warning !'); 
            return redirect()->back()
                            ->withInput();
    
        }
    }
}
