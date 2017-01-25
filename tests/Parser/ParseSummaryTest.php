<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25-1-17
 * Time: 19:34
 */

namespace Demeyerthom\PeOnline\Tests\Parser;


use Demeyerthom\PeOnline\Models\Summary;
use Demeyerthom\PeOnline\Tests\PETestCase;

class ParseSummaryTest extends PETestCase
{
    public function testCorrectParseSummary()
    {
        $parser = $this->getParser();
        $xml = file_get_contents(__DIR__ . '/../../resources/response-example.xml');
        $summary = $parser->parseSummary($xml);
        $this->assertInstanceOf(Summary::class, $summary);
    }

}