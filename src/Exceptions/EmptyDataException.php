<?php

namespace Imamsudarajat04\LaravelBaseServiceRepo\Exceptions;

use Exception;

class EmptyDataException extends Exception
{
    /**
     * Create a new EmptyDataException instance.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message = "No data found.",
        int $code = 404,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Create a new EmptyDataException for a specific model.
     *
     * @param string $model
     * @param string|int|null $id
     * @return static
     */
    public static function forModel(string $model, string|int|null $id = null): static
    {
        $message = $id 
            ? "No {$model} found with ID: {$id}"
            : "No {$model} records found";

        return new static($message);
    }

    /**
     * Create a new EmptyDataException for a specific column.
     *
     * @param string $model
     * @param string $column
     * @param mixed $value
     * @return static
     */
    public static function forColumn(string $model, string $column, mixed $value): static
    {
        $message = "No {$model} found with {$column}: {$value}";
        
        return new static($message);
    }
}