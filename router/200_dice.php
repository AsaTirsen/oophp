<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Initialize game and redirect to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    // Init the game;
    $game = new Asatir\Dice\Game();
    $_SESSION["game"] = $game;

    return $app->response->redirect("dice/dice_view");
});


/**
 * // * Play the game - show game status
 * // */
$app->router->get("dice/dice_view", function () use ($app) {
    $game = $_SESSION["game"];
    $title = "Play the game";

    $data = [
        "game" => $game,
    ];
    $app->page->add("dice/dice_view", $data);
    //$app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
/**
 * Make a roll, save the turn or reset the game
 */
$app->router->post("dice/dice_view", function () use ($app) {
    $game = $_SESSION["game"];
    $humanroll = $_POST["humanroll"] ?? null;
    $computerroll = $_POST["computerroll"] ?? null;
    $save = $_POST["save"] ?? null;
    $reset = $_POST["reset"] ?? null;
    if ($humanroll) {
        $game->humanRoll();
    }
    if ($computerroll) {
        $game->computerRoll();
    }
    if ($save) {
        $game->humanSave();
    }
    if ($reset) {
        $game = new Asatir\Dice\Game();
    }
    $_SESSION["game"] = $game;
    return $app->response->redirect("dice/dice_view");
});
