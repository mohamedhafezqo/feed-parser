<?php declare(strict_types=1);

namespace App\Service;

use App\Service\Contract\ChannelServiceInterface;
use App\Service\Contract\ListingServiceInterface;
use App\Service\Contract\ScrapeInterface;
use App\Service\Feed\Contract\FeedReaderInterface;

/**
 * Class ScrapeService
 *
 * @package App\Service
 */
class ScrapeService implements ScrapeInterface
{
    protected FeedReaderInterface $feedReader;

    protected ChannelServiceInterface $channelService;

    protected ListingServiceInterface $listingService;

    /**
     * ScrapeService constructor.
     *
     * @param FeedReaderInterface $feedReader
     * @param ChannelServiceInterface $channelService
     * @param ListingServiceInterface  $listingService
     */
    public function __construct(FeedReaderInterface $feedReader, ChannelServiceInterface $channelService, ListingServiceInterface $listingService)
    {
        $this->feedReader = $feedReader;
        $this->channelService = $channelService;
        $this->listingService = $listingService;
    }

    /**
     * @param string $url
     *
     * @return mixed|void
     */
    public function scrape(string $url)
    {
        $reader = $this->feedReader->read($url);
        $channel = $this->channelService->findOrCreate($reader->getChannel());
        $this->listingService->saveByChannel($reader->getEntities(), $channel);
    }
}
