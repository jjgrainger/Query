<?php

namespace Query\Concerns;

trait QueriesPosts
{
    /**
     * Add Post Scopes to the query on boot.
     *
     * @var array
     */
    protected function bootQueriesPosts()
    {
        $scopes = [
            new \Query\Scopes\Author,
            new \Query\Scopes\AuthorIn,
            new \Query\Scopes\AuthorNotIn,
            new \Query\Scopes\Comments,
            new \Query\Scopes\Meta,
            new \Query\Scopes\Order,
            new \Query\Scopes\OrderBy,
            new \Query\Scopes\Page,
            new \Query\Scopes\ParentIn,
            new \Query\Scopes\ParentNotIn,
            new \Query\Scopes\Password,
            new \Query\Scopes\Post,
            new \Query\Scopes\PostIn,
            new \Query\Scopes\PostNotIn,
            new \Query\Scopes\PostParent,
            new \Query\Scopes\PostStatus,
            new \Query\Scopes\PostType,
            new \Query\Scopes\PostsPerPage,
            new \Query\Scopes\Search,
            new \Query\Scopes\Taxonomy,
        ];

        foreach ($scopes as $scope) {
            $this->addScope($scope);
        }
    }
}
