<?php
/**
 * SCRIPT to parse del.icio.us export HTML and generate CSV output
 *
 * USAGE: php -f delicious-export-html2csv.php delicious.html
 *
 * Author: Prasad
 */
$file = $argv[1];
if (empty($file) || !file_exists($file)) die("File not found.\n");

fputcsv(STDOUT, array("URL", "TAG", "TITLE"));

$lines = explode("\n", file_get_contents($file));
$regex = '/<DT><A.*HREF="([^"]+)".*TAGS="([^"]+)">(.*)<\/A>/';
foreach ($lines as $line) {
    if (preg_match($regex, $line, $m)) {
        array_shift($m);
        fputcsv(STDOUT, $m);
    }
}
