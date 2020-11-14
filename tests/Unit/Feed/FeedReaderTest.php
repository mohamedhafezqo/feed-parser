<?php declare(strict_types=1);

namespace App\Test\Unit\Feed;

use App\Service\Feed\ReaderFactory;
use App\Service\Feed\Types\Contract\ReaderInterface;
use PHPUnit\Framework\TestCase;

class ReaderFactoryTest extends TestCase
{
    public function testCreateAtomReader()
    {
        $readerType = 'atom';

        $readerFactory = new ReaderFactory();
        $reader = $readerFactory->create($readerType);

        $this->assertInstanceOf(ReaderInterface::class, $reader);
    }
}
