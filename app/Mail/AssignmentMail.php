<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    /** Isinya berupa array:
     * Link kehalaman assignment
     * Judul email
     * Nama penerima(Siswa)
     * Minggu ke
     */
    public $assignment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('jkpdigitalwikrama@gmail.com', 'JKP Digital')
            ->subject("JKP Minggu ke " . $this->assignment->minggu_ke)->view('emails.assignment');
    }
}
