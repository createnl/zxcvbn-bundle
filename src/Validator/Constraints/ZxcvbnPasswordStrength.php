<?php
declare(strict_types=1);

namespace Createnl\ZxcvbnBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class ZxcvbnPasswordStrength extends Constraint
{
    public const ZXCVBN_PASSWORD_STRENGTH_ERROR = '2d00ebc4-f658-48b2-bebf-269daf0b5e8f';

    protected static $errorNames = [self::ZXCVBN_PASSWORD_STRENGTH_ERROR => 'ZXCVBN_PASSWORD_STRENGTH_ERROR'];

    public string $message = 'This password does not have enough strength.{{ warning }}{{ suggestions }}';

    public int $minScore = 4;

    public function __construct(
        array $options = null,
        string $message = null,
        int $minScore = null,
        array $groups = null,
        $payload = null
    ) {
        parent::__construct($options, $groups, $payload);

        $this->message = $message ?? $this->message;
        if ($minScore < 0 || $minScore > 4) {
            throw new InvalidArgumentException('The "minScore" parameter value is not valid. It should be between 0 and 4.');
        }
        $this->minScore = $minScore ?? $this->minScore;
    }
}
