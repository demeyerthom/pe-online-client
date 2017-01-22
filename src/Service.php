<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 22-1-17
 * Time: 12:37
 */

namespace Demeyerthom\PeOnline;


use Demeyerthom\PeOnline\Exceptions\AttendanceBatchTooLargeException;
use Demeyerthom\PeOnline\Models\Attendance;
use Demeyerthom\PeOnline\Models\Summary;
use Guzzle\Http\ClientInterface;
use Illuminate\Support\Collection;

class Service
{
    protected $settings;
    protected $client;
    protected $parser;

    public function __construct(array $settings, ClientInterface $client = null, Parser $parser = null)
    {
        $this->client = (!empty($client)) ? $client : new Client();
        $this->parser = (!empty($parser)) ? $parser : new Parser();
        $this->settings = $settings;
    }

    /**
     * @param Attendance[] $attendances
     * @return Summary
     * @throws AttendanceBatchTooLargeException
     */
    public function writeAttendance(array $attendances): Summary
    {
        $attendances = new Collection($attendances);

        if ($attendances->count() > 100) {
            $count = count($attendances);
            throw new AttendanceBatchTooLargeException("This attendance batch is too large ($count given, max of 100 allowed).");
        }

        $xml = $this->parser->createRequestString($this->settings, $attendances);
        $response = $this->client->postAttendance($xml);
        $summary = $this->parser->parseSummary($response->getBody());
        $summary->attendances = $attendances;
        return $summary;
    }

}