<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExceptionOccured extends Mailable
{
    use Queueable, SerializesModels;

    protected $exception;
    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    public function build(): self
    {
        return $this->view('exception_report')
            ->subject("An Exception Occurred")
            ->with([
                'exceptionMessage' => $this->exception->getMessage(),
                'exceptionFile' => $this->exception->getFile(),
                'exceptionLine' => $this->exception->getLine(),
                'exceptionTrace' => $this->exception->getTraceAsString(),
                'exceptionPrevious' => $this->exception->getPrevious() ? $this->exception->getPrevious()->getMessage() : null,
            ]);
    }

}
