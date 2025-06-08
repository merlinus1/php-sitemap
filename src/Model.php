<?php

namespace Rumenx\Sitemap;

/**
 * Model class for php-sitemap package.
 *
 * This class is responsible for managing sitemap items and sitemaps.
 * It allows adding items, retrieving them, and managing sitemaps.
 */
class Model
{
    private array $items = [];
    private array $sitemaps = [];
    private bool $escaping = true;

    public function __construct(array $config = [])
    {
        if (isset($config['escaping'])) {
            $this->escaping = (bool)$config['escaping'];
        }
    }

    public function getEscaping(): bool
    {
        return $this->escaping;
    }

    /**
     * Add a sitemap item to the internal items array.
     *
     * @param array $item The sitemap item to add.
     * @return void
     */
    public function addItem(array $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Get all sitemap items.
     *
     * @return array The array of sitemap items.
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Add a sitemap index entry to the internal sitemaps array.
     *
     * @param array $sitemap The sitemap index entry to add.
     * @return void
     */
    public function addSitemap(array $sitemap): void
    {
        $this->sitemaps[] = $sitemap;
    }

    /**
     * Get all sitemap index entries.
     *
     * @return array The array of sitemap index entries.
     */
    public function getSitemaps(): array
    {
        return $this->sitemaps;
    }

    /**
     * Reset the list of sitemap index entries.
     *
     * @param array $sitemaps Optional new list of sitemaps.
     * @return void
     */
    public function resetSitemaps(array $sitemaps = []): void
    {
        $this->sitemaps = $sitemaps;
    }
}
