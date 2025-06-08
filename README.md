# **[php-sitemap](https://github.com/RumenDamyanov/php-sitemap) package**

[![CI](https://github.com/RumenDamyanov/php-sitemap/actions/workflows/ci.yml/badge.svg)](https://github.com/RumenDamyanov/php-sitemap/actions)
[![codecov](https://codecov.io/gh/RumenDamyanov/php-sitemap/branch/master/graph/badge.svg)](https://codecov.io/gh/RumenDamyanov/php-sitemap)

**php-sitemap** is a modern, framework-agnostic PHP package for generating sitemaps in XML, TXT, HTML, and Google News formats. It works seamlessly with Laravel, Symfony, or any PHP project. Features include high test coverage, robust CI, extensible adapters, and support for images, videos, translations, alternates, and Google News.


---

## Features

- **Framework-agnostic**: Use in Laravel, Symfony, or any PHP project
- **Multiple formats**: XML, TXT, HTML, Google News, mobile
- **Rich content**: Supports images, videos, translations, alternates, Google News
- **Modern PHP**: Type-safe, extensible, and robust
- **High test coverage**: 100% code coverage, CI/CD ready
- **Easy integration**: Simple API, drop-in for controllers/routes
- **Extensible**: Adapters for Laravel, Symfony, and more

---

## Installation

```bash
composer require rumenx/php-sitemap
```

---

## Usage

### Laravel Example

**Controller method:**

```php
use Rumenx\Sitemap\Sitemap;

public function sitemap(Sitemap $sitemap)
{
    $sitemap->add('https://example.com/', now(), '1.0', 'daily');
    $sitemap->add('https://example.com/about', now(), '0.8', 'monthly', images: [
        ['url' => 'https://example.com/img/about.jpg', 'title' => 'About Us']
    ]);
    // Add more items as needed...
    return response($sitemap->render('xml'), 200, ['Content-Type' => 'application/xml']);
}
```

**Route registration:**

```php
Route::get('/sitemap.xml', [SitemapController::class, 'sitemap']);
```

**Advanced:**

```php
// Add with translations, videos, alternates, Google News
$sitemap->add(
    'https://example.com/news',
    now(),
    '0.7',
    'weekly',
    images: [['url' => 'https://example.com/img/news.jpg', 'title' => 'News Image']],
    title: 'News Article',
    translations: [['language' => 'fr', 'url' => 'https://example.com/fr/news']],
    videos: [['title' => 'News Video', 'description' => 'Video description']],
    googlenews: [
        'sitename' => 'Example News',
        'language' => 'en',
        'publication_date' => now(),
    ],
    alternates: [['media' => 'print', 'url' => 'https://example.com/news-print']]
);
```

---

### Symfony Example

**Controller:**

```php
use Rumenx\Sitemap\Sitemap;
use Symfony\Component\HttpFoundation\Response;

class SitemapController
{
    public function sitemap(): Response
    {
        $sitemap = new Sitemap();
        $sitemap->add('https://example.com/', (new \DateTime())->format(DATE_ATOM), '1.0', 'daily');
        $sitemap->add('https://example.com/contact', (new \DateTime())->format(DATE_ATOM), '0.5', 'monthly');
        // Add more items as needed...
        return new Response($sitemap->render('xml'), 200, ['Content-Type' => 'application/xml']);
    }
}
```

**Route registration:**

```yaml
# config/routes.yaml
sitemap:
    path: /sitemap.xml
    controller: App\Controller\SitemapController::sitemap
```

---

### Generic PHP Example

```php
require 'vendor/autoload.php';

use Rumenx\Sitemap\Sitemap;

$sitemap = new Sitemap();
$sitemap->add('https://example.com/', date('c'), '1.0', 'daily');
$sitemap->add('https://example.com/products', date('c'), '0.9', 'weekly', [
    ['url' => 'https://example.com/img/product.jpg', 'title' => 'Product Image']
]);
header('Content-Type: application/xml');
echo $sitemap->render('xml');
```

---

### Advanced Features

```php
// Add with all supported fields
$sitemap->add(
    'https://example.com/news',
    date('c'),
    '0.8',
    'daily',
    images: [['url' => 'https://example.com/img/news.jpg', 'title' => 'News Image']],
    title: 'News Article',
    translations: [['language' => 'fr', 'url' => 'https://example.com/fr/news']],
    videos: [['title' => 'News Video', 'description' => 'Video description']],
    googlenews: [
        'sitename' => 'Example News',
        'language' => 'en',
        'publication_date' => date('c'),
    ],
    alternates: [['media' => 'print', 'url' => 'https://example.com/news-print']]
);

// Render as TXT
file_put_contents('sitemap.txt', $sitemap->render('txt'));

// Render as HTML
file_put_contents('sitemap.html', $sitemap->render('html'));
```

---

### add() vs addItem()

You can add sitemap entries using either the `add()` or `addItem()` methods:

**add() — Simple, type-safe, one-at-a-time:**

```php
// Recommended for most use cases
$sitemap->add(
    'https://example.com/',
    date('c'),
    '1.0',
    'daily',
    images: [['url' => 'https://example.com/img.jpg', 'title' => 'Image']],
    title: 'Homepage'
);
```

**addItem() — Advanced, array-based, supports batch:**

```php
// Add a single item with an array (all fields as keys)
$sitemap->addItem([
    'loc' => 'https://example.com/about',
    'lastmod' => date('c'),
    'priority' => '0.8',
    'freq' => 'monthly',
    'title' => 'About Us',
    'images' => [['url' => 'https://example.com/img/about.jpg', 'title' => 'About Us']],
]);

// Add multiple items at once (batch add)
$sitemap->addItem([
    [
        'loc' => 'https://example.com/page1',
        'title' => 'Page 1',
    ],
    [
        'loc' => 'https://example.com/page2',
        'title' => 'Page 2',
    ],
]);
```

- Use `add()` for simple, explicit, one-at-a-time additions (recommended for most users).
- Use `addItem()` for advanced, batch, or programmatic additions with arrays (e.g., when looping over database results).

---

## Testing

```bash
./vendor/bin/pest
```

---

## License

[MIT License](LICENSE.md)
