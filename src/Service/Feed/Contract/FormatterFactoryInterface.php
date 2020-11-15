<?php declare(strict_types=1);

namespace App\Service\Feed\Contract;

use App\Service\Feed\Formatters\Contract\FormatterInterface;

/**
 * Interface ReaderFactoryInterface
 *
 * @package App\Service\Feed\Contract
 */
interface FormatterFactoryInterface
{
    /**
     * @param string $type
     * @param        $content
     *
     * @return FormatterInterface
     */
    public function create(string $type, $content): FormatterInterface;
}
