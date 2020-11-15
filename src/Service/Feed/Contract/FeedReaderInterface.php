<?php declare(strict_types=1);

namespace App\Service\Feed\Contract;

use App\Service\Parser\Contract\ParserInterface;

/**
 * Class ReaderInterface
 *
 * @package App\Service\FeedReader\Contract
 */
interface FeedReaderInterface
{
    /**
     * @param string $url
     *
     * @return mixed
     */
    public function read(string $url): self;

    /**
     * @param ParserInterface $parser
     *
     * @return mixed
     */
    public function setParser(ParserInterface $parser): self;

    /**
     * @return mixed
     */
    public function getChannel();

    /**
     * @return mixed
     */
    public function getEntities();
}
