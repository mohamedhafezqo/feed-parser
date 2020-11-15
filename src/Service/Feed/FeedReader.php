<?php declare(strict_types = 1);

namespace App\Service\Feed;

use App\Service\Feed\Contract\FeedReaderInterface;
use App\Service\Feed\Contract\FormatterFactoryInterface;
use App\Service\Parser\Contract\ParserInterface;
use App\Service\Feed\Formatters\Contract\FormatterInterface;

/**
 * Class FeedReader
 *
 * @package App\Service\FeedReader
 */
class FeedReader implements FeedReaderInterface
{
    private FormatterInterface $formatter;

    private FormatterFactoryInterface $formatterFactory;

    private ParserInterface $parser;

    /**
     * FeedReader constructor.
     *
     * @param FormatterFactoryInterface $formatterFactory
     * @param ParserInterface           $parser
     */
    public function __construct(ParserInterface $parser, FormatterFactoryInterface $formatterFactory)
    {
        $this->parser = $parser;
        $this->formatterFactory = $formatterFactory;
    }

    /**
     * @inheritDoc
     */
    public function read(string $url): FeedReaderInterface
    {
        $response = $this->parser->parse($url);
        $this->formatter = $this->formatterFactory->create($this->parser->getType(), $response);

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
        return $this->formatter->getChannel();
    }

    /**
     * @return mixed
     */
    public function getEntities()
    {
        return $this->formatter->getEntities();
    }
}
