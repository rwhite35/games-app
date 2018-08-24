<?php
chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';

use EightQueens\Gameboard\Controller\BoardController;
$boardController = new BoardController();

$json = "checkSolution checking submitted solution.";

if ( $boardController instanceof BoardController ) {
    
    $resultArr = $boardController->submitAction( $_GET );

    ob_start();
    echo "";
    print_r($resultArr);
    $str = ob_get_clean();
    error_log($str);
    
    $json = json_encode($resultArr);
    error_log($json);  
}

header('Content-Type: application/json');
echo $json; 

