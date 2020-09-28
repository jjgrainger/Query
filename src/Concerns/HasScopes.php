<?php

namespace Query\Concerns;

use Query\Scope;
use Query\Builder;
use ReflectionClass;

trait HasScopes
{
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
    protected function buildScopes(array $scopes)
    {
        array_walk($scopes, [$this, 'setupScope']);
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
    protected function getScopeKey(string $scope): string
    {
        return lcfirst((new ReflectionClass($scope))->getShortName());
    }

    /**
     * Get the scopes aliases.
     *
     * @return array
     */
    protected function getScopeAliases(Scope $scope): array
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
    protected function callScope(string $scope, array $arguments = []): Builder
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
