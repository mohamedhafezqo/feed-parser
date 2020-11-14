<?php

namespace App\Service\Parser\Contract;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface ParserInterface
 *
 * @package App\Service\Parser\Contract
 */
interface ParserInterface
{
    /**
     * @return mixed
     */
    public function parse(string $url);

    /**
     * @return string
     */
    public function getType(): string;
}
