<?php

namespace Asatir\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Asatir\Content\Repository;
use Asatir\TextFilter\src\MyTextFilter;
use function Anax\View\url;


// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class BloggController implements AppInjectableInterface
{
    use AppInjectableTrait;

    public $view = [];

    public function indexAction(): object
    {
        $view = $this->app->view;
        $render = $this->app->page;
        $request = $this->app->request;
        $textfilter = New MyTextFilter();
        $content = new Repository();
        $content->setApp($this->app);
        $route = $this->app->request->getGet("route");
        switch ($route) {
            case "":
                $title = "Show all content";
                $data = [
                    "title" => $title,
                    "resultset" => $content->getAllFromTable(),
                ];
                $view->add("content/header", []);
                $view->add("content/show-all", $data);

                return $render->render($data);

            case "pages":
                $title = "view pages";
                $resultset = $content->viewPages();
                $data = [
                    "title" => $title,
                    "resultset" => $resultset
                ];
                $view->add("content/header", []);
                $view->add("content/pages", $data);
                return $render->render($data);

            case "blog":
                $title = "view blogposts";
                $resultset = $content->viewBlogs();
                $data = [
                    "title" => $title,
                    "resultset" => $resultset
                ];
                $view->add("content/header", []);
                $view->add("content/blog", $data);
                return $render->render($data);


            default:
                if (substr($route, 0, 5) === "blog/") {
                    $slug = substr($route, 5);
                    $title = "blogpost";
                    $viewcontent = $content->getBlogPost($slug);
                    if (!$viewcontent) {
                        $data = [
                            $title = "404",
                        ];
                        $view->add("content/header", []);
                        $view->add("content/404", $data);
                        return $render->render($data);
                    }
                    $data = [
                        "title" => $title,
                        "content" => $viewcontent,
                    ];
                    $view->add("content/header", []);
                    $view->add("content/blogpost", $data);
                    return $render->render($data);
                } else {
                    $viewcontent = $content->getPageContent($route);
                    if (!$viewcontent) {
                        $data = [
                            $title = "404",
                        ];
                        $view->add("content/header", []);
                        $view->add("content/404", $data);
                        return $render->render($data);
                    }
                    $title = "page content";
                    $data = [
                        "title" => $title,
                        "content" => $viewcontent
                    ];
                    $view->add("content/header", []);
                    $view->add("content/page", $data);
                    return $render->render($data);
                }
        }
    }
}
