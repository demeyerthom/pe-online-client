<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 21-1-17
 * Time: 11:03
 */

namespace Demeyerthom\PeOnline;

use Demeyerthom\PeOnline\Exceptions\ConnectionException;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Message\Response;

class Client extends \Guzzle\Http\Client
{
    protected static $url = 'https://www.pe-online.org';

    public function __construct($baseUrl = '', $config = null)
    {
        $baseUrl = (empty($baseUrl)) ? self::$url : $baseUrl;

        parent::__construct($baseUrl, $config);
    }

    public function postAttendance(string $xml): Response
    {
        $requestString = 'sXML=' . $xml;
        $request = $this->post('/pe-services/pe-attendanceelearning/WriteAttendance.asmx/ProcessXML', [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Content-Length' => strlen($requestString)
        ], $requestString);

        try {
            return $request->send();
        } catch (BadResponseException $e) {
            throw new ConnectionException($e->getResponse()->getBody(true));
        }
    }


}