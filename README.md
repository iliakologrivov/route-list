Wrapper over laravel route:list that adds the ability to specify columns for output table.

## Installation

You can install the package via composer:

```bash
composer require iliakologrivov/route-list
```

### Publish

By running `php artisan vendor:publish --provider="Iliakologrivov\Routelist\RouteListServiceProvider"` in your project all files for this package will be published.

## Usage

```
$ php artisan route:list --column=uri --column=name
+----------------+------------------+
| uri            | name             |
+----------------+------------------+
| /              | home             |
| news           | news             |
| news/{id}      | news.show        |
+----------------+------------------+
```