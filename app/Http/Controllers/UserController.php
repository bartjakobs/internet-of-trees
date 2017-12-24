<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\User;
class UserController extends Controller
{
    
    /**
     * Register a user.
     * Validation is done in the Createuser Request class.
     */
    public function postRegister(CreateUser $user){
        return User::create(['name' => $user->name, 'email' =>$user->email, 'password' => bcrypt($user->password)]);
    }
}
