<?php


function fileExists($url)
{
    $url = curl_init($url);
    curl_setopt($url, CURLOPT_NOBODY, true);
    curl_exec($url);
    $retcode = curl_getinfo($url, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $retcode;
}


function checkFavicon($host)
{
    $result = fileExists($host);
    if ($result == 200) {
        echo "ok";
    }
}

$websites = array(
    array('host' => 'http://www.raadhuis.com'),
    array('host' => 'http://nu.nl'),
    array('host' => 'https://apple.com'),
);
?>
<!-- Minimal table requirement -->
<table>
    <caption>My table caption</caption>
    <thead>
    <tr>
        <th></th>
        <th>Column 1</th>
    </tr>
    </thead>
    <tbody>
    <?
    foreach ($websites as $website) {
        ?>
        <tr>
            <th>Row 1</th>
            <td>123</td>
        </tr>

    <?
        echo "Favicon voor " . $website['host'] . " is gevonden: " . checkFavicon($website['host'] . '/favicon.ico') . "<br />";
        echo "sitemap.xml voor " . $website['host'] . " is gevonden: " . fileExists($website['host'] . '/sitemap.xml') . "<br />";
    }
    ?>
    </tbody>
</table>
