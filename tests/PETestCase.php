<?php

namespace Demeyerthom\PeOnline\Tests;

use Demeyerthom\PeOnline\Client;
use Demeyerthom\PeOnline\Interfaces\ClientInterface;
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

        $entry = new \DOMDocument();
        $entry->loadXML(file_get_contents(__DIR__ . '/../resources/entry-example.xml'));
        $entry->normalizeDocument();
        $xml = preg_replace('~>\s+<~', '><', $entry->saveXML());

        $client = $this->getMockBuilder(Client::class)->setMethods(['postAttendance'])->getMock();
        $client->expects($this->any())
            ->method('postAttendance')
            ->with('<?xml version="1.0" encoding="utf-8"?>
<Entry><Settings><userID>1</userID><userRole>EDU</userRole><userKey>secret</userKey><orgID>19</orgID><settingOutput>1</settingOutput><emailOutput>test@test.nl</emailOutput><languageID>1</languageID><defaultLanguageID>1</defaultLanguageID></Settings><Attendance><PECourseID>9471</PECourseID><externalPersonID>39054148101</externalPersonID><externalmoduleID>Module_A</externalmoduleID><endDate>2008-06-09T13:08:13+02:00</endDate></Attendance><Attendance><PECourseID>8001</PECourseID><externalPersonID>39054148101</externalPersonID><endDate>2008-06-08T13:08:13+02:00</endDate></Attendance><Attendance><PECourseID>8001</PECourseID><externalPersonID>59059671101</externalPersonID><endDate>2008-06-08T13:08:13+02:00</endDate></Attendance></Entry>')
            ->willReturn($this->returnValue(file_get_contents(__DIR__ . '/../resources/response-example.xml')));
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