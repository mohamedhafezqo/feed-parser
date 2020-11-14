<?php declare(strict_types=1);

namespace App\Repository\Contract;

use App\Entity\Listing;
use App\Entity\ListingRate;

interface RateRepositoryInterface
{
    /**
     * @param Listing $listing
     * @param string $userIp
     * @param int $rate
     *
     * @return mixed
     */
    public function updateOrCreate(Listing $listing, string $userIp, int $rate);

    /**
     * @param array $criteria
     *
     * @return ListingRate|null
     */
    public function findOneBy(array $criteria): ?ListingRate;
}
