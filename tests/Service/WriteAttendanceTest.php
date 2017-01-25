<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25-1-17
 * Time: 19:56
 */

namespace Demeyerthom\PeOnline\Tests\Service;


use Demeyerthom\PeOnline\Tests\PETestCase;

class WriteAttendanceTest extends PETestCase
{
    public function testCorrectWriteAttendance(){
        $client = $this->getClient();
        $client->writeAttendance();
    }

}