<?php declare(strict_types=1);

namespace App\Test\Unit\Feed;

use App\Service\Feed\Contract\ReaderFactoryInterface;
use App\Service\Feed\FeedReader;
use App\Service\Feed\ReaderFactory;
use App\Service\Feed\Types\AtomReader;
use App\Service\Feed\Types\Contract\ReaderInterface;
use App\Service\Parser\Contract\ParserInterface;
use App\Service\Parser\XmlParser;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FeedReaderTest extends TestCase
{
    public function testRead()
    {
        $parser = $this->getParserMock();
        $factory = $this->getReaderFactoryMock();

        $feedReader = new FeedReader($parser, $factory);
        $feedReader->read('https://xmls.io');

        $this->assertIsArray($feedReader->getChannel());
        $this->assertIsArray($feedReader->getEntities());
    }

    /**
     * @param \PHPUnit\Framework\MockObject\MockObject $response
     *
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function getParserMock(): \PHPUnit\Framework\MockObject\MockObject
    {
        $parser = $this->createMock(ParserInterface::class);

        $parser
            ->expects($this->once())
            ->method('parse')
            ->withAnyParameters()
            ->willReturn(new \SimpleXMLElement('<root />'))
        ;
        return $parser;
    }

    public function getReaderFactoryMock()
    {
        $reader = $this->getReaderMock();
        $readerFactory = $this->createMock(ReaderFactoryInterface::class);
        $readerFactory
            ->expects($this->once())
            ->method('create')
            ->withAnyParameters()
            ->willReturn($reader)
        ;

        return $readerFactory;
    }

    public function getReaderMock()
    {
        $reader = $this->createMock(ReaderInterface::class);
        $reader
            ->expects($this->once())
            ->method('getChannel')
            ->willReturn([])
        ;

        $reader
            ->expects($this->once())
            ->method('getEntities')
            ->willReturn([])
        ;

        return $reader;
    }
}
