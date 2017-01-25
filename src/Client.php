<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 11:03
 */

namespace Demeyerthom\PeOnline;

use Demeyerthom\PeOnline\Exceptions\ConnectionException;
use Demeyerthom\PeOnline\Interfaces\ClientInterface;
use Guzzle\Http\Exception\BadResponseException;

class Client extends \Guzzle\Http\Client implements ClientInterface
{
    /**
     * @var string
     */
    protected static $url = 'https://www.pe-online.org';

    /**
     * Client constructor.
     * @param string $baseUrl
     * @param null $config
     */
    public function __construct($baseUrl = '', $config = null)
    {
        $baseUrl = (empty($baseUrl)) ? self::$url : $baseUrl;

        parent::__construct($baseUrl, $config);
    }

    /**
     * @param string $xml
     * @return string
     * @throws ConnectionException
     */
    public function postAttendance(string $xml) : string
    {
        $requestString = 'sXML=' . $xml;
        $request = $this->post('/pe-services/pe-attendanceelearning/WriteAttendance.asmx/ProcessXML', [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Content-Length' => strlen($requestString)
        ], $requestString);

        try {
            return $request->send()->getBody();
        } catch (BadResponseException $e) {
            throw new ConnectionException($e->getResponse()->getBody(true));
        }
    }


}