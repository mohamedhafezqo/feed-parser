<?php declare(strict_types=1);

namespace App\Test\Unit\Feed;

use App\Service\Feed\Contract\FormatterFactoryInterface;
use App\Service\Feed\FeedReader;
use App\Service\Feed\Formatters\Contract\FormatterInterface;
use App\Service\Parser\Contract\ParserInterface;
use PHPUnit\Framework\TestCase;

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
        $readerFactory = $this->createMock(FormatterFactoryInterface::class);
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
        $reader = $this->createMock(FormatterInterface::class);
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
