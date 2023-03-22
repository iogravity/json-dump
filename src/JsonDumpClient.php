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
     * @param int|string $identifier
     * @return Dump
     */
    public function find($identifier)
    {
        return $this->jsonDumpApi->find($identifier);
    }

    /**
     * Create a dump
     *
     * @param string $json
     * @param string $name
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
     * @param int|string $identifier
     * @param string|null $updateName
     * @return Dump
     */
    public function update(string $json, $identifier, string $updateName = null)
    {
        return $this->jsonDumpApi->update($json, $identifier, $updateName);
    }

    /**
     * Delete a dump
     *
     * @param int|string $identifier
     * @return Dump
     */
    public function delete($identifier)
    {
        return $this->jsonDumpApi->delete($identifier);
    }
}
