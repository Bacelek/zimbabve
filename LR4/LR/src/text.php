<?php
require_once __DIR__ . '/helperFunctions.php';

$text = $_POST['text'];


$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<div>'. mb_convert_encoding($text, 'HTML-ENTITIES', 'UTF-8') .'</div>',LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

$images = getImages($dom);
$replaced = replace($dom);
$tables = findTables($dom);
if (!empty($tables)){
    $allTables = $tables['tables'];
    $tableContent = $tables['content'];
}
$replacePick = replacePick($dom);


