<?php

namespace Asatir\Content;

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
class Repository implements AppInjectableInterface
{
    use AppInjectableTrait;

    public function getAllFromTable()
    {
        $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);
        return $res;
    }

    public function selectId($id)
    {
        $this->app->db->connect();
        $sql = "SELECT id, title, path, slug, data, type, filter, published FROM content WHERE id = ?;";
        $results = $this->app->db->executeFetchAll($sql, [$id]);
        return $results[0];
    }

    public function updateContent($id, $title, $path, $slug, $data, $type, $filter, $published)
    {
        $this->app->db->connect();
        $sql = "UPDATE content
                SET title = ?,
                    path = ?,
                    slug = ?,
                    data = ?,
                    type = ?,
                    filter = ?,
                    published = ?
                WHERE id = ?";
        $this->app->db->execute($sql, [$title, $path, $slug, $data, $type, $filter, $published, $id]);
    }

    public function fakeDeleteContent($contentId)
    {
        $this->app->db->connect();
        $sql = "UPDATE content
                SET deleted = NOW()
                WHERE id = ?;";
        $this->app->db->executeFetchAll($sql, [$contentId]);
    }

    public function create($title)
    {
        error_log("before create");
        $this->app->db->connect();
        $this->app->db->execute("INSERT INTO content
                (title)
                VALUES (?);", [$title]);
        $sql = "SELECT LAST_INSERT_ID();";
        $res = $this->app->db->executeFetchAll($sql);
        return $res[0];
    }

    public function resetDatabase()
    {
        $this->app->db->connect();
        $config = require(ANAX_INSTALL_PATH . "/config/database.php");
        print_r($config);
        $dsnDetail = [];
        $file = ANAX_INSTALL_PATH . "/sql/content/setup.sql";
        $mysql = "/usr/local/mysql-8.0.14-macos10.14-x86_64/bin/mysql";
        preg_match("/mysql:host=(.+);dbname=([^;.]+)/", $config["dsn"], $dsnDetail);
        $host = $dsnDetail[1];
        $database = $dsnDetail[2];
        $login = $config["username"];
        $password = $config["password"];
        $command = "$mysql -h{$host} -u{$login} -p{$password} $database < $file 2>&1";
        $this->app->db->execute($command);
    }

    public function viewPages()
    {
        $this->app->db->connect();
        $sql = <<<EOD
            SELECT
                *,
                CASE 
                    WHEN (deleted <= NOW()) THEN "isDeleted"
                    WHEN (published <= NOW()) THEN "isPublished"
                    ELSE "notPublished"
                END AS status
            FROM content
            WHERE type=?
            ;
EOD;
        $resultset = $this->app->db->executeFetchAll($sql, ["page"]);
        return $resultset;
    }

    public function viewBlogs()
    {
        $this->app->db->connect();
        $sql = <<<EOD
                SELECT
                    *,
                    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
                    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
                FROM content
                WHERE type=?
                ORDER BY published DESC
                ;
EOD;
        $resultset = $this->app->db->executeFetchAll($sql, ["post"]);
        return $resultset;
    }

    public function getBlogPost($slug)
    {
        $this->app->db->connect();
        $sql = <<<EOD
            SELECT
                *,
                DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
                DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
            FROM content
            WHERE
                slug = ?
                AND type = ?
                AND (deleted IS NULL OR deleted > NOW())
                AND published <= NOW()
            ORDER BY published DESC
            ;
EOD;
        return $this->app->db->executeFetchAll($sql, [$slug, "post"])[0];
    }

    public function getPageContent($route)
    {
        $this->app->db->connect();
        $sql = <<<EOD
                SELECT
                    *,
                    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
                    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
                FROM content
                WHERE
                    path = ?
                    AND type = ?
                    AND (deleted IS NULL OR deleted > NOW())
                    AND published <= NOW()
                ;
EOD;
        return $this->app->db->executeFetchAll($sql, [$route, "page"])[0];
    }

    public function slugAlreadyExists($slug)
    {
        $this->app->db->connect();
        $sql = "SELECT `slug` FROM `content` WHERE `slug`=?";
        $res = $this->app->db->executeFetchAll($sql, [$slug]);
        if ($res > 0) {
            return true;
        }
        return false;
    }
}

