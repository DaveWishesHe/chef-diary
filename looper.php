<?php

$css = file_get_contents("css.html");
$template = file_get_contents("template.html");


$start = strtotime("2019-01-01 00:00:00");
$end = strtotime("2019-12-31 23:59:00");

$current = $start;

if (!$handle = fopen("output.html", 'a')) {
    echo "Cannot open file for writing";
    exit;
}

fwrite($handle, "<html><head>" . $css . "</head><body>");

while ($current < $end) {
    $data = str_replace("{{DATE}}", date("d/m/Y", $current), $template);
    $data = str_replace("{{DAY}}", date("l", $current), $data);
    fwrite($handle, $data);
    $current = strtotime(date("Y-m-d", $current) . " + 1 day");
}

fwrite($handle, "</body></html>");
fclose($handle);
