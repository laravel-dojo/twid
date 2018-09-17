# Taiwan ID Number validation and maker

meditate/twid is PHP Library to validate and make Taiwan ID Number.

## Contents

- [Installation](#installation)
- [Usage](#usage)
    - [Basic](#basic)
    - [Facade](#facade)
    - [Laravel validation](#laravel-validation)
- [License](#license)

## Installation

You can install the package via composer:

```bash
composer require meditate/twid
```

If you are Laravel project, add twid facade in `app/config/app.php`:

```php
'aliases' => [
	...
    
    'Twid' => Meditate\IdentityCard\Facades\TaiwanIdentityCard::class,
]
```

## Usage

### Basic

```php
use Meditate\IdentityCard\TaiwanIdentityCard;

$taiwanIdCard = new TaiwanIdentityCard;
```

Now, you can use `check` method to validate ID Number:

```php
$taiwanIdCard->check('A123456789'); // true
$taiwanIdCard->check('A223456789'); // false
```

Or generate a fake ID Number:

```php
// A123456789
$taiwanIdCard->make();

// B167663827
$taiwanIdCard->make('B');

// A259776352
$taiwanIdCard->make('A', 2);
```

### Facade

Also you can use facade:

```php
Twid::check('A123456789');

Twid::make();
```

### Laravel validation

In Laravel, you can easy use in "form request". Just need to add `tw_id` rule to the `rules` method:

```php
public function rules()
{
    return [
        'id_number' => 'tw_id'
    ];
}
```

## License

The MIT License (MIT). Please see [License File](https://github.com/thephpleague/skeleton/blob/master/LICENSE.md) for more information.
