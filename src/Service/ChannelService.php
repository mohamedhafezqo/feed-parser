<?php declare(strict_types=1);

namespace App\Service;

use App\Repository\Contract\ChannelRepositoryInterface;
use App\Service\Contract\ChannelServiceInterface;

/**
 * Class ChannelService
 *
 * @package App\Service
 */
class ChannelService implements ChannelServiceInterface
{
    private ChannelRepositoryInterface $repository;

    /**
     * ChannelService constructor.
     *
     * @param ChannelRepositoryInterface $repository
     */
    public function __construct(ChannelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return \App\Entity\Channel|null
     */
    public function findOrCreate(array $data)
    {
        return $this->repository->findOrCreate($data);
    }
}
