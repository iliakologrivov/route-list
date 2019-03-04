<?php

namespace Iliakologrivov\Routelist;

use Illuminate\Routing\Route;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Foundation\Console\RouteListCommand as Command;

class RouteListCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'route:list';

    /**
     * Get the route information for a given route.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return array
     */
    protected function getRouteInformation(Route $route)
    {
        return $this->filterRoute(array_only([
            'domain'   => $route->domain(),
            'method' => implode('|', $route->methods()),
            'uri'    => $route->uri(),
            'name'   => $route->getName(),
            'action' => $route->getActionName(),
            'middleware' => $this->getMiddleware($route),
        ], $this->getHeaders()));
    }

    /**
     * Display the route information on the console.
     *
     * @param  array  $routes
     * @return void
     */
    protected function displayRoutes(array $routes)
    {
        $this->table($this->getHeaders(), $routes);
    }

    protected function getHeaders()
    {
        $this->headers = array_map('strtolower', $this->headers);

        if (! $this->option('column')) {
            return $this->headers;
        }

        $headers = array_map('strtolower', $this->option('column'));

        return array_intersect($this->headers, array_merge($headers, [$this->option('sort')]));
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array_merge(
            parent::getOptions(),
            [
                ['column', 'c', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'The column (host, method, uri, name, action, middleware) to sort by', ['host', 'method', 'uri', 'name', 'action', 'middleware']],
            ]
        );
    }
}
