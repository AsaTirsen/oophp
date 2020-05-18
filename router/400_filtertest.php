<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * shows example for how to apply filter bbcode
 */


$app->router->get("bbcode", function () use ($app) {

    $title = "Test bbcode";
    $filter = new Asatir\TextFilter\src\MyTextFilter();
    $text = file_get_contents(__DIR__ . "/../text/bbcode.txt");
    $html = $filter->parse($text, ["bbcode"]);
    $data = [
        "title" => $title,
        "text" => $text,
        "filter" => $filter,
        "html" => $html
    ];
    $app->page->add("textfilter/bbcode", $data);
    //$app->page->add("dice/debug");

    return $app->page->render($data);
});


/**
 * shows example for how to apply filter makeClickable
 */

$app->router->get("link", function () use ($app) {

    $title = "Test makeClickable";
    $filter = new Asatir\TextFilter\src\MyTextFilter();
    $text = file_get_contents(__DIR__ . "/../text/clickable.txt");
    $html = $filter->parse($text, ["link"]);
    $data = [
        "title" => $title,
        "text" => $text,
        "filter" => $filter,
        "html" => $html
    ];
    $app->view->add("textfilter/clickable", $data);
    //$app->page->add("dice/debug");

    return $app->page->render($data);
});


/**
 * shows example for how to apply filter markdown
 */

$app->router->get("markdown", function () use ($app) {

    $title = "Test Markdown";
    $filter = new Asatir\TextFilter\src\MyTextFilter();
    $text = file_get_contents(__DIR__ . "/../text/sample.md");
    $html = $filter->parse($text, ["markdown"]);
    $data = [
        "title" => $title,
        "text" => $text,
        "filter" => $filter,
        "html" => $html
    ];
    $app->view->add("textfilter/markdown", $data);
    //$app->page->add("dice/debug");

    return $app->page->render($data);
});


/**
 * shows example for how to apply filter markdown
 */

$app->router->get("nl2br", function () use ($app) {

    $title = "Test nl2br";
    $filter = new Asatir\TextFilter\src\MyTextFilter();
    $text = file_get_contents(__DIR__ . "/../text/bbcode.txt");
    $html = $filter->parse($text, ["bbcode"]);
    $nl2br = $filter->parse($html, ["nl2br"]);
    $data = [
        "title" => $title,
        "text" => $text,
        "filter" => $filter,
        "html" => $html,
        "nl2br"=> $nl2br,
    ];
    $app->view->add("textfilter/nl2br", $data);
    //$app->page->add("dice/debug");

    return $app->page->render($data);
});
