<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlaceController extends Controller
{
    public function getPlace($place){
        $userController = new UserController();
        if(!$userController->isUserLoggedIn()) return redirect('/login');
        $data = [
            'user' => User::where('username', Session::get('username'))->first(),
            'place' => Place::where('slug', $place)->first(),
            'places' => Place::limit(12)->get()
        ]; return view('detail', $data);
    }
}
