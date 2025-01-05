<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TrafficController extends Controller
{
    public function index():View {
        $data['places'] = Place::all();

        if(Session::has('username')) {
            $data['user'] = User::where('username', Session::get('username'))->first();
            return view('userIndex', $data);
        }
        
        else {
            return view('index', $data);
        }
    }

    public function loginPage() {
        if(!Session::has('username')) {
            return view('login');
        } else return redirect('/');
    }

    public function registerPage() {
        if(Session::has('username')) {
            return redirect('/');
        } else return view('register');
    }

    public function dashboardPage():View {
        return view('dashboard');
    }

    public function findLastPlace(){
        $userController = new UserController();
        if(!$userController->isUserLoggedIn()) return redirect('/login');
        $lastSearched = Session::get('last_searched');
        
        $searchTerms = explode(' ', $lastSearched);
        $kataUmum = [
            'di', 'pada', 'ke', 'dari', 'yang', 'dan', 'atau', 
            'untuk', 'dengan', 'tempat', 'sebagai', 'oleh', 'dalam', 
            'antara', 'tetapi', 'karena', 'sehingga', 'sebab', 'maka', 
            'meskipun', 'walaupun', 'agar', 'supaya', 'seperti', 'bagi', 
            'dalam', 'dari', 'ke', 'pada', 'oleh', 'untuk', 'dengan', 
            'tanpa', 'tentang', 'sebelum', 'sesudah', 'sejak', 'hingga', 
            'sampai', 'ketika', 'saat', 'sewaktu', 'sebelum', 'sesudah', 
            'sejak', 'hingga', 'sampai', 'ketika', 'saat', 'sewaktu',
            'wisata', 'kuliner', 'indah'
        ];
        $searchTerms = array_filter($searchTerms, function($term) use ($kataUmum) {
            return !in_array(strtolower($term), $kataUmum);
        });
        $data['places'] = Place::where(function($query) use ($searchTerms) {
            foreach ($searchTerms as $term) {
            $query->orWhere('name', 'like', "%{$term}%")
              ->orWhere('short_description', 'like', "%{$term}%");
            }
        })->get();

        $data['user'] = User::where('username', Session::get('username'))->first();
        return view('find-visitation', $data);
    }

    // search indexing
    public function findPlace(Request $request){
        $userController = new UserController();
        if(!$userController->isUserLoggedIn()) return redirect('/login');
        $searchTerms = explode(' ', $request->search);
        $kataUmum = [
            'di', 'pada', 'ke', 'dari', 'yang', 'dan', 'atau', 
            'untuk', 'dengan', 'tempat', 'sebagai', 'oleh', 'dalam', 
            'antara', 'tetapi', 'karena', 'sehingga', 'sebab', 'maka', 
            'meskipun', 'walaupun', 'agar', 'supaya', 'seperti', 'bagi', 
            'dalam', 'dari', 'ke', 'pada', 'oleh', 'untuk', 'dengan', 
            'tanpa', 'tentang', 'sebelum', 'sesudah', 'sejak', 'hingga', 
            'sampai', 'ketika', 'saat', 'sewaktu', 'sebelum', 'sesudah', 
            'sejak', 'hingga', 'sampai', 'ketika', 'saat', 'sewaktu',
            'wisata', 'kuliner', 'indah'
        ];
        $searchTerms = array_filter($searchTerms, function($term) use ($kataUmum) {
            return !in_array(strtolower($term), $kataUmum);
        });
        $data['places'] = Place::where(function($query) use ($searchTerms) {
            foreach ($searchTerms as $term) {
            $query->orWhere('name', 'like', "%{$term}%")
                  ->orWhere('short_description', 'like', "%{$term}%");
            }
        })->get();


        // search filtering
        if(isset($request->date_filter)){
            $data['places'] = Place::where('name', 'like', "%{$request->search}%")
            ->where('short_description', 'like', "%$request->search%")
            ->where('created_at', 'like', "%$request->date_filter%")->get();
        } Session::put('last_searched', $request->search); 
        $data['user'] = User::where('username', Session::get('username'))->first();
        return view('find-visitation', $data);
    }
}
