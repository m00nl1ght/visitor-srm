<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SecurityMail extends Mailable
{
    use Queueable, SerializesModels;
    public $reportData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reportData)
    {
      $this->reportData = $reportData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from(['address' => 'security-report@claas.com', 'name' => 'Security Report'])->view('emails.reportSecurity');
    }
}
