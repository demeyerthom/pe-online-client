<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26-1-17
 * Time: 22:18
 */

namespace Demeyerthom\PeOnline\Tests\Service;


use Demeyerthom\PeOnline\Exceptions\ChunkSizeTooLargeException;
use Demeyerthom\PeOnline\Service;
use PHPUnit\Framework\TestCase;

class ServiceConstructorTest extends TestCase
{
    public function testToLargeChunks(){
        $this->expectException(ChunkSizeTooLargeException::class);
        new Service([], 1000);
    }

}