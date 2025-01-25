# Password Checker

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]


This is an opinionated strength check intended for password validation in registration forms. Take a look at [contributing.md](contributing.md) to see how to do so.

Things taken into account for the scoring:
- Common Patterns
- Length
- Character Variety
- Entropy of the string (based on Shannon's Entropy formula) 

The common patterns verification uses a set of included .txt files with common plain text terms, words and phrases that have already been compromised on earlier breaches. This is the most penalizing factor in the scoring as if your string has a full match with any of these values, you get instant -100 on the score and go into negative territory.

This is done on purpose to prevent users from creating accounts with already known weak passwords that have been distributed in a very common wordlist for pentesting purposes. 

The other factors add to the scoring based on their respective weights, so the higher the score, the stronger the password.

⚠ The scoring is still being tweaked and played with so future versions of this package will have a different scoring for sure, but for now, it works as intended.

## Installation

Via Composer

```bash
composer require effectix/passwordchecker
```
#### Configuration
Run `artisan vendor:publish --provider="Effectix\PasswordChecker\PasswordCheckerServiceProvider"` to publish everything this package offers:
- Password score Validation rule
- Locale files for `es` and `en`
- Config file

Alternatively, you can publish the config file only:
Run `artisan vendor:publish --tag=passwordchecker.config`  to publish the config file.

## Usage
You can apply it as a validation rule like this:
```php
//...
$validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', new PasswordScoreRule(20)],
        ]);
//...
```
On your validation logic, call the `Effectix\PasswordChecker\Rules\PasswordScoreRule` rule class and pass the score threshold you want to enforce on that validation.

If you run `artisan vendor:publish --tag=passwordchecker.config` you will get a config file where you can manage a default score threshold for all your uses of this rule, without specifying it in each validation usage.

⚠ Explicit score specification takes precedence over the configuration default. 

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

```bash
composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email jlm@effectix.net instead of using the issue tracker.

## Credits

- [Jorge Morales][link-author]
- [All Contributors][link-contributors]

## License

AGPL. Please see the [license file](license.md) for more information.

[link-author]: https://github.com/morales2k
[ico-version]: https://img.shields.io/packagist/v/effectix/passwordchecker.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/effectix/passwordchecker.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/effectix/passwordchecker
[link-downloads]: https://packagist.org/packages/effectix/passwordchecker
[link-contributors]: ../../contributors
