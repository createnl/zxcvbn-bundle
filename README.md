[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/createnl/zxcvbn-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/createnl/zxcvbn-bundle/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/createnl/zxcvbn-bundle/badge.svg?branch=master)](https://coveralls.io/github/createnl/zxcvbn-bundle?branch=master)
[![CI](https://github.com/createnl/zxcvbn-bundle/workflows/CI/badge.svg)](https://github.com/createnl/zxcvbn-bundle/actions?query=workflow%3ACI)
[![Packagist](https://img.shields.io/packagist/dt/createnl/zxcvbn-bundle)](https://packagist.org/packages/createnl/zxcvbn-bundle)

# Zxcvbn Symfony Bundle
A bundle to integrate [zxcvbn-php](https://github.com/bjeavons/zxcvbn-php) with your symfony app. Supports localization and custom matchers. 

## Installation
```bash
composer require createnl/zxcvbn-bundle
```

## Basic Usage
```php
use Createnl\ZxcvbnBundle\ZxcvbnFactoryInterface;

class PasswordController
{
    public function updatePassword(string $password, ZxcvbnFactoryInterface $zxcvbnFactory)
    {
        $userData = [
          'Marco',
          'marco@example.com'
        ];

        $zxcvbn = $zxcvbnFactory->createZxcvbn();

        $weak = $zxcvbn->passwordStrength($password, $userData);
        echo $weak['score']; // will print 0
        
        $strong = $zxcvbn->passwordStrength('correct horse battery staple');
        echo $strong['score']; // will print 4

        echo $weak['feedback']['warning']; // will print user-facing feedback on the password, set only when score <= 2
        echo $weak['feedback']['suggestions']; // may contain user-facing suggestions to improve the score
    }
}
```

## Localization
This package supports the localization of warning and suggestion messages. Checks on common passwords, words and (family) names are only in English (US). But you can [tag your own matcher](#extending-matchers) to extend to your needs. 

Supported languages:
- Dutch 🇳🇱
- English 🇺🇸
- French 🇫🇷

[More about localization in Symfony.](https://symfony.com/doc/current/translation.html#configuration)

## Adding translations
If you are missing translations in your language you may consider creating (and contribute) them.

Override in your project:
1. Open [messages.en.yaml](src/Resources/translations/messages.en.yaml)
2. Copy the contents to your project's translation file
3. Change to your needs

Contributing a language:
1. Fork this repository
2. Copy [messages.en.yaml](src/Resources/translations/messages.en.yaml)
3. Change the filename to `messages.LOCALE.yaml` (for example `messages.es.yaml`)
4. Open it up and translate the right-hand values to your language
5. Create a Pull Request
6. Thank you!

## Extending matchers
If you created your own matcher you can tag them with `zxcvbn.matcher` in your service container.
```yaml
services:
  App\ZxcvbnMatchers\:
    resource: '../src/ZxcvbnMatchers'
    tags: ['zxcvbn.matcher']
```
