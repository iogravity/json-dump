<?php

namespace JsonDump\Response;

class Dump
{
    /**
     * @var string
     */
    public string $status;

    /**
     * @var array|object
     */
    public array|object $data;

    /**
     * @var string
     */
    public string $message;

    /**
     * @var bool
     */
    public bool $isError;

    /**
     * Constructor
     * @param array|object $data
     * @param string $message
     * @param string $status
     * @param bool $isError
     */
    public function __construct($data, $message, $status, $isError)
    {
        $this->isError = $isError;
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
    }

    /**
     * fetch response
     *
     * @param string $response
     * @return Dump
     */
    public static function fetch($response)
    {
        $response = json_decode($response);
        $response->data = (array) $response->data;

        return new self($response->data ? $response->data : [], $response->message, $response->isSuccess ? 'Success' : 'Failure', $response->isSuccess ? false : true);
    }
}
