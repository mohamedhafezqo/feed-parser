<?php declare(strict_types=1);

namespace App\Service\Contract;

/**
 * Interface ScrapeInterface
 *
 * @package App\Service\Contract
 */
interface RateServiceInterface
{
    /**
     * @param int  $listingId
     * @param string $userIp
     * @param int    $rate
     *
     * @return mixed
     */
    public function rate(int $listingId, string $userIp, int $rate);
}
