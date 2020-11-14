<?php declare(strict_types=1);

namespace App\Service\Contract;

/**
 * Interface ListingServiceInterface
 *
 * @package App\Service\Contract
 */
interface ChannelServiceInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function findOrCreate(array $data);
}
