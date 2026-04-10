# phpnomad/core

[![Latest Version](https://img.shields.io/packagist/v/phpnomad/core.svg)](https://packagist.org/packages/phpnomad/core) [![Total Downloads](https://img.shields.io/packagist/dt/phpnomad/core.svg)](https://packagist.org/packages/phpnomad/core) [![PHP Version](https://img.shields.io/packagist/php-v/phpnomad/core.svg)](https://packagist.org/packages/phpnomad/core) [![License](https://img.shields.io/packagist/l/phpnomad/core.svg)](https://packagist.org/packages/phpnomad/core)

`phpnomad/core` is the entry-point package for [PHPNomad](https://phpnomad.com), a platform-agnostic PHP framework. Installing it pulls in the nine packages every PHPNomad application needs and adds a `CoreInitializer` plus seven static facades (Cache, Event, Logger, Template, UrlResolver, PathResolver, InstanceProvider) that wire them together.

PHPNomad has been running in production for years, powering [Siren](https://sirenaffiliates.com), several MCP servers, and other client systems. It's small, opinionated, and built by developers who actually use it.

## Installation

```bash
composer require phpnomad/core
```

## Quick Start

Compose a `Bootstrapper` with `CoreInitializer` and any other initializers, then call `load()`.

```php
<?php

use PHPNomad\Core\Bootstrap\CoreInitializer;
use PHPNomad\Di\Container\Container;
use PHPNomad\Loader\Bootstrapper;

$container = new Container();

(new Bootstrapper(
    $container,
    new CoreInitializer(),
    new MyAppInitializer(),
    // Add platform initializers (e.g. WordPressInitializer) and your own initializers here
))->load();
```

`CoreInitializer` is the foundation, not the whole stack. A real application composes it with platform integrations like `WordPressInitializer`, your own initializers, and any other libraries you pull in. The [bootstrapping guide at phpnomad.com](https://phpnomad.com) walks through the full pattern.

## What's Included

### Bundled packages

`phpnomad/core` pulls in nine packages that form the framework's foundation:

- `phpnomad/di`: dependency injection container
- `phpnomad/loader`: bootstrapping and initializer loading
- `phpnomad/event`: event broadcasting and listening
- `phpnomad/cache`: caching abstraction
- `phpnomad/logger`: logging abstraction
- `phpnomad/rest`: REST controller and middleware framework
- `phpnomad/singleton`: singleton trait for facades and shared state
- `phpnomad/facade`: base classes for static-bound service facades
- `phpnomad/utils`: array helpers, list filters, and processors

### Facades

On top of those packages, `core` adds seven static facades for the services you reach for most often:

- `Cache`: get, set, and load-or-compute through the cache strategy
- `Event`: broadcast events and attach or detach listeners
- `Logger`: log messages through the configured logger strategy
- `Template`: render templates through the template strategy
- `UrlResolver`: resolve URLs for assets and routes
- `PathResolver`: resolve filesystem paths the same way
- `InstanceProvider`: pull instances out of the DI container statically

## Documentation

Full documentation lives at [phpnomad.com](https://phpnomad.com), including the bootstrapping guide, the datastore pattern, and per-package references for each of the packages `core` bundles.

## Contributing

PHPNomad is built and maintained by [Alex Standiford](https://alexstandiford.com), who's been using it for years to ship real software. Contributions from developers who care about clean architecture and platform-agnostic design are genuinely welcome.

Good places to start include opening an issue about what you're trying to build, fixing a bug you hit in production, or improving documentation for a package you understand well. Each PHPNomad package lives in its own repo, so issues and pull requests go to the specific package you're working on. If you want orientation before picking something, opening a discussion issue on `phpnomad/core` is a fine place to start.

## License

MIT, see [LICENSE.txt](LICENSE.txt) for the full text.
