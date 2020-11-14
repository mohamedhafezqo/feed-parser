<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Channel;
use App\Entity\Listing;
use App\Repository\Contract\ListingRepositoryInterface;
use App\Service\Contract\ListingServiceInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class ListingService
 *
 * @package App\Service
 */
class ListingService implements ListingServiceInterface
{
    private ListingRepositoryInterface $repository;

    private PaginatorInterface $paginator;

    /**
     * ListingService constructor.
     *
     * @param ListingRepositoryInterface $listingRepository
     * @param PaginatorInterface $paginator
     */
    public function __construct(ListingRepositoryInterface $listingRepository, PaginatorInterface $paginator)
    {
        $this->repository = $listingRepository;
        $this->paginator = $paginator;
    }

    /**
     * @param int $page
     * @param int $limit
     *
     * @return PaginationInterface
     */
    public function findAll(int $page = 1, int $limit = 10): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->repository->findAll(),
            $page,
            $limit
        );
    }

    /**
     * @param array $criteria
     *
     * @return Listing|null
     */
    public function findOneBy(array $criteria): ?Listing
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * @param array $items
     * @param Channel $channel
     */
    public function saveByChannel(array $items, Channel $channel)
    {
        $this->repository->updateOrCreateBulk($items, $channel);
    }
}
