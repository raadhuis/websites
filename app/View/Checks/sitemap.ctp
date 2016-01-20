<h1>Sitemap</h1>
<p>Onderstaande sitemap word live gegenereerd van <?=$website['Website']['url']?>/sitemap.xml

<pre>
<?

foreach($sitemap as $s) {
    echo 'Redirect 301 ' . str_replace($website['Website']['url'], '', $s) .' /<br>';
}

?>
</pre>