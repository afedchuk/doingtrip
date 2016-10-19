<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
  <?php foreach($cities as $city) { ?>
    <url>
      <loc><?php echo $city; ?></loc>
      <changefreq>daily</changefreq>
      <priority>0.4</priority>
    </url>
  <?php } ?>
  <?php foreach($apartments as $model): ?>
    <url>
      <loc><?php echo $model['url']; ?></loc>
      <changefreq>daily</changefreq>
      <lastmod><?php echo $model['lastmod']; ?></lastmod>
      <priority>0.5</priority>
    </url>
  <?php endforeach; ?>
  <?php foreach($news as $model): ?>
    <url>
      <loc><?php echo $model['url']; ?></loc>
      <changefreq>daily</changefreq>
      <lastmod><?php echo $model['lastmod']; ?></lastmod>
      <priority>0.9</priority>
    </url>
  <?php endforeach; ?>
  <?php foreach($pages as $model): ?>
    <url>
      <loc><?php echo $model['url']; ?></loc>
      <changefreq>daily</changefreq>
      <lastmod><?php echo $model['lastmod']; ?></lastmod>
      <priority>1</priority>
    </url>
  <?php endforeach; ?>
</urlset>