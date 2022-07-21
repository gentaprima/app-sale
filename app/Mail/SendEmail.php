<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$type = null)
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   if($this->type != null){
            return $this->from('2kiddoz@redmilkproject.com','2Kiddoz')
            ->subject('Pemberitahuan Pemenang')
            ->view('email-winner')
            ->with(
            [
                'nama' => $this->data->full_name,
                'email' => $this->data->email,
                'bulan' => $this->data->bulan,
                'tahun' => $this->data->tahun
            ]);
         }else{
            return $this->from('2kiddoz@redmilkproject.com','2Kiddoz')
            ->subject('Pemberitahuan')
            ->view('view-email')
            ->with(
            [
                'nama' => $this->data->fullName,
                'email' => $this->data->email,
            ]);
         }
    }
}
