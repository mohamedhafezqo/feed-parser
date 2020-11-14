<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Channel;
use App\Entity\Listing;
use App\Repository\Contract\ListingRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class ListingRepository
 *
 * @package App\Repository
 */
class ListingRepository implements ListingRepositoryInterface
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
        $this->repository = $entityManager->getRepository(Listing::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findOneBy(array $criteria): ?Listing
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * @param array $item
     * @param Channel $channel
     */
    public function updateOrCreate(array $item, Channel $channel)
    {
        $listing = $this->findOneBy([
            'publicId' => $item['publicId'],
            'channel' => $channel,
        ]);

        if (is_null($listing)) {
            $listing = new Listing();
        }

        $listing->setTitle($item['title'])
            ->setPublicId($item['publicId'])
            ->setLink($item['link'])
            ->setSummary($item['summary'])
            ->setContent($item['content'])
            ->setCategory($item['category'])
            ->setChannel($channel)
            ->setUpdatedAt($item['updatedAt'])
            ->setPublishedAt($item['publishedAt'])
        ;

        $this->entityManager->persist($listing);
        $this->entityManager->flush();
    }

    /**
     * @param array $items
     * @param Channel $channel
     */
    public function updateOrCreateBulk(array $items, Channel $channel)
    {
        foreach ($items as $item) {
            $this->updateOrCreate($item, $channel);
        }
    }
}
