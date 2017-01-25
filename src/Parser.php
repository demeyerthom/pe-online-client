<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 16:33
 */

namespace Demeyerthom\PeOnline;

use Demeyerthom\PeOnline\Interfaces\ParserInterface;
use Demeyerthom\PeOnline\Models\Accepted;
use Demeyerthom\PeOnline\Models\Error;
use Demeyerthom\PeOnline\Models\Results;
use Demeyerthom\PeOnline\Models\Summary;

class Parser implements ParserInterface
{
    /**
     * @var ModelFactory
     */
    protected $factory;

    /**
     * Parser constructor.
     * @param ModelFactory|null $factory
     */
    public function __construct(ModelFactory $factory = null)
    {
        $this->factory = (!empty($factory)) ? $factory : new ModelFactory();
    }

    /**
     * @param array $settings
     * @param $attendances
     * @return string
     */
    public function createRequestString(array $settings, $attendances)
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
            foreach ($attendance->toArray() as $key => $value) {
                $element = $xml->createElement($key, $value);
                $attendanceElement->appendChild($element);
            }
            $entry->appendChild($attendanceElement);
        }
        $xml->appendChild($entry);
        return $xml->saveXML();

    }

    /**
     * @param string $summaryString
     * @return Summary
     */
    public function parseSummary(string $summaryString): Summary
    {
        $response = simplexml_load_string($summaryString);
        $summary = $this->factory->create(Summary::class);

        $results = $this->factory->create(Results::class, (array) $response->Results);
        $summary->results = $results;

        foreach ($response->Error as $errorElement) {
            $error = $this->factory->create(Error::class, [
                'errorMsg' => (string)$errorElement->errorMsg,
                'errorNR' => (string)$errorElement->errorNr
            ]);
            $summary->errors[] = $error;
        }

        foreach ($response->Accepted as $acceptedElement) {
            $accepted = $this->factory->create(Accepted::class, [
                'course' => (string)$acceptedElement->course,
                'date' => (string)$acceptedElement->date,
                'person' => (string)$acceptedElement->person
            ]);
            $summary->accepted[] = $accepted;
        }

        return $summary;
    }

}