<?php declare(strict_types=1);

namespace App\Service\Feed\Contract;

use App\Service\Feed\Types\Contract\ReaderInterface;

/**
 * Interface ReaderFactoryInterface
 *
 * @package App\Service\Feed\Contract
 */
interface ReaderFactoryInterface
{
    /**
     * @param string $type
     * @param        $content
     *
     * @return ReaderInterface
     */
    public function create(string $type, $content): ReaderInterface;
}
