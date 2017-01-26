<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 22-1-17
 * Time: 12:37
 */

namespace Demeyerthom\PeOnline;


use Demeyerthom\PeOnline\Exceptions\ChunkSizeTooLargeException;
use Demeyerthom\PeOnline\Interfaces\ClientInterface;
use Demeyerthom\PeOnline\Interfaces\ParserInterface;
use Demeyerthom\PeOnline\Interfaces\SummaryInterface;

class Service
{
    /**
     * @var array
     */
    protected $settings;

    /**
     * @var
     */
    protected $chunk_size;
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
    public function __construct(array $settings, $chunk_size = 100, ClientInterface $client = null, ParserInterface $parser = null)
    {
        if ($chunk_size > 100) {
            throw new ChunkSizeTooLargeException("The chunksize must be smaller than 100. $chunk_size given");
        }
        $this->chunk_size = $chunk_size;
        $this->client = (!empty($client)) ? $client : new Client();
        $this->parser = (!empty($parser)) ? $parser : new Parser();
        $this->settings = $settings;
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function getChunkSize()
    {
        return $this->chunk_size;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getParser()
    {
        return $this->parser;
    }

    /**
     * @param array $attendances
     * @return SummaryInterface
     * @throws ChunkSizeTooLargeException
     */
    public function writeAttendance(array $attendances): SummaryInterface
    {
        $chunks = array_chunk($attendances, 100);

        $summary = null;

        foreach ($chunks as $chunk) {
            $xml = $this->parser->createRequestString($this->settings, $chunk);
            $response = $this->client->postAttendance($xml);
            $summary = $this->parser->parseSummary($response, $summary);
        }

        return $summary;
    }

}