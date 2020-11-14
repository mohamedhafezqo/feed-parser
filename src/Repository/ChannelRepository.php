<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Channel;
use App\Repository\Contract\ChannelRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * Class ChannelRepository
 *
 * @package App\Repository
 */
class ChannelRepository implements ChannelRepositoryInterface
{
    private ObjectRepository $repository;

    private EntityManagerInterface $entityManager;

    /**
     * ChannelRepository constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Channel::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     *
     * @return Channel
     */
    public function findOrCreate(array $data): Channel
    {
        $channel = $this->repository->findOneBy(['publicId' => $data['publicId']]);

        return $channel ?? $this->create($data);
    }

    /**
     * @param array $data
     *
     * @return Channel
     */
    public function create(array $data): Channel
    {
        $channel = new Channel();
        $channel->setTitle($data['title'])
            ->setPublicId($data['publicId'])
            ->setLink($data['link'])
            ->setIcon($data['icon'])
            ->setLogo($data['logo'])
            ->setRights($data['rights'])
            ->setUpdatedAt($data['updatedAt'])
        ;

        $this->entityManager->persist($channel);
        $this->entityManager->flush();

        return $channel;
    }
}
