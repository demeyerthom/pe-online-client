<?php

namespace Demeyerthom\PeOnline\Tests\Parser;

use Demeyerthom\PeOnline\Models\Attendance;
use Demeyerthom\PeOnline\Tests\PETestCase;
use Illuminate\Support\Collection;

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25-1-17
 * Time: 18:55
 */
class CreateRequestStringTest extends PETestCase
{
    public function testCorrectRequestStringCreation()
    {
        $parser = $this->getParser();
        $factory = $this->getModelFactory();
        $settings = [
            'userID' => 1,
            'userRole' => 'EDU',
            'userKey' => 'secret',
            'orgID' => 19,
            'settingOutput' => 1,
            'emailOutput' => 'test@test.nl',
            'languageID' => 1,
            'defaultLanguageID' => 1
        ];

        $attendances = new Collection(
            $factory->createMultiple(Attendance::class, [
                [
                    'PECourseID' => 9471,
                    'externalPersonID' => 39054148101,
                    'externalmoduleID' => 'Module_A',
                    'endDate' => '2008-06-09T13:08:13.0000000+02:00'
                ],
                [
                    'PECourseID' => 8001,
                    'externalPersonID' => 39054148101,
                    'endDate' => '2008-06-08T13:08:13.0000000+02:00'
                ],
                [
                    'PECourseID' => 8001,
                    'externalPersonID' => 59059671101,
                    'endDate' => '2008-06-08T13:08:13.0000000+02:00'
                ]
            ])
        );
        $xml = $parser->createRequestString($settings, $attendances);
        $this->assertXmlStringEqualsXmlFile(__DIR__ . '/../../resources/entry-example.xml', $xml);
    }
}