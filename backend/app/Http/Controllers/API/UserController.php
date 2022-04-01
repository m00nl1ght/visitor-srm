<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    /**
     * @param 
     * @return 
     */
    public function getCurrentUser(Request $request)
    {
        $user = Auth::user();
        return response()->success('Текущий пользователь получен', $user);
    }

    /**
     * @param 
     * @return 
     */
    public function getUserList(Request $request)
    {
        $users = User::all();
        return response()->success('Список пользователе получен', $users);
    }
    
}
