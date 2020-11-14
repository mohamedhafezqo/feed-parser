<?php declare(strict_types = 1);

namespace App\Service\Feed;

use App\Exception\NotSupportedException;
use App\Service\Feed\Contract\ReaderFactoryInterface;
use App\Service\Feed\Types\Contract\ReaderInterface;

/**
 * Class ReaderFactory
 *
 * @package App\Service\Feed
 */
class ReaderFactory implements ReaderFactoryInterface
{
    /**
     * @param string $type
     * @param        $content
     *
     * @return mixed
     * @throws NotSupportedException
     */
    public function create(string $type, $content): ReaderInterface
    {
        $className = ucfirst($type).'Reader';
        $reader = 'App\Service\Feed\Types\\'.$className;

        if (class_exists($reader)) {
            return new $reader($content);
        }

        throw new NotSupportedException($type);
    }
}
