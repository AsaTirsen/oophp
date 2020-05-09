<?php

namespace Asatir\Movie;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Anax\Database\Database;

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

    public function searchYearTwoArgs($year1, $year2)
    {
        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
        $res = $this->app->db->executeFetchAll($sql, [$year1, $year2]);
        return $res;
    }

    public function searchYearYear1($year1)
    {
        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE year >= ?;";
        $res = $this->app->db->executeFetchAll($sql, [$year1]);
        return $res;
    }

    public function searchYearYear2($year2)
    {
        $this->app->db->connect();
        $sql = "SELECT * FROM movie WHERE year <= ?;";
        $res = $this->app->db->executeFetchAll($sql, [$year2]);
        return $res;
    }

    public function resetDatabase()
    {
        $this->app->db->connect();
        $this->app->db->executeFetchAll("DROP TABLE IF EXISTS `movie`");
        $this->app->db->executeFetchAll("
            CREATE TABLE `movie`
            (
            `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                `title` VARCHAR(100) NOT NULL,
                `director` VARCHAR(100),
                `length` INT DEFAULT NULL,            -- Length in minutes
                `year` INT NOT NULL DEFAULT 1900,
                `plot` TEXT,                          -- Short intro to the movie
                `image` VARCHAR(100) DEFAULT NULL,    -- Link to an image
                `subtext` CHAR(3) DEFAULT NULL,       -- swe, fin, en, etc
                `speech` CHAR(3) DEFAULT NULL,        -- swe, fin, en, etc
                `quality` CHAR(3) DEFAULT NULL,
                `format` CHAR(3) DEFAULT NULL         -- mp4, divx, etc
            ) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci
        ");
        $this->app->db->executeFetchAll("DELETE FROM `movie`");
        $this->app->db->executeFetchAll("
            INSERT INTO `movie` (`title`, `year`, `image`) VALUES
                ('Pulp fiction', 1994, 'img/pulp-fiction.jpg'),
                ('American Pie', 1999, 'img/american-pie.jpg'),
                ('Pokémon The Movie 2000', 1999, 'img/pokemon.jpg'),
                ('Kopps', 2003, 'img/kopps.jpg'),
                ('From Dusk Till Dawn', 1996, 'img/from-dusk-till-dawn.jpg')
        ");
    }

    public function selectIdTitle()
    {
        $this->app->db->connect();
        $sql = "SELECT id, title FROM movie;";
        $movies = $this->app->db->executeFetchAll($sql);
        return $movies;
    }

    public function selectMovie($movieId)
    {
        $this->app->db->connect();
        $sql = "SELECT id, title, year, image FROM movie WHERE id = ?;";
        $movie = $this->app->db->executeFetchAll($sql, [$movieId]);
        return $movie[0];
    }

    public function updateMovie($movieTitle, $movieYear, $movieImage, $movieId)
    {
        $this->app->db->connect();
        $sql = "UPDATE movie 
                SET title = ?, 
                    year = ?,
                    image = ?
                WHERE id = ?;";
        $movie = $this->app->db->executeFetchAll($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        return $movie;
    }

    public function addMovie($movieTitle, $movieYear, $movieImage)
    {
        $this->app->db->connect();
        $sql = "INSERT into movie (title, year, image)
                VALUES (?, ?, ?);";
        $movie = $this->app->db->executeFetchAll($sql, [$movieTitle, $movieYear, $movieImage]);
        return $movie;
    }

    public function deleteMovie($movieId)
    {
        $this->app->db->connect();
        $sql = "DELETE FROM movie WHERE id = ?;";
        $this->app->db->executeFetchAll($sql, [$movieId]);
    }
}
