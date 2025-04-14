<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AttendanceReportMail extends Mailable
{

    protected $filePath;
    protected $period;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($filePath, $period)
    {
        $this->filePath = $filePath;
        $this->period = $period;
    }
   
    public function build()
    {
        return $this->markdown('mail.reports.attendance.attendance-report')->with(
            [
                'filePath' => $this->filePath,
                'downloadUrl' => asset('storage/' . $this->filePath),
                'period' => $this->period,
            ]
            )->attach(storage_path('app/public/'. $this->filePath));
    }
}
