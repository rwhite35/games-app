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
$boardController = new BoardController();

$payload = [
    'description'   => "checkSolution endpoint for testing puzzle solution.",
    'trial'         => json_decode ($_GET['Trial'] ),
    'response'      => []
];

if ( $boardController instanceof BoardController ) {

    $payload['response'] = $boardController->submitAction( $_GET );

    ob_start();
    echo "checkSolution endpoint string: ";
    print_r( $payload['response'] );
    $str = ob_get_clean();
    error_log($str);
    
}

$json = json_encode( $payload );
error_log($json);

header('Content-Type: application/json');
echo $json; 

