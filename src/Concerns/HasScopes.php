<?php

namespace Query\Concerns;

use Query\Scope;
use ReflectionClass;

trait HasScopes
{
    /**
     * Array of scope classes.
     *
     * @var array
     */
    private $scopes = [
        \Query\Scopes\Author::class,
        \Query\Scopes\AuthorIn::class,
        \Query\Scopes\AuthorNotIn::class,
        \Query\Scopes\Comments::class,
        \Query\Scopes\Meta::class,
        \Query\Scopes\Order::class,
        \Query\Scopes\OrderBy::class,
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
    ];

    /**
     * The available scope objects.
     *
     * @var array
     */
    private $available = [];

    /**
     * Array of aliases for scopes.
     *
     * @var array
     */
    private $aliases = [];

    /**
     * Setup scopes.
     *
     * @return void
     */
    protected function buildScopes()
    {
        array_walk($this->scopes, [$this, 'setupScope']);
    }

    /**
     * Setup each individual scope.
     *
     * @param  string $scope
     *
     * @return void
     */
    protected function setupScope(string $scope)
    {
        // Create scope key from class name.
        $key = $this->getScopeKey($scope);

        // Instantiate and add available scope.
        $this->available[$key] = new $scope;

        // Add scopes aliases.
        $aliases = $this->getScopeAliases($this->available[$key]);

        foreach ($aliases as $alias) {
            $this->aliases[$alias] = $key;
        }
    }

    /**
     * Get the scope key, classname with first letter lowercase.
     *
     * @param  string $scope
     *
     * @return string
     */
    public function getScopeKey(string $scope): string
    {
        return lcfirst((new ReflectionClass($scope))->getShortName());
    }

    /**
     * Get the scopes aliases.
     *
     * @return array
     */
    protected function getScopeAliases(Scope $scope)
    {
        return empty($scope->aliases) ? [] : $scope->aliases;
    }

    /**
     * Returns array of all scopes including aliases.
     *
     * @return array
     */
    protected function allScopes(): array
    {
        return array_merge(array_keys($this->available), array_keys($this->aliases));
    }

    /**
     * Checks if a scope exists.
     *
     * @param  string  $scope
     *
     * @return boolean
     */
    protected function hasScope(string $scope): bool
    {
        return (boolean) in_array($scope, $this->allScopes());
    }

    /**
     * Calls the scope and passes arguments.
     *
     * @param  string $scope
     * @param  array  $arguements
     *
     * @return Builder
     */
    protected function callScope(string $scope, array $arguments = [])
    {
        return call_user_func_array([$this->resolveScope($scope), 'apply'], $arguments);
    }

    /**
     * Resolve the scope string to its instance.
     *
     * @param  string $scope
     *
     * @return Scope
     */
    protected function resolveScope(string $scope)
    {
        // Get correct scope for aliases.
        if (array_key_exists($scope, $this->aliases)) {
            $scope = $this->aliases[$scope];
        }

        return $this->available[$scope];
    }
}
