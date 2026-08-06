<?php
declare(strict_types=1);

require_once __DIR__ . '/common.php';

header('Content-Type: application/xml; charset=UTF-8');
header('Cache-Control: public, max-age=900');

const DNEKO_SITEMAP_BASE_URL = 'https://d-neko.com';

/**
 * Convert a file modification time or an API date into W3C datetime format.
 */
function dneko_sitemap_lastmod($value): ?string
{
    if ($value === null || $value === '') {
        return null;
    }

    try {
        if (is_int($value)) {
            return gmdate(DATE_ATOM, $value);
        }

        return (new DateTimeImmutable((string) $value))->format(DATE_ATOM);
    } catch (Throwable $exception) {
        return null;
    }
}

/**
 * Return the newer of two W3C datetime values.
 */
function dneko_sitemap_newer(?string $current, ?string $candidate): ?string
{
    if ($candidate === null) {
        return $current;
    }
    if ($current === null) {
        return $candidate;
    }

    return strtotime($candidate) > strtotime($current) ? $candidate : $current;
}

/**
 * Add a canonical URL while keeping the most recent lastmod value.
 *
 * @param array<string, ?string> $urls
 */
function dneko_sitemap_add(array &$urls, string $path, ?string $lastmod = null): void
{
    $location = DNEKO_SITEMAP_BASE_URL . '/' . ltrim($path, '/');
    if ($path === '/') {
        $location = DNEKO_SITEMAP_BASE_URL . '/';
    }

    $urls[$location] = dneko_sitemap_newer($urls[$location] ?? null, $lastmod);
}

/**
 * Read a local file's actual modification time.
 */
function dneko_sitemap_file_lastmod(string $filename): ?string
{
    $path = __DIR__ . '/' . $filename;
    $modified = is_file($path) ? filemtime($path) : false;

    return $modified === false ? null : dneko_sitemap_lastmod($modified);
}

$urls = [];
$staticPages = [
    '/' => 'index.php',
    '/flyer-design.php' => 'flyer-design.php',
    // ホームページ制作ページは一時非公開
    '/ai-consulting.php' => 'ai-consulting.php',
    '/service_digital.php' => 'service_digital.php',
    '/about.php' => 'about.php',
    '/service_marutto.php' => 'service_marutto.php',
    '/moja-cat.php' => 'moja-cat.php',
    '/profile.php' => 'profile.php',
    '/voice.php' => 'voice.php',
    '/faq.php' => 'faq.php',
    '/contact.php' => 'contact.php',
    '/entry_list.php?type=blog' => 'entry_list.php',
    '/entry_list.php?type=works' => 'entry_list.php',
    '/entry_list.php?type=column' => 'entry_list.php',
    '/privacypolicy.php' => 'privacypolicy.php',
    '/law.php' => 'law.php',
];

foreach ($staticPages as $urlPath => $filename) {
    dneko_sitemap_add($urls, $urlPath, dneko_sitemap_file_lastmod($filename));
}

$contentTypes = [
    'blog' => '/blog',
    'works' => '/works',
    'column' => '/column',
];
$latestCmsLastmod = null;

foreach ($contentTypes as $type => $endpoint) {
    $offset = 0;
    $limit = 100;
    $latestTypeLastmod = null;

    do {
        $query = http_build_query(
            [
                'limit' => $limit,
                'offset' => $offset,
                'orders' => '-revisedAt',
                'fields' => 'id,publishedAt,revisedAt,updatedAt',
            ],
            '',
            '&',
            PHP_QUERY_RFC3986
        );
        $response = microcms_get_list($endpoint, $query);

        if (
            $response === null
            || !isset($response->contents)
            || !is_array($response->contents)
        ) {
            break;
        }

        foreach ($response->contents as $content) {
            if (!isset($content->id) || trim((string) $content->id) === '') {
                continue;
            }

            $lastmod = dneko_sitemap_lastmod(
                $content->revisedAt
                ?? $content->publishedAt
                ?? $content->updatedAt
                ?? null
            );
            $entryPath = '/entry.php?type=' . rawurlencode($type)
                . '&eid=' . rawurlencode((string) $content->id);

            dneko_sitemap_add($urls, $entryPath, $lastmod);
            $latestTypeLastmod = dneko_sitemap_newer($latestTypeLastmod, $lastmod);
            $latestCmsLastmod = dneko_sitemap_newer($latestCmsLastmod, $lastmod);
        }

        $received = count($response->contents);
        $offset += $received;
        $totalCount = isset($response->totalCount) ? (int) $response->totalCount : $offset;
    } while ($received === $limit && $offset < $totalCount);

    dneko_sitemap_add(
        $urls,
        '/entry_list.php?type=' . rawurlencode($type),
        $latestTypeLastmod
    );
}

// The home page displays recent microCMS content, so its lastmod follows the latest publication.
dneko_sitemap_add($urls, '/', $latestCmsLastmod);

echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', "\n";

foreach ($urls as $location => $lastmod) {
    echo "  <url>\n";
    echo '    <loc>', htmlspecialchars($location, ENT_XML1 | ENT_QUOTES, 'UTF-8'), "</loc>\n";
    if ($lastmod !== null) {
        echo '    <lastmod>', htmlspecialchars($lastmod, ENT_XML1 | ENT_QUOTES, 'UTF-8'), "</lastmod>\n";
    }
    echo "  </url>\n";
}

echo "</urlset>\n";
