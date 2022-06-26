# WordPress Query Builder v0.2.0

> A fluent interface for creating WordPress Queries

[![tests](https://github.com/jjgrainger/Query/actions/workflows/tests.yml/badge.svg)](https://github.com/jjgrainger/Query/actions/workflows/tests.yml) [![codecov](https://codecov.io/gh/jjgrainger/Query/branch/master/graph/badge.svg)](https://codecov.io/gh/jjgrainger/Query) [![Total Downloads](https://poser.pugx.org/jjgrainger/query/downloads)](https://packagist.org/packages/jjgrainger/query) [![Latest Stable Version](https://poser.pugx.org/jjgrainger/query/v/stable)](https://packagist.org/packages/jjgrainger/query) [![License](https://poser.pugx.org/jjgrainger/query/license)](https://packagist.org/packages/jjgrainger/query)

## Requirements

* PHP >= 7.2
* [Composer](https://getcomposer.org/)
* [WordPress](https://wordpress.org) 5.3.2

## Installation

```
$ composer require jjgrainger/query
```

## Usage

The `Query` class provides a fluent interface for create `WP_Query` in WordPress.

```php
use Query\Query;

// Create a new WP_Query for the latest 3 products.
$results = Query::post_type( 'product' )->posts_per_page( 3 )->get();

// The above is the same as...
$args = [
    'post_type'      => 'product',
    'posts_per_page' => 3,
];

$results = new \WP_Query( $args );
```

### Creating Custom Query Classes

Custom query classes can be created by extending the `Query` class. Custom query classes can encapsulate default parameters which can then be expanded upon with query methods.

For example, a `FeaturedPostsQuery` can be created to return posts with the 'featured' taxonomy term. The default query parameters are defined within the `setup()` method that receives a `Builder` instance.

```php
use Query\Query;
use Query\Builder;

class FeaturedPostsQuery extends Query
{
    /**
     * Setup the initial query.
     *
     * @param  Builder $builder
     *
     * @return Builder
     */
    public function setup( Builder $builder ): Builder
    {
        // Setup a tax_query for posts with the 'featured' term.
        $tax_query = [
            [
                'taxonomy' => 'featured',
                'fields'   => 'slugs',
                'terms'    => [ 'featured' ],
            ],
        ];

        return $builder->where( 'tax_query', $tax_query );
    }
}
```
Once the query class is created it can be used through out the project in a vairety of ways.

```php
use FeaturedPostsQuery as Featured;

// Returns a WP_Query object for posts with the featured term.
$results = Featured::get();

// Returns a WP_Query object for the latest 3 products with the featured term.
$results = Featured::type( 'products' )->limit( 3 )->get();

// Queries can be instantiated with an array of additional query arguments.
$args = [
    'post_type' => 'products',
];

// Create a query object.
$query = new Featured( $args );

// Modify the query and get the WP_Query object.
$results = $query->limit( 3 )->get();
```

### Custom Scopes

Custom scopes can be added to the global `Query` using the static `addScope` method. One of the simplest ways to add a scope is with a closure.

```php
// Create a new scope with a closure.
Query::addScope( 'events', function( Builder $builder ) {
    return $builder->where( 'post_type', 'event' );
} );

// Call the scope when needed.
$results = Query::events()->limit( 3 );
```

#### Custom Scope Classes

Custom scope classes can be added to the global `Query`. The custom scope class will need to implement the `Scope` interface and contain the required `apply` method.
The `apply` method should accept the query `Builder` as the first argument and any optional arguments passed via the scope.
Once added to the `Query` class the scope will be available by the class name with the first letter lowecase.

```php
// Create a custom scope class.
use Query\Scope;
use Query\Builder;

class PostID implements Scope {
    public function apply( Builder $builder, $id = null ) {
        return $builder->where( 'p', $id );
    }
}

// Add the scope to the Query.
Query::addScope( new PostID );

// Use the scope in the Query.
$results = Query::postID( 123 )->get();
```

## Notes

* The library is still in active development and not intended for production use.
* Licensed under the [MIT License](https://github.com/jjgrainger/Query/blob/master/LICENSE)
* Maintained under the [Semantic Versioning Guide](https://semver.org)

## Author

**Joe Grainger**

* [https://jjgrainger.co.uk](https://jjgrainger.co.uk)
* [https://twitter.com/jjgrainger](https://twitter.com/jjgrainger)
