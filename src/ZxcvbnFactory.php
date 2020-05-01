<?php
declare(strict_types=1);

namespace Createnl\ZxcvbnBundle;

use Symfony\Contracts\Translation\TranslatorInterface;
use ZxcvbnPhp\Matchers\MatchInterface;
use ZxcvbnPhp\Zxcvbn;

class ZxcvbnFactory implements ZxcvbnFactoryInterface
{
    /**
     * @var MatchInterface[]
     */
    private $additionalMatchers;
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(iterable $additionalMatchers, TranslatorInterface $translator)
    {
        $this->additionalMatchers = $additionalMatchers;
        $this->translator = $translator;
    }

    public function createZxcvbn(): Zxcvbn
    {
        $zxcvn = new ZxcvbnTranslation(
            new Zxcvbn(),
            $this->translator
        );

        foreach ($this->additionalMatchers as $matcher) {
            $zxcvn->addMatcher(get_class($matcher));
        }

        return $zxcvn;
    }
}
