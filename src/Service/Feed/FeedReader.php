<?php declare(strict_types = 1);

namespace App\Service\Feed;

use App\Service\Feed\Contract\FeedReaderInterface;
use App\Service\Feed\Contract\ReaderFactoryInterface;
use App\Service\Parser\Contract\ParserInterface;
use App\Service\Feed\Types\Contract\ReaderInterface;

/**
 * Class FeedReader
 *
 * @package App\Service\FeedReader
 */
class FeedReader implements FeedReaderInterface
{
    private ReaderInterface $reader;

    private ReaderFactoryInterface $readerFactory;

    private ParserInterface $parser;

    /**
     * FeedReader constructor.
     *
     * @param ReaderFactoryInterface $readerFactory
     * @param ParserInterface      $parser
     */
    public function __construct(ParserInterface $parser, ReaderFactoryInterface $readerFactory)
    {
        $this->parser = $parser;
        $this->readerFactory = $readerFactory;
    }

    /**
     * @inheritDoc
     */
    public function read(string $url): FeedReaderInterface
    {
        $response = $this->parser->parse($url);
        $this->reader = $this->readerFactory->create($this->parser->getType(), $response);

        return $this;
    }

    /**
     * @param ParserInterface $parser
     *
     * @return FeedReaderInterface
     */
    public function setParser(ParserInterface $parser): FeedReaderInterface
    {
        $this->parser = $parser;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->reader->getChannel();
    }

    /**
     * @return mixed
     */
    public function getEntities()
    {
        return $this->reader->getEntities();
    }
}
