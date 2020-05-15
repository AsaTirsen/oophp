<?php

namespace Anax\View;

//
//// Include essentials
//require __DIR__ . "/../src/config.php";
//require __DIR__ . "/../vendor/autoload.php";
//require __DIR__ . "/../src/TextFilter/MyTextFilter.php";
//
//
///**
// * Helper, Markdown formatting converting to HTML.
// *
// * @param string text The text to be converted.
// *
// * @return string the formatted text.
// *
// * @SuppressWarnings(PHPMD.StaticAccess)
// */
//
//$filter = new MyTextFilter();
//
//$text = file_get_contents(__DIR__ . "/../text/sample.md");
//
//$html = $filter->parse($text, ["markdown"]);


?><!doctype html>
<html>
<meta charset="utf-8">
<title>Show off Markdown</title>

<h1>Showing off Markdown</h1>

<h2>Markdown source in sample.md</h2>
<pre><?= $text ?></pre>

<h2>Text formatted as HTML source</h2>
<pre><?= htmlentities($html) ?></pre>

<h2>Text displayed as HTML</h2>
<?= $html ?>
