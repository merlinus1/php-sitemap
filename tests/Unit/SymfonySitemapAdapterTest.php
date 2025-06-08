<?php

/**
 * Unit tests for the SymfonySitemapAdapter class and its integration points.
 */

use Rumenx\Sitemap\Adapters\SymfonySitemapAdapter;
use Rumenx\Sitemap\Sitemap;

test('SymfonySitemapAdapter can be instantiated', function () {
    $adapter = new SymfonySitemapAdapter([]);
    expect($adapter)->toBeInstanceOf(SymfonySitemapAdapter::class);
});

test('SymfonySitemapAdapter holds a Sitemap instance', function () {
    $adapter = new SymfonySitemapAdapter([]);
    $sitemap = $adapter->getSitemap();
    expect($sitemap)->toBeInstanceOf(Sitemap::class);
});
