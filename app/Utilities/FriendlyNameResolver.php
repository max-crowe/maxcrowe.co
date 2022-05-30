<?php
namespace App\Utilities;

use Symfony\Component\Routing\Exception\RouteNotFoundException;

class FriendlyNameResolver
{
    /**
     * Overrides for routes whose friendly names are something other than
     * capitalized versions of the route name.
     */
    protected static $map = [
        'home' => 'About Me'
    ];

    /**
     * Returns the "friendly name" corresponding to the route name.
     *
     * @param string $routeName
     */
    public function __invoke($routeName): string
    {
        return self::$map[$routeName] ?? ucfirst($routeName);
    }
}
