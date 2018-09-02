<?php
/**
 * checkSolution (psuedo) endpoint for EightQueens game.
 * 
 * This script provides a simple callable entity that will
 * contract with the backend to process input request and 
 * returns output response.
 * 
 * @TODO 20180823 need to setup a RESTful route, but for now
 * using plain old PHP script
 * 
 */
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

use EightQueens\Gameboard\Controller\BoardController;
use EightQueens\Gameboard\Module;

$boardController = new BoardController();
$gameCache = new Module(); // Gameboard\Module->initGameCache

$payload = [
    'description'   => "checkSolution endpoint for testing puzzle solution.",
    'trial'         => json_decode ( $_GET['Trial'], true ), // decode as array
    'response'      => []
];


/* Initialize game cache if not already set for this player. 
 * Sets the UUID as players cache key */
$gpbool = $gameCache->initGameCache(
    $payload['trial'][0]['uuid'],
    $payload['trial'][0]['trial']
 );

if ( $gpbool == true ) error_log( __LINE__ .": initGameCache returned true, cache is available." );

if ( $boardController instanceof BoardController )
    $payload['response'] = $boardController->submitAction( $_GET );

$json = json_encode( $payload );

header('Content-Type: application/json');
echo $json; 

