<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tree;
use App\User;
class StatisticsController extends Controller
{


    /**
     * Some simple statistics for the marvelous Internet of Trees!
     */
    public function getStatistics(){
        $numTrees = Tree::count();
        $numUsers = User::count();
        $allTrees = Tree::all();
        $numDecorations = 0;
        $numOn = 0;
        foreach($allTrees as $tree){
            $numDecorations += $tree->decorations;
            if($tree->ison) $numOn++;
        }
        $averageTreePerUser = $numTrees / $numUsers;        
        return ['totalTrees' => $numTrees,
                'totalUsers' => $numUsers,
                'averageTreesPerUser' => $averageTreePerUser,
                'totalDecorations' => $numDecorations,
                'totalOn' => $numOn,
                'averageDecorationsPerTree' => $numDecorations / $numTrees
                ];
    }
}
