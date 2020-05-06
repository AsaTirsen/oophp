<?php
namespace Asatir\Movie;


class SqlSearch {

    public function getAllFromTable($table)
    {
        $sql = "SELECT * FROM $table;";
        return $sql;
    }







}
