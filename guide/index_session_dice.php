<?php
/**
 * Created by PhpStorm.
 * User: asa
 * Date: 23/4/19
 * Time: 3:22 PM
 */


session_name("asti18");
session_start();

if (!isset($_SESSION["dice"])) {
    $dice = new Dice();
    $_SESSION["dice"] = $dice;
}


$dice = $_SESSION["dice"];
