<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 16:33
 */

namespace Demeyerthom\PeOnline;

use Demeyerthom\PeOnline\Interfaces\ParserInterface;
use Demeyerthom\PeOnline\Interfaces\SummaryInterface;
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
    public function createRequestString(array $settings, array $attendances)
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
                (!$value instanceof \DateTime) ?: $value = $value->format(DATE_ATOM);
                (empty($value)) ?: $element = $xml->createElement($key, $value);
                $attendanceElement->appendChild($element);
            }
            $entry->appendChild($attendanceElement);
        }
        $xml->appendChild($entry);
        return $xml->saveXML();

    }

    /**
     * @param string $summaryString
     * @param SummaryInterface|null $summary
     * @return SummaryInterface
     */
    public function parseSummary(string $summaryString, SummaryInterface $summary = null): SummaryInterface
    {
        if (!isset($summary)) {
            $summary = $this->factory->create(Summary::class);
        }
        $response = simplexml_load_string($summaryString);

        foreach ($response->Error as $errorElement) {
            $error = $this->factory->create(Error::class, [
                'errorMsg' => (string)$errorElement->errorMsg,
                'errorNR' => (string)$errorElement->errorNr
            ]);
            $summary->addError($error);
        }

        foreach ($response->Accepted as $acceptedElement) {
            $accepted = $this->factory->create(Accepted::class, [
                'course' => (string)$acceptedElement->course,
                'date' => (string)$acceptedElement->date,
                'person' => (string)$acceptedElement->person
            ]);
            $summary->addAccepted($accepted);
        }

        return $summary;
    }

}