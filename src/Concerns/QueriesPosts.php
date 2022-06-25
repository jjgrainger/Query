<?php

namespace Query\Concerns;

trait QueriesPosts
{
    /**
     * Post Scopes
     *
     * @var array
     */
    private $postScopes = [
        \Query\Scopes\Author::class,
        \Query\Scopes\AuthorIn::class,
        \Query\Scopes\AuthorNotIn::class,
        \Query\Scopes\Comments::class,
        \Query\Scopes\Meta::class,
        \Query\Scopes\Order::class,
        \Query\Scopes\OrderBy::class,
        \Query\Scopes\Page::class,
        \Query\Scopes\ParentIn::class,
        \Query\Scopes\ParentNotIn::class,
        \Query\Scopes\Password::class,
        \Query\Scopes\Post::class,
        \Query\Scopes\PostIn::class,
        \Query\Scopes\PostNotIn::class,
        \Query\Scopes\PostParent::class,
        \Query\Scopes\PostStatus::class,
        \Query\Scopes\PostType::class,
        \Query\Scopes\PostsPerPage::class,
        \Query\Scopes\Search::class,
        \Query\Scopes\Taxonomy::class,
    ];

    /**
     * Add Post Scopes to the query on boot.
     *
     * @var array
     */
    protected function bootQueriesPosts()
    {
        array_walk($this->postScopes, [$this, 'addScope']);
    }
}
