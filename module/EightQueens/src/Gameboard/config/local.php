<?php
namespace EightQueens\Gameboard;
/**
 * Gameboard Module class is the first class loaded when the 
 * game is bootstrapped on laoding index.  Module class
 * defines global configurations and establishes a cache
 * for persistent data with a Time To Live of 3600 seconds or 1 hour.
 * 
 * Caching is handled through Symfony Cache Component(4.0).  
 * 
 * @author ronwhite
 *
 */

use Symfony\Component\Cache\Adapter\FilesystemAdapter;  // PSR 6
use Symfony\Component\Cache\Simple\FilesystemCache;     // PSR 16
use DateTime;

class Module
{
    
    public $configs;
    
    
    /**
     * Initializes Cache for storing persistent game data like
     * solutions submit count, player UUID and other data.
     *
     * Creates a new filesystem cache item if one doesn't already
     * exist. stdClass object has a prototype of:
     * $Array = [
     * * [uuid] => (string) 71486d66-502c-4e6f-87f7-d393e9939f2d
     * * [timestamp] => (date) 1535842695 = 2018-09-01 18:58:15
     * * [trial_count] 	=> (int) 0
     * ]
     *
     * @return boolean true on completed
     */
    public function initGameCache( string $uuid, int $subcount )
    {
        $gameCache = new FilesystemAdapter();       // Symfony\Component\Cache
        $playerItem = $gameCache->getItem( player ."_". $uuid );
        
        if ( !$playerItem->isHit() ) {              // its a new player
            $date = new DateTime();
            $playerItem->expiresAfter(3600);        // one hour
            
            $playerItem->set( array(
                'uuid'          => $uuid,
                'timestamp'     => $date->format('U = Y-m-d H:i:s'),
                'trial_count'   => $subcount + 1
            ) );
            
            $gameCache->save( $playerItem );
            
            $array = $playerItem->get();
            $key = $playerItem->getKey();
            
            ob_start();
            echo ( __LINE__ . ": Gameboard\Module->initGameCache created new cache item " .
                "with key $key and values " );
            print_r($array);
            $str = ob_get_clean();
            error_log($str);
            
        } else {  // player already exist, do nothing.
            $key = $playerItem->getKey();
            error_log( __LINE__ .": initGameCache player with key $key already exists." );
            
        }
        
        return true;
        
    }
    
    
    /**
     * get players trial count from game cache
     * called from BoardController->submitAction.
     * 
     * @uses object Symfony\Component\Cache
     * @var array $array, this users cached data.
     * * proto Array = [ [uuid]=>(string)e0e...f0c9, 
     * * [timestamp]=>(date)1535891381 = 2018-09-02 08:29:41
     * * [trial_count]=>(int)1 ]
     *
     * @return mixed false on no hit or integer - trial count
     */
    public function getPlayerTrialCnt( string $uuid )
    {
        $trial_count    = 0;
        $plyUuid        = "player_" . $uuid;
        $gameCache      = $gameCache = new FilesystemAdapter();
        $playerItem     = $gameCache->getItem( $plyUuid );
        
        if( !$playerItem->isHit() ) {
            error_log( __LINE__ .": Gameboard\Module->getPlayerTrialCnt doesn't have items " .
                "cache key for $plyUuid." );
            
            return false;
            
        } else {
            error_log( __LINE__ .": Gameboard\Module->getPlayerTrialCnt has player item, " .
                "getting count for " . $playerItem->getKey() );
            // $key = $playerItem->getKey();
            $array = $playerItem->get();
            /*
            ob_start();
            echo ( __LINE__ . ": Gameboard\Module->getPlayerTrialCnt has cached item " .
                "with key $key and values " );
            print_r($array);
            $str = ob_get_clean();
            error_log($str);
            */
            return $array['trial_count'];
            
        }
        
        
    }
    
    
    /**
     * global game configurations used for calling resouces
     * NOT managed through the autoloader.  
     * 
     * @return string[]|string[][][][]|string[][][][][]
     */
    public function getConfig()
    {
        $config = [
            'router' => [
                'routes' => [
                    'board' => [
                        'route' => "/board",
                        'defaults' => [
                            'model'         => "EightQueens\\Gameboard\\Model\\Board",
                            'view'          => "",
                            'controller'    => "EightQueens\\Gameboard\\Controller\\BoardController"
                        ],
                    ],
                    'validate' => [
                        'route' => "/validate",
                        'defaults'  => [
                            'model'         => "EightQueens\\Gameboard\\Model\\Validate",
                        ],
                    ],
                    'solution' => [
                        'route' => "/solution",
                        'defaults' => [
                            'view'          => "EightQueens\\Gameboard\\Solutions\\Solution",
                            
                        ],
                    ],
                    'calcdiagonals' => [
                        'route' => "/calcdiagonals",
                        'defaults' => [
                            'interface'     => "EightQueens\\Gameboard\\CalcDiagonalsInterface",
                            'controller'    => "EightQueens\\Gameboard\\Calculate\\Diagonals\\CalcDiagonals"
                        ],
                    ],
                ],
            ],
            
            'basePath' => __DIR__,
            
        ];
        
        return $config;
    }
    
}
?>