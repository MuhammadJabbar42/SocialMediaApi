<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class MessageException extends Exception
{
    public function report()
    {
        
    }
    public function render()
    {
        return new JsonResponse([
            'message'=>$this->getMessage(),
        ],$this->code);
    }    
}
