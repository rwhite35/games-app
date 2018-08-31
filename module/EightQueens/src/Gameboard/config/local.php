<?php
namespace EightQueens\Gameboard;

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