<?php

namespace App\Exceptions;

use App\Mail\ExceptionOccured;
use Exception;
use Illuminate\Http\JsonResponse;

class CommentException extends Exception
{
    protected $reportable;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null, $reportable = true)
    {
        parent::__construct($message, $code, $previous);
        $this->reportable = $reportable;
    }

    public function report()
    {
        if ($this->reportable) {
            \Log::error('CommentService: ' . $this->getMessage());
            \Mail::to('mj8667941@gmail.com')->send(new ExceptionOccured($this));
        }
    }

    public function render(): JsonResponse
    {
        return new JsonResponse([
            'message' => $this->getMessage(),
        ], $this->code);
    }
}
