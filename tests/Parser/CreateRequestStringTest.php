<?php

use \PHPUnit\Framework\TestCase;
use \Demeyerthom\PeOnline\Parser;

/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25-1-17
 * Time: 15:10
 */
class CreateRequestStringTest extends TestCase
{
    protected $settings = [
        'userID' => 1,
        'userRole' => 'EDU',
        'userKey' => 'secret',
        'orgID' => 19,
        'settingOutput' => 0,
        'emailOutput' => '',
        'languageID' => 1,
        'defaultLanguageID' => 1
    ];

    public function testCorrectRequest()
    {
        $parser = new Parser();

        $parser->createRequestString(
            $this->settings,
            new \Illuminate\Support\Collection([
                \Demeyerthom\PeOnline\ModelFactory::create()
            ])
        );


    }

}