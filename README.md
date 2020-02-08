# WordPress Query Builder

> A fluent interface for creating WordPress Queries

## Requirements

* PHP >= 7.2
* [Composer](https://getcomposer.org/)
* [WordPress](https://wordpress.org) 5.3.2

## Installation

```
$ composer require jjgrainger/query
```

## Usage

```php
use Query\Query;

// Create a new WP_Query for the latest 3 products.
$query = Query::post_type( 'product' )->posts_per_page( 3 )->get();

// The above is the same as...
$args = [
    'post_type' => 'post',
    'posts_per_page' => 3,
];

$query = new \WP_Query( $args );
```

## Notes

* Licensed under the [MIT License](https://github.com/jjgrainger/wp-posttypes/blob/master/LICENSE)
* Maintained under the [Semantic Versioning Guide](https://semver.org)

## Author

**Joe Grainger**

* [https://jjgrainger.co.uk](https://jjgrainger.co.uk)
* [https://twitter.com/jjgrainger](https://twitter.com/jjgrainger)
