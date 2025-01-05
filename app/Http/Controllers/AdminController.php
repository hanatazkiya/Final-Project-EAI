<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Place;
use App\Models\PlaceDetail;
use App\Models\PlaceImages;
use App\Models\Refund;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\PlaceFeatures;
use App\Models\RefundMessage;
use App\Models\PlaceUniqueness;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Models\ReservationDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function redirect(){
        return redirect('/admin/dashboard');
    }

    public function safeAccountControl(){
        if(!Session::has('admin_username') && !Session::has('username')){
            return 500;
        }

        else if(!Session::has('admin_username') && Session::has('username')){
            return 403;
        }
    }

    // get method
    public function findPage(){
        if($this->safeAccountControl() == 500) return redirect('/admin/login');
        else if($this->safeAccountControl() == 403) return redirect('/');
        // reminder : change this
        $data['places'] = Place::all();
        return view('admin.find', $data);
    }

    public function findPageForUpdate() {
        if($this->safeAccountControl() == 500) return redirect('/admin/login');
        else if($this->safeAccountControl() == 403) return redirect('/');
        $data['places'] = Place::all();
        return view('admin.find-update', $data);
    }

    public function addPage(){
        if($this->safeAccountControl() == 500) return redirect('/admin/login');
        else if($this->safeAccountControl() == 403) return redirect('/');
        return view('admin.add');
    }

    public function addHandler(Request $request){
        if($this->safeAccountControl() == 500) return redirect('/admin/login');
        else if($this->safeAccountControl() == 403) return redirect('/');
        if (strpos($request->maps, 'https://www.google.com/maps/') === false || strpos($request->maps, 'iframe') === false) {
            return back()->withErrors(['maps' => 'The provided maps URL is not valid.']);
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'header_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
            'features_count' => 'required|numeric',
            'uniqueness_count' => 'required|numeric',
            'maps' => 'required|string',
        ]);


        if($validated){
            // data master place
            $place = new Place();
            $place->name = $request->name;
            $place->short_description = $request->short_description;
            $place->price = $request->price;
            $place->slug = $place->generate_slug($request->name);
            
            if ($request->hasFile('header_image')) {
                $headerImage = $request->file('header_image');
                $headerImagePath = $headerImage->store('images/header', 'public');
                $place->header_image = $headerImagePath;
            } $place->save();
            

            // data transaksional place_details
            $place_details = new PlaceDetail();
            $place_details->place_id = $place->id;
            $place_details->admin_username = Session::get('admin_username');
            $place_details->description = $request->description;
            $place_details->city = $request->city;
            $place_details->maps = $request->maps;
            $place_details->save();


            // data transaksional place uniquenesses
            for($i = 0; $i < $request->uniqueness_count; $i++){
                $place_uniqueness = new PlaceUniqueness();
                $place_uniqueness->place_id = $place->id;
                $place_uniqueness->uniqueness = $request->uniqueness[$i];
                $place_uniqueness->save();
            }
            

            // data transaksional place features
            for($i = 0; $i < $request->features_count; $i++){
                $place_features = new PlaceFeatures();
                $place_features->place_id = $place->id;
                $place_features->features = $request->features[$i];
                $place_features->save();
            }

            // data transaksional place_images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $place_images = new PlaceImages();
                    $place_images->place_id = $place->id;
                    $imagePath = $image->store('images', 'public');
                    $place_images->filename = $imagePath; $place_images->save();
                }
            }
        }

        else {
            return back()->withErrors('error');
        } return redirect()->route('admin.dashboard')->with('success', 'Place added successfully.');
    }

    public function previewPlace($slug){
        if($this->safeAccountControl() == 500) return redirect('/admin/login');
        else if($this->safeAccountControl() == 403) return redirect('/'); 
        
        $data = [
            'place' => Place::where('slug', $slug)->first(),
            'places' => Place::limit(12)->get()
        ]; return view('admin.preview', $data);
    }

    public function findUpdatePage(){
        if($this->safeAccountControl() == 500) return redirect('/admin/login');
        else if($this->safeAccountControl() == 403) return redirect('/');
        $data['places'] = Place::all();
        return view('admin.findstr', $data);
    }

    public function updatePage($slug){
        if($this->safeAccountControl() == 500) return redirect('/admin/login');
        else if($this->safeAccountControl() == 403) return redirect('/');
        $data['place'] = Place::where('slug', $slug)->first();
        return view('admin.update', $data);
    }

    public function updateRequest(Request $request){
        if($this->safeAccountControl() == 500) return redirect('/admin/login');
        else if($this->safeAccountControl() == 403) return redirect('/');
        if (strpos($request->maps, 'https://www.google.com/maps/') === false || strpos($request->maps, 'iframe') === false) {
            return back()->withErrors(['maps' => 'The provided maps URL is not valid.']);
        }
        
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'short_description' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'header_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
            'maps' => 'sometimes|string',
        ]);


        if($validated){
            // data master place
            $place = Place::where('slug', $request->slug)->first();

            if($request->name) $place->name = $request->name;
            if($request->short_description) $place->short_description = $request->short_description;
            if($request->price) $place->price = $request->price;

            if ($request->hasFile('header_image')) {
                $headerImage = $request->file('header_image');
                $headerImagePath = $headerImage->store('images/header', 'public');
                $place->header_image = $headerImagePath;
            } $place->save();
            

            // data transaksional place_details
            $place_details = PlaceDetail::where('place_id', $place->id)->first();
            if($request->description) $place_details->description = $request->description;
            if($request->city) $place_details->city = $request->city;
            if($request->maps) $place_details->maps = $request->maps;
            $place_details->save();
        } return redirect('/admin/dashboard')->with('success', 'Place updated successfully.');
    }

    public function loginPage() {
        return view('admin.login');
    }

    public function dashboardPage() {
        if($this->safeAccountControl() == 500) return redirect('/admin/login');
        else if($this->safeAccountControl() == 403) return redirect('/');
        $data['refund_messages'] = RefundMessage::where('admin_username', Session::get('admin_username'))->get();
        $data['admin'] = Admin::where('username', Session::get('admin_username'))->first();
        $data['place_detail'] = PlaceDetail::where('admin_username', Session::get('admin_username'))->get();
        $data['reservations'] = ReservationDetail::whereHas('place', function($query) {
            $query->whereHas('place_details', function($query) {
                $query->where('admin_username', Session::get('admin_username'));
            });
        })->get();
        $data['all_reservations'] = Reservation::all();
        return view('admin.dashboard', $data);
    }

    public function getRefundPreview($invoice_number){
        
        $invoice_number = (int) $invoice_number;
        $data['reservation'] = Reservation::where('reservation_invoice', '=' , $invoice_number)->first();
        $data['refund_messages'] = RefundMessage::where('reservation_invoice', $invoice_number)->get();
        $data['user'] = $data['reservation']->reservation_detail->user;
        $data['place'] = $data['reservation']->reservation_detail->place;
        // return response()->json($user);
        return view('admin.refund-preview', $data);
    }

    public function logoutHandler(){
        Session::forget('admin_username');
        Session::flush();
        return redirect('/admin/login');
    }


    // post method
    public function loginHandler(Request $request){
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if($validated){
            $username = $request->username;
            $password = $request->password;
            $user = Admin::where('username', $username)->first();

            if($user){
                if (Hash::check($password, $user->password)) {
                    Session::put('admin_username', $username);
                    return redirect()->intended('/admin/dashboard');
                } 
                
                else {
                    return back()->withErrors(['password' => 'The provided password is incorrect.'])->withInput();
                }
            }

            else {
                return back()->withErrors(['username' => 'The provided username does not exist.']);
            }
        }
    }


    public function acceptRefund($invoice_number){
        $reservation_id = Reservation::where('reservation_invoice', $invoice_number)->first()->id;
        $refunds = Refund::where('reservation_id', $reservation_id)->first();
        $refunds->status = 1;
        $refunds->save();
        return redirect()->intended('/admin/dashboard');
    }
}
