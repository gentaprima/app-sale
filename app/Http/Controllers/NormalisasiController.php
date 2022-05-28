<?php

namespace App\Http\Controllers;

use App\Models\ModelKriteria;
use App\Models\ModelNormalisasi;
use App\Models\ModelSubkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NormalisasiController extends Controller
{
    public function calcalulateNormalisasi(){
        $dataNilaiAlternatif = DB::table('tbl_nilai_alternatif')
                                ->select('tbl_nilai_alternatif.id','SB1.nilai_bobot AS volume_belanja','SB2.nilai_bobot AS total_belanja','SB3.nilai_bobot AS ekspedisi')
                                ->leftJoin('tbl_users','tbl_nilai_alternatif.id_users','=','tbl_users.id')
                                ->leftJoin('tbl_subkriteria AS SB1','tbl_nilai_alternatif.volume_belanja','=','SB1.id')
                                ->leftJoin('tbl_subkriteria AS SB2','tbl_nilai_alternatif.total_belanja','=','SB2.id')
                                ->leftJoin('tbl_subkriteria AS SB3','tbl_nilai_alternatif.ekspedisi','=','SB3.id')
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
                $nEkspedisi = $n['hasil_normalisasi'][1]['normalisasi'] * $dataKriteria[2]->bobot;
                $pangkatEkspedisi = pow($n['hasil_normalisasi'][2]['normalisasi'], $dataKriteria[2]->bobot);

                $totalNilaiAlternatif = 0.5 * ($nVolumeBelanja + $nTotalBelanja + $nEkspedisi);
                $totalNilaiPangkat = 0.5 * ($pangkatVolumeBelanja * $pangkatTotalBelanja + $pangkatEkspedisi);

                array_push($dataAdd,[
                    'id_nilai_alternatif' => $n['id_nilai_alternatif'],
                    'n_volume_belanja'      => $n['hasil_normalisasi'][0]['normalisasi'],
                    'n_total_belanja'      => $n['hasil_normalisasi'][1]['normalisasi'],
                    'n_ekspedisi'      => $n['hasil_normalisasi'][2]['normalisasi'],
                    'n_total'       => $totalNilaiPangkat + $totalNilaiAlternatif,
                    'date' => date('Y-m-d')
                ]);
            }
            

            ModelNormalisasi::truncate();
            DB::table('tbl_normalisasi')->insert($dataAdd);
            Session::flash('message', 'Berhasil menghitung pelanggan terbaik bulan ini'); 
            Session::flash('icon', 'success'); 
            Session::flash('title', 'Success !'); 
            return redirect()->back()
                            ->withInput();

        }else{
            Session::flash('message', 'Tidak ada yang dihitung.'); 
            Session::flash('icon', 'warning'); 
            Session::flash('title', 'Warning !'); 
            return redirect()->back()
                            ->withInput();
    
        }
    }
}
