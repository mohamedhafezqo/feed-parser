<?php declare(strict_types = 1);

namespace App\Service\Feed;

use App\Exception\NotSupportedException;
use App\Service\Feed\Contract\FormatterFactoryInterface;
use App\Service\Feed\Formatters\Contract\FormatterInterface;

/**
 * Class ReaderFactory
 *
 * @package App\Service\Feed
 */
class FormatterFactory implements FormatterFactoryInterface
{
    /**
     * @param string $type
     * @param        $content
     *
     * @return mixed
     * @throws NotSupportedException
     */
    public function create(string $type, $content): FormatterInterface
    {
        $className = ucfirst($type).'Formatter';
        $reader = 'App\Service\Feed\Formatters\\'.$className;

        if (class_exists($reader)) {
            return new $reader($content);
        }

        throw new NotSupportedException($type);
    }
}
