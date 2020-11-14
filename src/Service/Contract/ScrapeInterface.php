<?php declare(strict_types=1);

namespace App\Service\Contract;

/**
 * Interface ScrapeInterface
 *
 * @package App\Service\Contract
 */
interface ScrapeInterface
{
    /**
     * @param string $url
     *
     * @return mixed
     */
    public function scrape(string $url);
}
