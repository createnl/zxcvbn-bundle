<?php

namespace Createnl\ZxcvbnBundle\Tests;

use Createnl\ZxcvbnBundle\ZxcvbnTranslation;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\Translation\TranslatorInterface;
use ZxcvbnPhp\Zxcvbn;

class ZxcvbnTranslationTest extends TestCase
{
    public function testPasswordStrength(): void
    {
        $translator = $this->createMock(TranslatorInterface::class);
        $translatedField = 'translated';
        $translator->method('trans')->willReturn($translatedField);

        $subject = new ZxcvbnTranslation(new Zxcvbn(), $translator);

        $result = $subject->passwordStrength('asd');

        $this->assertEquals($translatedField, $result['feedback']['warning']);
        $this->assertEquals($translatedField, $result['feedback']['suggestions'][0]);
        $this->assertEquals($translatedField, $result['feedback']['suggestions'][1]);
    }
}
