<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 22-1-17
 * Time: 12:37
 */

namespace Demeyerthom\PeOnline;


use Demeyerthom\PeOnline\Exceptions\AttendanceBatchTooLargeException;
use Demeyerthom\PeOnline\Interfaces\ClientInterface;
use Demeyerthom\PeOnline\Interfaces\ParserInterface;
use Demeyerthom\PeOnline\Models\Summary;
use Illuminate\Support\Collection;

class Service
{
    /**
     * @var array
     */
    protected $settings;
    /**
     * @var Client|ClientInterface|null
     */
    protected $client;
    /**
     * @var ParserInterface|Parser|null
     */
    protected $parser;
    /**
     * @var
     */
    protected $factory;

    /**
     * Service constructor.
     * @param array $settings
     * @param ClientInterface|null $client
     * @param ParserInterface|null $parser
     */
    public function __construct(array $settings, ClientInterface $client = null, ParserInterface $parser = null)
    {
        $this->client = (!empty($client)) ? $client : new Client();
        $this->parser = (!empty($parser)) ? $parser : new Parser();
        $this->settings = $settings;
    }

    /**
     * @param array $attendances
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
        $summary = $this->parser->parseSummary($response);
        $summary->attendances = $attendances;
        return $summary;
    }

}