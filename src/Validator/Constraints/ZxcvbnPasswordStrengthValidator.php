<?php

declare(strict_types=1);

namespace Createnl\ZxcvbnBundle\Validator\Constraints;

use Createnl\ZxcvbnBundle\ZxcvbnFactoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class ZxcvbnPasswordStrengthValidator extends ConstraintValidator
{
    private ZxcvbnFactoryInterface $zxcvbnFactory;

    public function __construct(ZxcvbnFactoryInterface $zxcvbnFactory)
    {
        $this->zxcvbnFactory = $zxcvbnFactory;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ZxcvbnPasswordStrength) {
            throw new UnexpectedTypeException($constraint, ZxcvbnPasswordStrength::class);
        }

        if (null !== $value && !is_scalar($value) && !(\is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedValueException($value, 'string');
        }

        $value = (string) $value;
        if ('' === $value) {
            return;
        }

        $zxcvbn = $this->zxcvbnFactory->createZxcvbn();

        $result = $zxcvbn->passwordStrength($value);

        if ($result['score'] < $constraint->minScore) {
            $this->context->buildViolation($constraint->message)
                ->setCode(ZxcvbnPasswordStrength::ZXCVBN_PASSWORD_STRENGTH_ERROR)
                ->setParameter('{{ warning }}', $result['feedback']['warning'] ? "\n".$result['feedback']['warning'] : '')
                ->setParameter('{{ suggestions }}', $result['feedback']['suggestions'] ? "\n".implode("\n", $result['feedback']['suggestions']) : '')
                ->addViolation();
        }
    }
}
