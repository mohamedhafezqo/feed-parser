<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Listing;
use App\Entity\ListingRate;
use App\Repository\Contract\RateRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class ListingRateRepository
 *
 * @package App\Repository
 */
class ListingRateRepository implements RateRepositoryInterface
{
    private ObjectRepository $repository;

    private EntityManagerInterface $entityManager;

    /**
     * ListingRepository constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository    = $entityManager->getRepository(ListingRate::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @param Listing $listing
     * @param int $rate
     * @param string $userIp
     */
    public function updateOrCreate(Listing $listing, string $userIp, int $rate)
    {
        $listingRate = $this->findOneBy([
            'listing' => $listing,
            'userIp' => $userIp,
        ]);

        if (is_null($listingRate)) {
            $listingRate = new ListingRate();
        }

        $listingRate->setRate($rate)
            ->setListing($listing)
            ->setUserIp($userIp)
        ;

        $this->entityManager->persist($listingRate);
        $this->entityManager->flush();
    }

    /**
     * @param array $criteria
     *
     * @return ListingRate|null
     */
    public function findOneBy(array $criteria): ?ListingRate
    {
        return $this->repository->findOneBy($criteria);
    }
}
