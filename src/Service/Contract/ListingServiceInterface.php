<?php declare(strict_types=1);

namespace App\Service\Contract;

use App\Entity\Channel;
use App\Entity\Listing;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface ListingServiceInterface
 *
 * @package App\Service\Contract
 */
interface ListingServiceInterface
{
    /**
     * @param int $page
     * @param int $limit
     *
     * @return PaginationInterface
     */
    public function findAll(int $page = 1, int $limit = 10): PaginationInterface;

    /**
     * @param array $criteria
     *
     * @return Listing|null
     */
    public function findOneBy(array $criteria): ?Listing;

    /**
     * @param array $items
     * @param Channel $channel
     *
     * @return mixed
     */
    public function saveByChannel(array $items, Channel $channel);
}
