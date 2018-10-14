<?php 
namespace EightQueens\Gameboard\Controller;

use EightQueens\Gameboard\Model\Board;
use EightQueens\Gameboard\Solutions\Solution;
use Exception;
use EightQueens\Gameboard\Module;

class BoardController extends Board
{
    /**
     * Model properties
     * @var int game grids X and Y size (8 x 8) 
     */
    protected $Board;
    
    
    public function __construct()
    {
        $this->Board = new Board();
    }
    
    
    /**
     * @method boardAction
     * instantiated on initial load from view/board view.
     * data set for an 8 x 8 game board
     * 
     * @return array|string
     */
    public function boardAction()
    {
        $matrix = $this->Board->boardMatrix();
        return $matrix;
        
    }
    
    
    /**
     * @method submitAction
     * called on submit from view. decodes json object.
     * expects an indexed array of associative arrays see prototype.
     * instantiates the Solutions class which test the submitted solution
     *  
     * @param array $get JSON input from users submission
     * * proto: Array( [0] => Array(
     * * *  [queens] => Q101,..,Q108, [spaces] => AQ,..,BH, [interval] => 00:00:00 ) )
     * 
     * @return array $resultArr, output check process result and UI feedback
     * * proto Array = [ status=>string, message=>string, captured=>[array|empty] ] 
     */
    static public function submitAction( array $get )
    {
        $trialArray = json_decode( $get['Trial'], true );
        $resultArr  = [];
        $json       = "";
        $exclamation = Board::$Exclamations;        // Model\Board property
        $module  = new Module();                    // Gameboard\Module
        $trialCntCached = $module->getPlayerTrialCnt( $trialArray[0]['uuid'] );
        error_log( __LINE__ .": submitAction got trial count from cache ".
            "with count $trialCntCached." );
        
        try {
            
            if( $trialArray ) {
                
                $submitSolution = new Solution();
                $submitSolution->setSolutionQueens(
                    $trialArray[0]['queens'],       // string "Q101,Q102,Q103..."
                    $trialArray[0]['spaces'],       // string "A,B,C..."
                    $trialArray[0]['interval'],     // string "00:00:35"
                    $trialArray[0]['uuid']          // string "4560...aaf25"
                );
                
                $newTrialCnt = $trialCntCached + $trialArray[0]['trial_count'];
                
                /* insert record in to db */
                error_log( __LINE__ .": submitAction player " .
                    "with UUID " . $trialArray[0]['uuid'] . " solved puzzle " .
                        "in " . $trialArray[0]['interval'] . " for the " .
                        "spaces " . $trialArray[0]['spaces'] . " and " .
                        "trial count " . $newTrialCnt );
                
                /* check solution for solve */
                $resultArr = $submitSolution->checkSolution();
                
                /* provide some additional feedback when the solution fails. 
                 * If successful [captured] is empty and a success message
                 * sent from Solution > Validate->validateSolution is passed */
                if ( !empty( $resultArr['captured'] ) ) {
                    $i = array_rand($exclamation, 1);
                    $qc = count( $resultArr['captured'] );
                    $resultArr['message'] = $exclamation[$i] .
                        " Looks like $qc Queens are captured.";
                }
                 
            } else {
                throw new Exception( "Submit Action Error:" .
                        " No input array passed to submit action. Killing Process." );
                
            }
            
        } catch( Exception $e ) {
            $resultsArr = [
                'status'    => "500",
                'message'   =>  $e->getMessage()
            ];
            
        }
        
        // pushed encoding back to endpoint script. 
        return $resultArr;
        
    }
    
}
?>