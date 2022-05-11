<?php

declare(strict_types=1);

namespace Createnl\ZxcvbnBundle\Tests\Validator\Constraints;

use Createnl\ZxcvbnBundle\Validator\Constraints\ZxcvbnPasswordStrength;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

final class ZxcvbnPasswordStrengthTest extends TestCase
{
    public function testInvalidMinScore(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ZxcvbnPasswordStrength(null, null, 5);
    }
}
