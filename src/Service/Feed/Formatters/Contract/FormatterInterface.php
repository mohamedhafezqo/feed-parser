<?php declare(strict_types=1);

namespace App\Service\Feed\Formatters\Contract;

/**
 * Interface ReaderInterface
 *
 * @package App\Service\Feed\Types\Contract
 */
interface FormatterInterface
{
    /**
     * @return mixed
     */
    public function getChannel();

    /**
     * @return mixed
     */
    public function getEntities();
}
