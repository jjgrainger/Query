<?php

namespace Query\Concerns;

use ReflectionClass;

trait BootsTraits
{
    /**
     * Bootstrap bootable traits.
     *
     * @return void
     */
    public function bootTraits()
    {
        // Get traits associated to the class.
        $traits = (new ReflectionClass(static::class))->getTraitNames();

        // Loop over traits and call their bootable method.
        foreach ($traits as $trait) {
            // Create the bootable method string.
            $method = 'boot' . (new ReflectionClass($trait))->getShortName();

            // Skip, if no bootable method available.
            if (!method_exists($this, $method)) {
                continue;
            }

            // Call the bootable method.
            $this->{$method}();
        }
    }
}
