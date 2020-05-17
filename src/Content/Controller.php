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
class Controller implements AppInjectableInterface
{
    use AppInjectableTrait;

    public $view = [];

    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
//    public function initialize() : void
//    {
//        // Use to initialise member variables.
//        $this->content = new ContentRepository();
//        $this->content->setApp($this->app);
//        $this->route = $this->app->request->getGet("route");    }

    public function indexAction(): object
    {
        $view = $this->app->view;
        $render = $this->app->page;
        $request = $this->app->request;
        $content = new Repository();
        $content->setApp($this->app);
        $route = $this->app->request->getGet("route");
        $textfilter = new MyTextFilter();
        switch ($route) {
            case "":
                $title = "Show all content";
                $data = [
                    "title" => $title,
                    "resultset" => $content->getAllFromTable(),
                ];
                $view->add("content_management/header", []);
                $view->add("content_management/show-all", $data);

                return $render->render($data);

            case "admin":
                $title = "admin";
                $data = [
                    "title" => $title,
                    "resultset" => $content->getAllFromTable(),
                ];
                $view->add("content_management/header", []);
                $view->add("content_management/admin", $data);
                return $render->render($data);


            case "edit":
                //$title = "edit";
                $id = $request->getGet("id");
                var_dump($id);
                $data["content"] = $content->selectId($id);
                $view->add("content_management/header", []);
                $view->add("content_management/edit", $data);
                return $render->render($data);

            case "delete":
                $title = "delete";
                $id = $request->getGet("id");
                $data = [
                    "title" => $title,
                    "content" => $content->selectId($id),
                ];
                var_dump($data);
                $view->add("content_management/header", []);
                $view->add("content_management/delete", $data);
                return $render->render($data);

            case "create":
                $title = "create";
                $data = [
                    "title" => $title
                ];
                $view->add("content_management/header", []);
                $view->add("content_management/create", []);
                return $render->render($data);

            case "reset":
                $title = "reset";
                $data = [
                    "title" => $title
                ];
                $view->add("content_management/header", []);
                $view->add("content_management/reset", []);
                return $render->render($data);

            case "pages":
                $title = "view pages";
                $resultset = $content->viewPages();
                $data = [
                    "title" => $title,
                    "resultset" => $resultset
                ];
                if (!empty($resultset->filter)) {
                    print_r($resultset->data);
                }
                $view->add("content_management/header", []);
                $view->add("content_management/pages", $data);
                return $render->render($data);

            case "blog":
                $title = "view blogposts";
                $resultset = $content->viewBlogs();
                $data = [
                    "title" => $title,
                    "resultset" => $resultset
                ];
                $view->add("content_management/header", []);
                $view->add("content_management/blog", $data);
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
                        $view->add("content_management/header", []);
                        $view->add("content_management/404", $data);
                        return $render->render($data);
                    }
                    $data = [
                        "title" => $title,
                        "content" => $viewcontent,
                    ];
                    $view->add("content_management/header", []);
                    $view->add("content_management/blogpost", $data);
                    return $render->render($data);
                } else {
                    $viewcontent = $content->getPageContent($route);
                    //var_dump($viewcontent->data);
                    // $filter = array_values((array)$content->getFilter($route));
                    $filter = $viewcontent->filter;

                    //$filter = implode($filter);
                    //var_dump($filter);
                    $filter = explode(",", $filter);

                    $rendered = $textfilter->parse($viewcontent->data, $filter);
                    if (!$viewcontent) {
                        $data = [
                            $title = "404",
                        ];
                        $view->add("content_management/header", []);
                        $view->add("content_management/404", $data);
                        return $render->render($data);
                    }
                    $title = "page content";
                    $data = [
                        "title" => $title,
                        "content" => $viewcontent,
                        "rendered" => $rendered
                    ];
                    //var_dump($rendered);

                    $view->add("content_management/header", []);
                    $view->add("content_management/page", $data);
                    return $render->render($data);
                }
        }
    }

    public function editActionPost()
    {
//        $view = $this->app->view;
//        $render = $this->app->page;
        $request = $this->app->request;
        $content = new Repository();
        $fn = new Functions();
        $content->setApp($this->app);
        $contentId = $request->getPost("contentId") ?: $request->getGet("id");
        if (!is_numeric($contentId)) {
            die("Not valid for content id: '" . $contentId . "'");
        }
        error_log("before post");
        if ($fn->hasKeyPost("doSave")) {
            print_r("save");
            $title = $request->getPost("contentTitle");
            $path = $request->getPost("contentPath");
            $slug = $request->getPost("contentSlug");
            $data = $request->getPost("contentData");
            $type = $request->getPost("contentType");
            $filter = $request->getPost("contentFilter");
            $published = $request->getPost("contentPublish");
            if (empty($slug)) {
                $slug = $fn->slugify($title);
            }
            // if slug already exists in db add 1
            if ($content->slugAlreadyExists($slug)) {
                $slug = $slug . "1";
            }

            if (empty($path)) {
                $path = null;
            }

            $content->updateContent($contentId, $title, $path, $slug, $data, $type, $filter, $published);

            return $this->app->response->redirect("content_management?route=admin");
        } elseif ($fn->hasKeyPost("doDelete")) {
            $content->fakeDeleteContent($contentId);
            return $this->app->response->redirect("content_management?route=admin");

        } elseif ($request->getPost("doReset")) {
            return $this->app->response->redirect("content_management?route=edit");
        }
    }

    public function deleteActionPost()
    {
        $request = $this->app->request;
        $content = new Repository();
        $content->setApp($this->app);
        $contentId = $request->getPost("contentId") ?: $request->getGet("id");
        if (!is_numeric($contentId)) {
            die("Not valid for content id.");
        }
        $content->fakeDeleteContent($contentId);
        return $this->app->response->redirect("content_management?route=admin");


    }

    public function createActionPost()
    {
        $request = $this->app->request;
        $content = new Repository();
        $content->setApp($this->app);
        if ($request->getPost("doCreate")) {
            if (!isset($title)) {
                print_r("Enter a title");
            }
            $title = $request->getPost("contentTitle");
            $contentId = implode((array)$content->create($title));
            return $this->app->response->redirect("content_management?route=edit&id=" . $contentId);
        } elseif ($request->getPost("doReset")) {
            return $this->app->response->redirect("content_management?route=create");
        }
    }

    public function resetActionPost()
    {
        error_log(print_r('reset'));
        $request = $this->app->request;
        $content = new Repository();
        $content->setApp($this->app);
        if ($request->getPost("doReset")) {
            $content->resetDatabase();
            return $this->app->response->redirect("content_management?route=");
        } else {
            return $this->app->response->redirect("content_management?route=");
        }
    }
}
