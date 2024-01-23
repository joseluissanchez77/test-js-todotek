<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class NotContentException extends \RuntimeException {

    private $statusCode;
    
    public function __construct(string $message = '', \Throwable $previous = null) {
        $this->statusCode = Response::HTTP_NO_CONTENT;

        parent::__construct($message, $this->statusCode, $previous);
    }

    public function getStatusCode() {
        return $this->statusCode;
    }
}
