<?php
declare(strict_types=1);

namespace Createnl\ZxcvbnBundle;

use Symfony\Contracts\Translation\TranslatorInterface;
use ZxcvbnPhp\Zxcvbn;

class ZxcvbnTranslation extends ZxcvbnDecorator
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(Zxcvbn $inner, TranslatorInterface $translator)
    {
        $this->translator = $translator;

        parent::__construct($inner);
    }

    public function passwordStrength($password, array $userInputs = [])
    {
        $passwordStrength = parent::passwordStrength($password, $userInputs);

        return $this->translatePasswordStrengthResults($passwordStrength);
    }

    private function translatePasswordStrengthResults(array $passwordStrength): array
    {
        $passwordStrength['feedback']['warning'] = $this->translate($passwordStrength['feedback']['warning']);

        foreach ($passwordStrength['feedback']['suggestions'] as $index => $suggestion) {
            $passwordStrength['feedback']['suggestions'][$index] = $this->translate($suggestion);
        }

        return $passwordStrength;
    }

    private function translate(string $string): string
    {
        return $this->translator->trans(
            $string,
        );
    }
}
