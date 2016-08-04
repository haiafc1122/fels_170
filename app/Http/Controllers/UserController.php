<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;

class UserController extends Controller
{
    //get list user
    public function getList()
    {
        $user = User::paginate(10);
        return view('admin.user.list', compact('user'));
    }

}
