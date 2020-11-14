<?php declare(strict_types=1);

namespace App\Repository\Contract;

use App\Entity\Channel;

/**
 * Interface ChannelRepositoryInterface
 *
 * @package App\Repository
 */
interface ChannelRepositoryInterface
{
    /**
     * @param array $data
     *
     * @return Channel
     */
    public function findOrCreate(array $data): Channel;

    /**
     * @param array $data
     *
     * @return Channel
     */
    public function create(array $data): Channel;
}
