<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{

    public function get_all_users(Request $request){
        $cUser = Auth::user();
        $cUserId = $cUser->id;
        $users = User::where('id', '!=', $cUserId)->withCount(['messages' => function($q) use ($cUserId) {
            $q->where('receiver_id',  $cUserId)
              ->where('status', 'new');
        }])->get();
        return view('dashboard', compact('users', 'cUser'));
    }
    
}
