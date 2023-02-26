<?php

namespace JsonDump\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use JsonDump\Response\Dump;

class JsonDumpApi
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Constructor
     * @param string $secret
     */
    public function __construct($secret)
    {
        $this->client = new Client([
            'base_uri' => getConfig('jsondump.api_endpoint'),
            'headers' => [
                'X-SECRET' => $secret,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Get all dumps
     *
     * @return Dump
     */
    public function get()
    {
        try {
            $response = $this->client->request('GET', 'dumps')->getBody()->getContents();

            return Dump::fetch($response);
        } catch (ClientException $e) {
            return Dump::fetch($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Find a dump by id
     *
     * @param int $id
     * @return Dump
     */
    public function find(int $id)
    {
        try {
            $response = $this->client->request('GET', "dumps/{$id}")->getBody()->getContents();

            return Dump::fetch($response);
        } catch (ClientException $e) {
            return Dump::fetch($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Create a dump
     *
     * @param string $json
     * @return Dump
     */
    public function create(string $json)
    {
        try {
            $json = json_decode($json, 1);
            $request['json'] = $json;
            $response = $this->client->request('POST', "dumps", [
                'body' => json_encode($request),
            ])->getBody()->getContents();

            return Dump::fetch($response);
        } catch (ClientException $e) {
            return Dump::fetch($e->getResponse()->getBody()->getContents());
        }
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
        try {
            $json = json_decode($json, 1);
            $request['json'] = $json;
            $response = $this->client->request('PUT', "dumps/{$id}", [
                'body' => json_encode($request),
            ])->getBody()->getContents();

            return Dump::fetch($response);
        } catch (ClientException $e) {
            return Dump::fetch($e->getResponse()->getBody()->getContents());
        }
    }

    /**
     * Delete a dump
     *
     * @param int $id
     * @return Dump
     */
    public function delete(int $id)
    {
        try {
            $response = $this->client->request('DELETE', "dumps/{$id}")->getBody()->getContents();

            return Dump::fetch($response);
        } catch (ClientException $e) {
            return Dump::fetch($e->getResponse()->getBody()->getContents());
        }
    }
}
