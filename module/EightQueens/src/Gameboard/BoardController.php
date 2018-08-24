<?php 
namespace EightQueens\Gameboard\Controller;

use EightQueens\Gameboard\Model\Board;
use EightQueens\Gameboard\Solutions\Solution;
use Exception;

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
     * @param array $get JSON object passed in from view
     * proto: Array( [0] => Array([queens] => Q106,Q107,Q108, [spaces] => AQ,AW,BH) )
     * 
     * @return string
     */
    static public function submitAction( array $get )
    {
        $trialArray = json_decode( $get['Trial'], true );
        $resultArr  = [];
        $json       = "";
        
        try {
            
            if( $trialArray ) {
                
                $submitSolution = new Solution();
                $submitSolution->setSolutionQueens(
                    $trialArray[0]['queens'],            // string "Q101,Q102,Q103..."
                    $trialArray[0]['spaces']             // string "A,B,C..."
                );
                
                // test this puzzle solution
                $resultArr = $submitSolution->checkSolution();
                // $json = json_encode($resultArr);
                 
            } else {
                throw new Exception( "Submit Action Error:" .
                        " No input array passed to submit action. Killing Process." );
                
            }
            
        } catch( Exception $e ) {
            $mes = $e->getMessage(); 
            error_log( $mes );
            return $mes;
            
        }
        
        return json_encode($resultArr);
        
    }
    
}
?>