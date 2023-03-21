<?php

namespace JsonDump;

use JsonDump\Services\JsonDumpApi;

class JsonDumpClient
{
    /**
     * @var JsonDumpApi
     */
    private $jsonDumpApi;

    /**
     * Constructor
     * @param string $secret
     */
    public function __construct(string $secret)
    {
        $this->jsonDumpApi = new JsonDumpApi($secret);
    }

    /**
     * Initialise object
     * @param string $secret
     */
    public static function init(string $secret)
    {
        return new self($secret);
    }

    /**
     * Get all dumps
     *
     * @return Dump
     */
    public function get()
    {
        return $this->jsonDumpApi->get();
    }

    /**
     * Find a dump by id
     *
     * @param int $id
     * @return Dump
     */
    public function find(int $id)
    {
        return $this->jsonDumpApi->find($id);
    }

    /**
     * Create a dump
     *
     * @param string $json
     * @return Dump
     */
    public function create(string $json, string $name)
    {
        return $this->jsonDumpApi->create($json, $name);
    }

    /**
     * Update a dump
     *
     * @param string $json
     * @param int $id
     * @return Dump
     */
    public function update(string $json, int $id)
    {
        return $this->jsonDumpApi->update($json, $id);
    }

    /**
     * Delete a dump
     *
     * @param int $id
     * @return Dump
     */
    public function delete(int $id)
    {
        return $this->jsonDumpApi->delete($id);
    }
}
