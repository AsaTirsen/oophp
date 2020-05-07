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
class MovieRepository implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function getAllFromTable()
    {
        $this->app->db->connect();
        $sql = "SELECT * FROM movie;";
        $res = $this->app->db->executeFetchAll($sql);
        return $res;
    }

    public function searchTitle($title)
    {
        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $res = $this->app->db->executeFetchAll($sql, [$title]);
        return $res;
    }
}
