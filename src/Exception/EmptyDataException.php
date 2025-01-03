<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Exception;

use Exception;

class EmptyDataException extends Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message = "No data found.")
    {
        parent::__construct($message);
    }
}