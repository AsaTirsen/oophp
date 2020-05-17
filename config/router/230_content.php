<?php
/**
 * Routes to ease testing.
 */
return [
    // Path where to mount the routes, is added to each route path.
    // All routes in order
    "routes" => [
        [
            "info" => "Content controller",
            "mount" => "content",
            "handler" => "\Asatir\Content\BloggController",
        ],
//        [
//            "info" => "Sample controller di style.",
//            "mount" => "di",
//            "handler" => "\Anax\Controller\SampleController",
//        ],
//        [
//            "info" => "Sample controller di style with json responses.",
//            "mount" => "json",
//            "handler" => "\Anax\Controller\SampleJsonController",
//        ],
    ]
];
