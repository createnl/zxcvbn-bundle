<?php
declare(strict_types=1);

namespace Createnl\ZxcvbnBundle;

use ZxcvbnPhp\Zxcvbn;

class ZxcvbnDecorator extends Zxcvbn
{
    /**
     * @var Zxcvbn
     */
    private $inner;

    public function __construct(Zxcvbn $inner)
    {
        $this->inner = $inner;

        parent::__construct();
    }

    public function addMatcher(string $className): self
    {
        return $this->inner->addMatcher($className);
    }

    public function passwordStrength(string $password, array $userInputs = []): array
    {
        return $this->inner->passwordStrength($password, $userInputs);
    }

}
