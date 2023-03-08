<?php
header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . URL . '</loc>' . PHP_EOL;
echo '<changefreq>daily</changefreq>' . PHP_EOL;
echo '</url>' . PHP_EOL;

foreach ($data['getBlog'] as $blog) {
    echo '<url>' . PHP_EOL;
    echo '<loc>' . URL . "blog/article/" . $blog['slug'] . '</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

foreach ($data['getCategory'] as $category) {
    echo '<url>' . PHP_EOL;
    echo '<loc>' . URL . "blog/category/" . $category['link'] . '</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

foreach ($data['getServices'] as $service) {
    echo '<url>' . PHP_EOL;
    echo '<loc>' . URL . "services/" . $service['s_slug'] . '</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

foreach ($data['getPage'] as $page) {
    echo '<url>' . PHP_EOL;
    echo '<loc>' . URL . $page["link"] . '</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

foreach ($data['getFaq'] as $faq) {
    echo '<url>' . PHP_EOL;
    echo '<loc>' . URL . "faq/details/" . $faq["id"] . '</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;
?>