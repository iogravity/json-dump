<?php

use JsonDump\JsonDumpClient;
use PHPUnit\Framework\TestCase;

class JsonDumpTest extends TestCase
{
    private $jsonDump;

    private $dumpId;

    protected function setUp(): void
    {
        $this->jsonDump = JsonDumpClient::init('');
    }

    public function testCreateDumpSuccess()
    {
        $response = $this->jsonDump->create(json_encode(["test" => "tt"]), "json_one");
        $this->assertTrue($response->isError === false);

        return $response->data['id'];
    }

    public function testCreateDumpFailure()
    {
        $response = $this->jsonDump->create(json_encode([]), "json_one");

        $this->assertTrue($response->isError === true);
    }

    public function testGetDumpsSuccess()
    {
        $response = $this->jsonDump->get();
        $this->assertTrue($response->isError === false);
    }

    /**
     * @depends testCreateDumpSuccess
     */
    public function testFindDumpSuccess($id)
    {
        $response = $this->jsonDump->find($id);
        $this->assertTrue($response->isError === false);
    }

    public function testFindDumpFailure()
    {
        $response = $this->jsonDump->find(999999999999999);
        $this->assertTrue($response->isError === true);
    }

    /**
     * @depends testCreateDumpSuccess
     */
    public function testUpdateDumpSuccess($id)
    {
        $response = $this->jsonDump->update(json_encode(["test" => "updated"]), $id);
        $this->assertTrue($response->isError === false);
    }

    /**
     * @depends testCreateDumpSuccess
     */
    public function testUpdateDumpFailure($id)
    {
        $response = $this->jsonDump->update(json_encode([]), $id);
        $this->assertTrue($response->isError === true);
    }

    /**
     * @depends testCreateDumpSuccess
     * @depends testUpdateDumpSuccess
     * @depends testFindDumpSuccess
     */
    public function testDeleteDumpSuccess($id)
    {
        $response = $this->jsonDump->delete($id);
        $this->assertTrue($response->isError === false);
    }

    public function testDeleteDumpFailure()
    {
        $response = $this->jsonDump->delete(99999999999999999);
        $this->assertTrue($response->isError === true);
    }
}
