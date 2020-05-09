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
        //$this->app->db->connect();
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
                return $this->searchTitle();

            case "reset":
                $this->app->page->add("movie/reset", []);
                return $this->app->page->render(["movie/reset" => []]);

            case "search-year":
                return $this->searchYear();

            case "movie-select":
                $data["movies"] = $movie->selectIdTitle();
                $this->app->view->add("movie/movie-select", $data);
                return $this->app->page->render($data);

            case "movie-edit":
                $movie = new MovieRepository();
                $movie->setApp($this->app);
                $request = $this->app->request;
                $movieId = $request->getGet("movieId");
                $data["movie"] = $movie->selectMovie($movieId);
                $this->app->page->add("movie/movie-edit", $data);
                return $this->app->page->render();

            case "movie-add":
                $data["movie"] = (object)[
                    "id" => "",
                    "title" => "",
                    "year" => "",
                    "image" => ""
                ];

                $this->app->view->add("movie/movie-edit", $data);
                return $this->app->page->render($data);
        }
    }

    public function resetActionPost(): object
    {
        $movie = new MovieRepository();
        $movie->setApp($this->app);
        $request = $this->app->request;
        if ($request->getPost("reset")) {
            $movie->resetDatabase();
            return $this->app->response->redirect("movie/index");
        }
    }

    public function movieselectActionPost(): object
    {
        $movie = new MovieRepository();
        $movie->setApp($this->app);
        $request = $this->app->request;
        $movieId = $request->getPost("movieId");
        if ($request->getPost("doAdd")) {
            return $this->app->response->redirect("movie?route=movie-add");
        }
        if ($request->getPost("doEdit")) {
            return $this->app->response->redirect("movie?route=movie-edit&movieId=" . $movieId);
        }
        if ($request->getPost("doDelete")) {
            $movie->deleteMovie($movieId);
            return $this->app->response->redirect("movie/index");
        }
    }

    public function movieeditActionPost(): object
    {
        $movie = new MovieRepository();
        $movie->setApp($this->app);
        $request = $this->app->request;
        $movieTitle = $request->getPost("movieTitle");
        $movieYear = $request->getPost("movieYear");
        $movieImage = $request->getPost("movieImage");
        $movieId = $request->getPost("movieId");
        if ($movieId != "") {
            $movie->updateMovie($movieTitle, $movieYear, $movieImage, $movieId);
            return $this->app->response->redirect("movie/index");
        } else {
            $movie->addMovie($movieTitle, $movieYear, $movieImage);
            return $this->app->response->redirect("movie/index");
        }
    }

    /**
     * @param MovieRepository $movie
     * @param $data
     * @return mixed
     */
    public function searchYear()
    {
        $movie = new MovieRepository();
        $movie->setApp($this->app);
        $year1 = $this->app->request->getGet("year1");
        $year2 = $this->app->request->getGet("year2");
        if (!$year1 && !$year2) {
            $this->app->page->add("movie/search-year", []);
            return $this->app->page->render(["movie/search-year" => []]);
        } elseif ($year1 && $year2) {
            $data["resultset"] = $movie->searchYearTwoArgs($year1, $year2);
            $this->app->page->add("movie/index", $data);
            return $this->app->page->render($data);
        } elseif ($year1) {
            $data["resultset"] = $movie->searchYearYear1($year1);
            $this->app->page->add("movie/index", $data);
            return $this->app->page->render($data);
        } elseif ($year2) {
            $data["resultset"] = $movie->searchYearYear2($year2);
            $this->app->page->add("movie/index", $data);
            return $this->app->page->render($data);
        }
    }

    /**
     * @param MovieRepository $movie
     * @param $data
     * @return mixed
     */
    public function searchTitle()
    {
        $movie = new MovieRepository();
        $movie->setApp($this->app);
        $searchTitle = $this->app->request->getGet("searchTitle");
        if (!$searchTitle) {
            $this->app->page->add("movie/search-title", []);
            return $this->app->page->render(["movie/search-title" => []]);
        } elseif ($searchTitle) {
            $data["resultset"] = $movie->searchTitle($searchTitle);
            $this->app->page->add("movie/index", $data);
            return $this->app->page->render($data);
        }
    }
}
