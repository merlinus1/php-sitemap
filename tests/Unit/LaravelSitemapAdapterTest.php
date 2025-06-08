<?php
// Define Laravel contract stubs in their correct namespaces if not available
namespace Illuminate\Contracts\Cache {
    if (!interface_exists('Illuminate\\Contracts\\Cache\\Repository')) {
        interface Repository {}
    }
}
namespace Illuminate\Contracts\Config {
    if (!interface_exists('Illuminate\\Contracts\\Config\\Repository')) {
        interface Repository {}
    }
}
namespace Illuminate\Filesystem {
    if (!class_exists('Illuminate\\Filesystem\\Filesystem')) {
        class Filesystem {}
    }
}
namespace Illuminate\Contracts\Routing {
    if (!interface_exists('Illuminate\\Contracts\\Routing\\ResponseFactory')) {
        interface ResponseFactory {}
    }
}
namespace Illuminate\Contracts\View {
    if (!interface_exists('Illuminate\\Contracts\\View\\Factory')) {
        interface Factory {}
    }
}

namespace {
    use Rumenx\Sitemap\Adapters\LaravelSitemapAdapter;
    use Rumenx\Sitemap\Sitemap;

    /**
     * Unit tests for the LaravelSitemapAdapter class and its integration with Laravel contracts.
     */

    test('LaravelSitemapAdapter can be instantiated', function () {
        $cache = new class implements \Illuminate\Contracts\Cache\Repository {};
        $config = new class implements \Illuminate\Contracts\Config\Repository {};
        $file = new class extends \Illuminate\Filesystem\Filesystem {};
        $response = new class implements \Illuminate\Contracts\Routing\ResponseFactory {};
        $view = new class implements \Illuminate\Contracts\View\Factory {};
        $adapter = new LaravelSitemapAdapter([], $cache, $config, $file, $response, $view);
        expect($adapter)->toBeInstanceOf(LaravelSitemapAdapter::class);
    });

    test('LaravelSitemapAdapter holds a Sitemap instance', function () {
        $cache = new class implements \Illuminate\Contracts\Cache\Repository {};
        $config = new class implements \Illuminate\Contracts\Config\Repository {};
        $file = new class extends \Illuminate\Filesystem\Filesystem {};
        $response = new class implements \Illuminate\Contracts\Routing\ResponseFactory {};
        $view = new class implements \Illuminate\Contracts\View\Factory {};
        $adapter = new LaravelSitemapAdapter([], $cache, $config, $file, $response, $view);
        $sitemap = $adapter->getSitemap();
        expect($sitemap)->toBeInstanceOf(Sitemap::class);
    });
}
