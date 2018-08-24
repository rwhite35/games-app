<?php
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PHP_SELF'], '/') );
$jsonArr = [
    "root"      => $request[0],
    "parent"    => $request[1],
    "public"    => $request[2],
    "script"    => $request[3]
];

$input = json_decode( file_get_contents('php://input'), true);

ob_start();
print_r($input);
$str = ob_get_clean();
error_log($str);

/*
$mes = "checkSolution request: ";
$mes .= " request method $method ";
$mes .= " path request path: ";
print_r($request);
$mes .= " json input ";
print_r($input);
$str = ob_get_clean();
error_log($str);
*/

/*
if( !isset($_GET['Trial']) ) { $aResult['error'] = 'No function name!'; }

if ( is_callable( Gameboard::submitAcion ) ) {
    $mes = "we can call submitAction method!";
} else {
    $mes = "wasn't able to call submitAction.";
}
*/
$json = json_encode($jsonArr);
error_log($json);
header('Content-Type: application/json');
echo $json; 

