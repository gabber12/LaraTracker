# LaraTracker
### Tracking for Laravel

[![Build Status](https://travis-ci.org/gabber12/LaraTracker.svg?branch=master)](https://travis-ci.org/gabber12/LaraTracker)
[![Coverage Status](https://coveralls.io/repos/github/gabber12/LaraTracker/badge.svg?branch=master)](https://coveralls.io/github/gabber12/LaraTracker?branch=master)
[![StyleCI](https://styleci.io/repos/82211627/shield?branch=master)](https://styleci.io/repos/82211627)

## Table Of Contents

-   [Installation](#installation)
-   [Usage](#usage)

# Installation

To install Laratracker use composer

### Download

```
composer require gabber12/Laratracker
```

### Add service provider & alias

Add the following service provider to the array in: ```config/app.php```

```php
Laratracker\Links\TrackingServiceProvider::class,
```

Add the following alias to the array in: ```config/app.php```

```php
'Tracker' => Laratracker\Links\Facades\Tracker::class,
```
### Publish the assets

```
php artisan vendor:publish
```

### Migrate

```
php artisan migrate
```

# Usage

## Create Links

To create links, go in the view where you want to add a traked link and instead of using the typical url operations:

```php
{{ url('http://google.com') }}
{{ route('google') }}
```

Use the package facade:

```php
{{ Tracker::url('http://google.com') }}
{{ Tracker::route('google') }}
```
