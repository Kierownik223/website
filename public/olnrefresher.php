<?php
// change here
const OLN_FEED_URL = 'https://sup.live.net.co/api/feed/f9bd69058668948d?format=json';

$json = file_get_contents(OLN_FEED_URL);
if ($json === false) {
    die('Failed to fetch feed.');
}
$data = json_decode($json, true);
if (!$data) {
    die('Malformed JSON.');
}

$feed = $data['feed'];
$posts = $feed['entries'];

$html = [];
$html[] = '<h2>' . htmlspecialchars($feed['title']) . '</h2>';

$updated = new DateTime($feed['updated']);
$updated->setTimezone(new DateTimeZone(date_default_timezone_get()));
$html[] = '<small>Last update: ' . $updated->format('d/m/Y, H:i:s') . '</small><div class="grid">';

foreach ($posts as $post) {
    $html[] = '<div class="device"><h3>' . $post['summaryHtml'] . '</h3><p>' . $post['contentHtml'] . '</p></div>';
}

$html[] = '</div>';

$generated = implode('', $html);

$page = file_get_contents(__DIR__ . '/olfeed.html');
if ($page === false) {
    die('Failed to read olfeed.html');
}

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTMLFile(__DIR__ . '/olfeed.html');
libxml_clear_errors();

$xpath = new DOMXPath($dom);
$main = $xpath->query('//div[contains(@class,"main")]')->item(0);

while ($main->firstChild) {
    $main->removeChild($main->firstChild);
}

$fragment = $dom->createDocumentFragment();
$fragment->appendXML($generated);
$main->appendChild($fragment);

$dom->saveHTMLFile(__DIR__ . '/olfeed.html');
