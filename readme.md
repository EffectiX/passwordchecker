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

⚠ Explicit score threshold specification takes precedence over the configuration default.

## Included Password Strength Bar Livewire component
The livewire component has been tested so far to work with Livewire v3 on a site using a Volt registration form. More tests and use cases to come later. 

The score property is reactive, so it might cause some issues in some implementations. Maybe. I'm not totally certain.

So long as you can pass the score to the component you should have no problems. Use it in your registration form like this:
```bladehtml
<div class="mt-4">
    <x-input-label for="password" :value="__('Password')"/>

    <input id="password"
           class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
           type="password"
           name="password"
           required
           autocomplete="new-password"
           wire:model.live.debounce.500ms="password"
    />

    <livewire:EffectixPasswordCheckerPasswordStrengthBar :score="$score" />

    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
</div>
```
Your parent livewire component if you are using volt, should contain something like this:
```php
public int $score = 0;

public function updated($prop): void
{
    if($prop === 'password') {
        $this->score = PasswordScorer::calculate($this->password);
    }
}
```
This will evaluate the score everytime the debounced update to the password model is hit. The reactive property of the child component will pick up the new score and show the bar accordingly.

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
