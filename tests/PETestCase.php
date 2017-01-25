<?php

namespace Demeyerthom\PeOnline\Tests;

use Demeyerthom\PeOnline\Client;
use Demeyerthom\PeOnline\ModelFactory;
use Demeyerthom\PeOnline\Parser;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25-1-17
 * Time: 18:53
 */
class PETestCase extends TestCase
{
    public function getClient($mock = true)
    {
        if (!$mock) {
            return new Client();
        }
        $client = $this->getMockBuilder(Client::class)->getMock();
        $client->expects($this->once())
            ->method('postAttendance')
            ->with(['xml'])
            ->willReturn($this->returnValue(file_get_contents(__DIR__ . '/../../resources/response-example.xml')));
        return $client;
    }

    public function getParser()
    {
        return new Parser($this->getModelFactory());
    }

    public function getModelFactory()
    {
        return new ModelFactory();
    }

}