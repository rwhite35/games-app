<?php
namespace EightQueens\Gameboard\Model;

class Validate
{
    
    /**
     * @property QueenSort
     * hashmap of queens(key) with captured ID's as value
     * * proto Array[ [Q101] => Q105, [Q102] => , [Q103] => Q104,... ]
     */
    protected $QueenSort;
    
    
    /**
     * @property CloneProofs
     * read only reference to Solutions Proofs property
     */
    private $CloneProofs;
    
    
    /**
     * @method class constructor
     */
    public function __construct()
    {
        $this->QueenSort = [];
        $this->CloneProofs = [];
        
    }
    
    
    /**
     * @method validateSolution
     * interface method for validating the puzzle soltion. 
     * 
     * @return mixed QueenSort array if captured queens exists,
     * * * Success string if no queens were captured and no errors thrown
     */
    public function validateSolution() {
        
        $validC    = $this->validateRowsColumns(); 
        $validD    = $this->validateDiagonals();
        
        if ( !empty($this->QueenSort ) ) {
            return $this->QueenSort;
            
        } else {
            $mes = "Success! You solved the puzzle.";
            return $mes;
            
        }
        
    }
    
    
    /**
     * @method setProofs
     * setter methods for cloning Solutions Proofs property
     * passed by reference so it is a actual clone of the 
     * current data set.
     * 
     * @param array $Proofs
     */
    public function setProofs( &$Proofs )
    {
        $this->CloneProofs = $Proofs;
        
    }
    
        
    /**
     * @method validateQueensByChunkTotals
     * Only checks queens with matching chunked totals. ignores all others
     * 
     * @todo 20180820, needs refactored using rescursive search function.
     * 
     * @return boolean true when at least one queen has been captured.
     */
    private function validateDiagonals()
    {
        
        foreach( $this->CloneProofs['Q'] as $goodQueenId => $goodQueenArr ) {
            
            if ( is_array( $goodQueenArr['chunked'] ) && 
                    !empty( $goodQueenArr['chunked'] ) 
            ) {
                
                // loop over each of good queens chunked values and search for a match
                foreach( $goodQueenArr['chunked'] as $gqChunkValue ) {
                    
                    $captured = false;
                    
                    // loop over each evil queens chunk searching for matching values.
                    foreach ( $this->CloneProofs['Q'] as $evilQueenId => $evilQueenArr ) {
                        
                        // only check evil queens that have NOT aleady been checked.
                        $eq = substr( $evilQueenId, -1 );   // ie 3 or 4
                        $gq = substr( $goodQueenId, -1 );   // is 5 or 6
                        
                        if (  $eq != $gq && 
                              $eq > $gq &&
                              array_search( $gqChunkValue, $evilQueenArr['chunked'], true ) !== false 
                            ) {
                                
                                $eqCoord    = $this->CloneProofs['Q'][$evilQueenId]['SqrCoord'];
                                $captured   = $this->checkQueensDiagonals( $eqCoord, $goodQueenArr );
                                
                                if ( $captured === true ) $this->QueenSort[ $goodQueenId ] = $evilQueenId;
                            
                        }       // if ckeck evil queen matching chunk total
                        
                    }       // foreach loop evilQueenId
                    
                }       // foreach loop chunked k value
                
            }       // if goodQueen chunked array
            
        }       // foreach loop goodQueenId
        
        return true;    // just means completed
        
    }
    
    
    /**
     * @method checkRowColumns
     * Checks if an evil queen occupies the same row or
     * column as the good queen.  If so the evil queen can be captured.
     * 
     * @return boolean true if one queen was captured, false when no queens
     */
    private function validateRowsColumns()
    {
        
        foreach( $this->CloneProofs['Q'] as $goodQueenId => $goodQueenArr ) {
        
            foreach ( $this->CloneProofs['Q'] as $evilQueenId => $evilQueenArr ) {
            
                if ( substr( $evilQueenId, -1 ) != substr( $goodQueenId, -1 ) )
                    if ( $evilQueenArr['Ycoord'] == $goodQueenArr['Ycoord'] ||
                        $evilQueenArr['Xcoord'] == $goodQueenArr['Xcoord'] )
                            $this->QueenSort[$goodQueenId] = $evilQueenId;
            }
            
        }
        
        return true;    // just means completed
        
    }
    
    
    /**
     * @method checkQueensDiagonals
     * Checks if an evil queen occupies the same diagonal
     * if so, she can be captured.
     * 
     * @return boolean true on success false on no result
     * * false doesn't mean a fail, just that no queens coords were matched
     */
    private function checkQueensDiagonals( string $eqCoord, array $goodQueenArr )
    { 
        
        foreach ($goodQueenArr as $gqId => $gqValue) {
            
            if ( is_array( $gqValue ) && !empty($gqValue) &&
                array_search( $eqCoord, $gqValue ) !== false ) {
                   return true; // matched, exit on first match 
                   
                }
                
        }
        
        return false;
        
    }
    
    
    /**
     * @method queenTakesQueen
     * A brute force check to determine if the good queen can captured another.
     * will check each square and has a time complexity of O^2.
     * Once for the qood queen and again as the evil queen.
     *
     * @param string $goodQueenId, this Queens ID ( Q101, Q108, etc )
     *
     * @param array $queenKeys, enumerated array of queen keys
     * * proto Array[ 0 => Q101,..., 7 => Q108 ]
     *
     * @param array $qSqrId, enumerated array of occupied squares.
     * order correlates to the queen keys Q101 occupies G, Q108 occupies BH
     * * proto Array[ 0 => G,..., 7 => BH ]
     *
     * @param array $matrix, enumerated multidim array holding the
     * gameboards coordinates and square ids. See Model for prototype.
     *
     * @return boolean true when she can capture another queen
     */
    private function queenTakesQueen( string $goodQueenId, array $queenKeys, array $qSqrId, array $matrix )
    {
        $capture        = false;
        $evilQueenId    = [];
        
        /* compare queens coordinates with this Queens movable spaces */
        for ( $i = 0; $i < count($queenKeys); $i++ ) {
            if ( $goodQueenId == $queenKeys[$i] ) {
                continue;           // don't check this Queen
                
            } else {                // get evil queens coord
                $evilQueenId = $this->searchRecursively( $matrix, $qSqrId[$i], $queenKeys[$i] );
                
                error_log( __LINE__ .": the evil queen " . $queenKeys[$i] .
                    " coordinates are " . $evilQueenId[ $queenKeys[$i] ] .
                    " for the space with id " . $qSqrId[$i] );
            }
        }
        
        return $capture;
        
    }
    
    
    /**
     * @method searchRecursively
     * Recurse down through each row and column to return the evil
     * queens coordinates for the square she occupies.
     *
     * @param array $matrix, enumerated multidim array on the gameboard, see Model.
     *
     * @param string $needle, the square id to check ex. square id "U" = Y3,X5 coords
     *
     * @return array $coords hashmap of evil queens square id as key and coords as value
     * * proto Array[ Q103 => 3,5 ]
     */
    private function searchRecursively( array $matrix, string $needle, string $qKey )
    {
        $coords = [];
        foreach( $matrix as $row => $rowspaces ) {
            foreach ( $rowspaces as $k => $v ) {
                if ( $needle === $v ) return $coords = [ $qKey => $row ."," .$k ];
            }
        }
        
    }
}