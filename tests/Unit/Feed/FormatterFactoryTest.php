<?php declare(strict_types=1);

namespace App\Test\Unit\Feed;

use App\Service\Feed\FormatterFactory;
use App\Service\Feed\Formatters\Contract\FormatterInterface;
use PHPUnit\Framework\TestCase;

class FormatterFactoryTest extends TestCase
{
    public function testCreateAtomFormatter()
    {
        $readerType = 'atom';

        $readerFactory = new FormatterFactory();
        $reader = $readerFactory->create($readerType, new \SimpleXMLElement('<root />'));

        $this->assertInstanceOf(FormatterInterface::class, $reader);
    }
}
