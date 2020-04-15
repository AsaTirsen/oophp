<?php

session_name("asti18");
session_start();

if (!isset($_SESSION["guess"])) {
    $guess = new Guess();
    $_SESSION["guess"] = $guess;
}
if (!isset($_SESSION["doCheat"])) {
    $_SESSION["doCheat"] = null;
}

$guess = $_SESSION["guess"];
