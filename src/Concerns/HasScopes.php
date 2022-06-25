<?php

namespace Query\Concerns;

use Query\Scope;
use Query\Builder;
use Closure;
use ReflectionClass;

trait HasScopes
{
    /**
     * Scopes added to the Query.
     *
     * @var array
     */
    private static $scopes = [];

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
     * Add a scope to the Query.
     *
     * @param  \Query\Scope|\Closure|string $scope
     * @param  \Query\Scope|\Closure|null   $implementation
     *
     * @return void
     */
    public static function addScope($scope, $implementation = null)
    {
        if (is_string($scope) && $implementation instanceof Closure) {
            static::$scopes[$scope] = $implementation;
        } elseif ($scope instanceof Scope) {
            static::$scopes[static::getScopeKey($scope)] = $scope;
        }
    }

    /**
     * Get the scope key, classname with first letter lowercase.
     *
     * @param  Scope $scope
     *
     * @return string
     */
    protected static function getScopeKey(Scope $scope): string
    {
        return lcfirst((new ReflectionClass($scope))->getShortName());
    }

    /**
     * Setup scopes.
     *
     * @return void
     */
    protected function buildScopes()
    {
        foreach (static::$scopes as $scope => $implementation) {
            $this->setupScope($scope, $implementation);
        }
    }

    /**
     * Setup each individual scope.
     *
     * @param  string               $scope
     * @param  Query\Scope|\Closure $implementation
     *
     * @return void
     */
    protected function setupScope(string $scope, $implementation)
    {
        if ($implementation instanceof Scope) {
            // Instantiate and add available scope.
            $this->available[$scope] = new $implementation;

            // Add scopes aliases.
            $aliases = $this->getScopeAliases($this->available[$scope]);

            foreach ($aliases as $alias) {
                $this->aliases[$alias] = $scope;
            }
        } else {
            $this->available[$scope] = $implementation;
        }
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
        return call_user_func_array($this->resolveScope($scope), $arguments);
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

        $callable = $this->available[$scope];

        if ($callable instanceof Scope) {
            return [$callable, 'apply'];
        }

        return $callable;
    }
}
