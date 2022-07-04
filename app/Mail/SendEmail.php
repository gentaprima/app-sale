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
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('iuranwarga@yahoo.com','2Kiddoz')
        ->subject('Pemberitahuan')
        ->view('view-email')
        ->with(
         [
             'nama' => $this->data->fullName,
             'email' => $this->data->email,
         ]);
    }
}
