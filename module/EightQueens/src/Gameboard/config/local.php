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

class Module
{
    public $configs;
    
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