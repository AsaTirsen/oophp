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

     public function initDatabase(): object
        {
            $response = $this->app->response;
            $title = "Movie database | oophp";
            $app->router->get("movie", function () use ($app) {
                $app->db->connect();
                $res = $app->db->executeFetchAll($sql);
            }

            $app->db->connect();
            //$session = $this->app->session;
            $movie = new SqlSearch();
            $sql = $movie->getAllFromTable("movie");
            //$session->set("game", $game);
            return $response->redirect("movie/index");
        }

}

$app->router->get("movie", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("movie/index", $data);

    $app->page->render($data);
});
