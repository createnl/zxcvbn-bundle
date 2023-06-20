<?php

declare(strict_types=1);

namespace Createnl\ZxcvbnBundle\Tests\Validator\Constraints;

use Createnl\ZxcvbnBundle\Validator\Constraints\ZxcvbnPasswordStrength;
use Createnl\ZxcvbnBundle\Validator\Constraints\ZxcvbnPasswordStrengthValidator;
use Createnl\ZxcvbnBundle\ZxcvbnFactory;
use Symfony\Component\Translation\IdentityTranslator;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

final class ZxcvbnPasswordStrengthValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ZxcvbnPasswordStrengthValidator
    {
        return new ZxcvbnPasswordStrengthValidator(new ZxcvbnFactory([], new IdentityTranslator()));
    }

    public function testExpectsConstraintType(): void
    {
        $this->expectException(UnexpectedTypeException::class);

        $this->validator->validate('password', new IsTrue());
    }

    public function testNullIsValid(): void
    {
        $this->validator->validate(null, new ZxcvbnPasswordStrength());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid(): void
    {
        $this->validator->validate('', new ZxcvbnPasswordStrength());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $this->validator->validate(new \stdClass(), new ZxcvbnPasswordStrength());
    }

    public function testValidPasswordStrength(): void
    {
        $this->validator->validate('db6s[t_%9h;lz7 Gu<pMUr=GO$]N@g9n', new ZxcvbnPasswordStrength());

        $this->assertNoViolation();
    }

    public function testInvalidPasswordStrength(): void
    {
        $this->validator->validate('123456', new ZxcvbnPasswordStrength(null, 'myMessage'));

        $this->buildViolation('myMessage')
            ->setParameter('{{ warning }}', "\nThis is a top-10 common password")
            ->setParameter('{{ suggestions }}', "\nAdd another word or two. Uncommon words are better.")
            ->setCode(ZxcvbnPasswordStrength::ZXCVBN_PASSWORD_STRENGTH_ERROR)
            ->assertRaised();
    }
}
