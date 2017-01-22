<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 16:33
 */

namespace Demeyerthom\PeOnline;


use Demeyerthom\PeOnline\Models\Accepted;
use Demeyerthom\PeOnline\Models\Error;
use Demeyerthom\PeOnline\Models\Results;
use Demeyerthom\PeOnline\Models\Summary;
use Illuminate\Support\Collection;

class Parser
{
    /**
     * @param array $settings
     * @param Collection $attendances
     * @return string
     */
    public function createRequestString(array $settings, Collection $attendances)
    {
        $xml = new \DOMDocument('1.0', 'utf-8');
        $entry = $xml->createElement('Entry');

        $settingsElement = $xml->createElement('Settings');
        foreach ($settings as $key => $value) {
            $element = $xml->createElement($key, $value);
            $settingsElement->appendChild($element);
        }
        $entry->appendChild($settingsElement);

        foreach ($attendances as $attendance) {
            $attendanceElement = $xml->createElement('Attendance');
            foreach ($attendance as $key => $value) {
                $element = $xml->createElement($key, $value);
                $attendanceElement->appendChild($element);
            }
            $entry->appendChild($attendanceElement);
        }
        $xml->appendChild($entry);
        return $xml->saveXML();

    }

    public function parseSummary(string $summaryString): Summary
    {
        $response = simplexml_load_string($summaryString);
        $summary = ModelFactory::create(Summary::class);

        $results = ModelFactory::create(Results::class);
        if (isset($summary->Results)) {
            foreach ($summary->Results as $name => $value) {
                $results->$name = $value;
            }
        }
        $summary->results = $results;

        foreach ($response->Error as $errorElement) {
            $error = ModelFactory::create(Error::class);
            $error->errorMsg = (string)$errorElement->errorMsg;
            $error->errorNR = (string)$errorElement->errorNr;
            $summary->errors[] = $error;
        }

        foreach ($response->Accepted as $acceptedElement) {
            $accepted = ModelFactory::create(Accepted::class);
            $accepted->course = (string)$acceptedElement->course;
            $accepted->date = (string)$acceptedElement->date;
            $accepted->person = (string)$acceptedElement->person;
            $summary->accepted[] = $accepted;
        }

        return $summary;
    }

}