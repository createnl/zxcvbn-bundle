<?php

namespace Createnl\ZxcvbnBundle\Tests;

use Createnl\ZxcvbnBundle\ZxcvbnFactory;
use Createnl\ZxcvbnBundle\ZxcvbnTranslation;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\Translation\TranslatorInterface;
use ZxcvbnPhp\Matchers\Bruteforce;

class ZxcvbnFactoryTest extends TestCase
{
    public function testCreateZxcvbn()
    {
        $translator = $this->createMock(TranslatorInterface::class);

        $factory = new ZxcvbnFactory([new Bruteforce('',0,0,0)], $translator);

        $result = $factory->createZxcvbn();

        $this->assertInstanceOf(ZxcvbnTranslation::class, $result);
    }
}
