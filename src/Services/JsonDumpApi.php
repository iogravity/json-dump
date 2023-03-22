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
     * @param int|string $identifier
     * @return Dump
     */
    public function find($identifier)
    {
        try {
            $response = $this->client->request('GET', "dumps/{$identifier}")->getBody()->getContents();

            return Dump::fetch($response);
        } catch (ClientException $e) {
            return Dump::fetch($e->getResponse()->getBody()->getContents());
        }
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
        try {
            $json = json_decode($json, 1);
            $request['json'] = $json;
            $request['name'] = $name;
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
     * @param int|string $identifier
     * @param string|null $updateName
     * @return Dump
     */
    public function update(string $json, $identifier, string $updateName = null)
    {
        try {
            $json = json_decode($json, 1);
            $request['json'] = $json;
            if ($updateName) {
                $request['name'] = $updateName;
            }
            $response = $this->client->request('PUT', "dumps/{$identifier}", [
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
     * @param int|string $identifier
     * @return Dump
     */
    public function delete($identifier)
    {
        try {
            $response = $this->client->request('DELETE', "dumps/{$identifier}")->getBody()->getContents();

            return Dump::fetch($response);
        } catch (ClientException $e) {
            return Dump::fetch($e->getResponse()->getBody()->getContents());
        }
    }
}
