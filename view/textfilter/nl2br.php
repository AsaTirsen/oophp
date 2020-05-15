<?php
namespace Anax\View;


//
//// Include essentials
//require __DIR__ . "/../src/config.php";
//require __DIR__ . "/../vendor/autoload.php";
//require __DIR__ . "/../src/TextFilter/MyTextFilter.php";
//
//
//
//$filter = new MyTextFilter();
//$text = file_get_contents(__DIR__ . "/../text/bbcode.txt");
//$html = $filter->parse($text, ["bbcode"]);
//

?><!doctype html>
<html>
<meta charset="utf-8">
<title>Test newline</title>
<h2> Bara text utan nl2br filter</h2>
<?= $html ?>
<h2>Filter for newline HTML, med filter nl2br</h2>
<?= $nl2br ?>
