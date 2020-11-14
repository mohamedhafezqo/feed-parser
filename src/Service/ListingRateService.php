<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Listing;
use App\Repository\Contract\RateRepositoryInterface;
use App\Service\Constant\RateConstant;
use App\Service\Contract\ListingServiceInterface;
use App\Service\Contract\RateServiceInterface;
use App\Exception\InputMismatchException;
use App\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ListingRateService
 *
 * @package App\Service
 */
class ListingRateService implements RateServiceInterface
{
    private RateRepositoryInterface $repository;

    private ListingServiceInterface $listingService;

    /**
     * ListingRateService constructor.
     *
     * @param RateRepositoryInterface $repository
     * @param ListingServiceInterface $listingService
     */
    public function __construct(RateRepositoryInterface $repository, ListingServiceInterface $listingService)
    {
        $this->repository = $repository;
        $this->listingService = $listingService;
    }

    /**
     * @param int    $listingId
     * @param string $userIp
     * @param int    $rate
     *
     * @return mixed|void
     *
     * @throws NotFoundException
     * @throws InputMismatchException
     */
    public function rate(int $listingId, string $userIp, int $rate)
    {
        $listing = $this->getListingById($listingId);
        $this->validateRate($rate);

        $this->repository->updateOrCreate($listing, $userIp, $rate);
    }

    /**
     * @param int $id
     *
     * @return Listing
     * @throws NotFoundException
     */
    protected function getListingById(int $id): Listing
    {
        $listing = $this->listingService->findOneBy(['id' => $id]);

        if (!$listing) {
            throw new NotFoundException('Not Found Listing', Response::HTTP_NOT_FOUND);
        }

        return $listing;
    }

    /**
     * @param int $rate
     *
     * @throws InputMismatchException
     */
    protected function validateRate(int $rate)
    {
        if (!in_array($rate, RateConstant::RANKS)) {
            throw new InputMismatchException($rate);
        }
    }
}
