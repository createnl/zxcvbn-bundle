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
        $this->inner = $this->inner->addMatcher($className);

        return $this;
    }

    public function passwordStrength(string $password, array $userInputs = []): array
    {
        return $this->inner->passwordStrength($password, $userInputs);
    }

}
