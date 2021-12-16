<?php

namespace App\Exception;

class MissingException extends \RuntimeException
{

    /**
     * @var array
     */
    private $error;

    /**
     * @param array $error
     */
    public function __construct(array $error)
    {
        parent::__construct('Parsing Error');
        $this->error = $error;
    }

    public function getError(): array
    {
        return $this->error;
    }
}