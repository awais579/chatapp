<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
class userController extends Controller
{
    
    function getUsers(){
        $id = auth()->user()->id;
        $users = auth()->user()->where('id','!=',$id)->get();
        return view('dashboard',compact('users', 'id'));
    }
}
