<?php declare(strict_types=1);

namespace App\Repository\Contract;

use App\Entity\Channel;
use App\Entity\Listing;

interface ListingRepositoryInterface
{
    /**
     * @return array
     */
    public function findAll(): array;

    /**
     * @param array $criteria
     *
     * @return Listing|null
     */
    public function findOneBy(array $criteria): ?Listing;

    /**
     * @param array               $item
     * @param Channel $channel
     *
     * @return mixed
     */
    public function updateOrCreate(array $item, Channel $channel);

    /**
     * @param array               $items
     * @param Channel $channel
     *
     * @return mixed
     */
    public function updateOrCreateBulk(array $items, Channel $channel);
}
