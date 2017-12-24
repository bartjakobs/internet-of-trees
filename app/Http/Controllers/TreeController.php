<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tree;
use App\Http\Requests\CreateTree;
use App\Http\Requests\ModifyTree;
class TreeController extends Controller
{
    
    /**
     * List all this users' trees;
     */
    public function getTrees(){
        return Auth::user()->trees()->get();
    }

    /**
     * Get a specific tree.
     */
    public function getTree($treeId){
        $tree = Tree::find($treeId);
        if(!$tree){
             return response(['message' => 'Tree not found'], 404);
        }
        if($tree->user_id !== Auth::id()){
            return response(['message' => 'Not your tree'], 403);
        }
        return $tree;
    }

    /**
     * Create a new tree.
     * Returns 422 error if validation fails.
     */
    public function createTree(CreateTree $request){
        // get data. 
        // The data has already been validated by CreateTree Request class.

        $name = $request->get('name');
        $location = $request->get('name');
        $decorations = $request->get('decorations');
        $ison = $request->get('ison') == 'true';

        // Make the tree
        $tree = new Tree();
        $tree['name'] = $name;
        $tree['location'] = $location;
        $tree['decorations'] = $decorations;
        $tree['ison'] = $ison;
        $tree['user_id'] = Auth::id();
        $tree->save();

        // Return the tree!
        return ['result' => 'created', 'tree' => $tree];
    }

    /**
     * Modify the properties of a specific tree
     */
    public function modifyTree($treeId, ModifyTree $request){
        $tree = $this->getTree($treeId);
        if(get_class($tree) != "App\\Tree"){
            return $tree; // error
        }else{
            // Get all the data!
            $tree['name'] = $request->input('name', $tree['name']);
            $tree['location'] = $request->input('location', $tree['location']);
            $tree['decorations'] = intval($request->input('decorations', $tree['decorations']));
            $ison = $request->input('ison', $tree['ison']);
            if($ison == 'true' || $ison == '1') $ison = true; else $ison = false;
            $tree['ison'] = $ison;
        }
        $tree->save();
        return ['result' => 'saved', 'tree' => $tree];
    }

    /**
     * Delete a tree.
     */
    public function deleteTree($treeId){
        $tree = $this->getTree($treeId);
        if(get_class($tree) != "App\\Tree"){
            return $tree; // error
        }
        $tree->delete();
        return ['result' => 'deleted'];
    }
}
