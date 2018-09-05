<?php
/**
 * checkSolution (psuedo) endpoint for EightQueens game.
 * 
 * This script provides a simple Plain Old Script entity 
 * that handles input/output for backend process.
 * 
 * Instantiates the game cache, if this is a new player,
 * create a new cache using the UUID as a unique identifier.
 * If cache for this player already exist, simply returns true. 
 * 
 * @TODO 20180823 need converted to a RESTful implementation
 * once other games are released, but for now, this will due.
 * 
 */
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

use EightQueens\Gameboard\Controller\BoardController;
use EightQueens\Gameboard\Module;

$boardController = new BoardController();
$gameCache = new Module();      // Gameboard\Module->initGameCache

$payload = [
    'description'   => "checkSolution endpoint for testing puzzle solution.",
    'trial'         => json_decode ( $_GET['Trial'], true ), // true, force array
    'response'      => []
];

/* checks for this UUID */
$gpbool = $gameCache->initGameCache(
    $payload['trial'][0]['uuid'],
    $payload['trial'][0]['trial_count']
 );

if ( $gpbool == true ) error_log( __LINE__ .": initGameCache cache is available." );

if ( $boardController instanceof BoardController )
    $payload['response'] = $boardController->submitAction( $_GET );

$json = json_encode( $payload );

header('Content-Type: application/json');
echo $json; 

