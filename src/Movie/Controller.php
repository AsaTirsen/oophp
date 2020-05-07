<?php

namespace Asatir\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

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


    public function indexAction(): object
    {
        // Deal with the action and return a response.
        $title = "Movie database | oophp";

        $this->app->db->connect();
        $movie = new MovieRepository();
        $movie->setApp($this->app);
        $route = $this->app->request->getGet("route");

        switch ($route) {
            case "":
                $data["resultset"] = $movie->getAllFromTable();
                $this->app->view->add("movie/index", $data);
                return $this->app->page->render($data);
                break;

            case "search-title":
                $searchTitle = $this->app->request->getGet("searchTitle");
                if (!$searchTitle) {
                    $this->app->page->add("movie/search-title", []);
                    return $this->app->page->render(["movie/search-title" => []]);
                } elseif ($searchTitle) {
                    $data["resultset"] = $movie->searchTitle($searchTitle);
                    $this->app->page->add("movie/index", $data);
                    return $this->app->page->render($data);
                }
                break;

            case "reset":
                $data["resultset"] = $movie->getAllFromTable();
                $this->app->view->add("movie/index", $data);
                break;

            case "search-year":
                $data["resultset"] = $movie->getAllFromTable();
                $this->app->view->add("movie/index", $data);
                break;

            case "movie-select":
                $data["resultset"] = $movie->getAllFromTable();
                $this->app->view->add("movie/index", $data);
                break;

            case "movie-edit":
                $data["resultset"] = $movie->getAllFromTable();
                $this->app->view->add("movie/index", $data);
                break;

            case "show-all-sort":
                $data["resultset"] = $movie->getAllFromTable();
                $this->app->view->add("movie/index", $data);
                break;

            case "show-all-paginate":
                $data["resultset"] = $movie->getAllFromTable();
                $this->app->view->add("movie/index", $data);
                break;
        }
            //return $this->app->page->render($data);
        }
    }
