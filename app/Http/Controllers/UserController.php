<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Place;
use App\Models\Refund;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\RefundMessage;
use App\Models\ReservationDetail;
use Illuminate\Contracts\View\View;
use App\Models\BalanceAccumulations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Database\Seeders\ReservationDetailSeeder;

class UserController extends Controller
{
    public function isUserLoggedIn(){
        if(!Session::get('username')) return false;
        else return true;
    }

    public function updateHandler(Request $request){
        $user = User::where('username', Session::get('username'))->first();

        if($request->profile_image){
            $user->profile_image = $request->profile_image;
            $image = $request->file('profile_image');
            $imageName = 'profile_image.' . $image->getClientOriginalExtension();
            $imagePath = 'images/profile/' . md5($user->username) . '/' . $imageName;
            $image->move(public_path('images/profile/' . md5($user->username)), $imageName);
            $user->profile_image = $imagePath;
            $user->save();
        }

        if($request->name) {
            $user->name = $request->name;
            $user->save();    
        }

        if($request->email) {
            $user->email = $request->email;
            $user->save();
        }

        return redirect('/profile');
    }

    public function registerHandler(Request $request){
        $validated = $request->validate([
            'username' => 'required|max:50|unique:users,username',
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        if($request->password != $request->password_confirmation){
            return back()->withErrors([
                'password-confirmation' => 'Password Tidak Sama',
            ])->withInput();
        }

        else if($request->username == 'admin') {
            return back()->withErrors([
                'username' => 'Username Sudah Digunakan',
            ])->withInput();
        }

        else if(User::where('username', $request->username)->first()){
            return back()->withErrors([
                'username' => 'Username Sudah Digunakan',
            ])->withInput();
        }

        else if($validated){
            $user = new User();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->save();
            Session::put('username', $request->username);
            return redirect()->intended('/');
        } 

        else {
            return back()->withErrors([
                'log' => 'Hack Detected',
            ])->withInput();
            // reminder : tambahkan method untuk insert ke user agent mencurigakan
        }
    }

    public function bookingPlace($slug){
        if(!$this->isUserLoggedIn()) return redirect('/login');
        $data['place'] = Place::where('slug', $slug)->first();
        $data['user'] = User::where('username', Session::get('username'))->first();
        return view('booking', $data);
    }

    public function sendBookingRequest(Request $request){
        if(!$this->isUserLoggedIn()) return redirect('/login');
        $validated = $request->validate([
            'place_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'booking_for' => 'required',
        ]);

        if($validated){
            $reservation = new Reservation();
            $invoice_number = $reservation->generateInvoiceNumber();
            $reservation->booking_for = $request->booking_for;
            $reservation->reservation_invoice = $invoice_number;
            $reservation->save();

            $reservation_detail = new ReservationDetail();
            $reservation_detail->reservation_id = $reservation->id;
            $reservation_detail->visitor_username = Session::get('username');
            $reservation_detail->place_id = $request->place_id;
            $reservation_detail->unit_price = $request->price;
            $reservation_detail->quantity = $request->quantity;
            $reservation_detail->save();

            return redirect('/cart');
        }

        else {
            return back()->withErrors([
                'log' => 'There is an anomalies in your request',
            ])->withInput();
        }
    }

    public function logoutHandler(){
        Session::forget('username');
        Session::forget('profile_image');
        Session::flush();
        return redirect('/');
    }

    public function loginHandler(Request $request) {
        $validated = $request->validate([
            'username' => 'required|max:50',
            'password' => 'required'
        ]);

        if($validated){
            $user = User::where('username', $request->username)->first();
            if($user){
                if(Hash::check($request->password, $user->password)){
                    Session::put('username', $request->username);
                    Session::put('profile_image', $user->profile_image);
                    Session::put('last_searched', ' ');
                    $data['user'] = $user;
                    return redirect()->intended('/')->with($data);
                }

                else {
                    return back()->withErrors([
                        'password' => 'Password Salah',
                    ])->withInput();
                }
            }

            else {
                return back()->withErrors([
                    'username' => 'Username Tidak Ditemukan',
                ]);
            }
        }
        return redirect()->intended('/login');
    }

    public function getProfile(){
        if(!$this->isUserLoggedIn()) return redirect('/login');
        $data['user'] = User::where('username', Session::get('username'))->first();
        $data['reservation_details'] = ReservationDetail::where('visitor_username', Session::get('username'))->get();
        return view('profile', $data);
    }

    public function getHistory(){
        if(!$this->isUserLoggedIn()) return redirect('/login');
        $data['user'] = User::where('username', Session::get('username'))->first();
        $data['reservation_details'] = ReservationDetail::where('visitor_username', Session::get('username'))->get();
        return view('history', $data);
    }

    public function getCart(){
        if(!$this->isUserLoggedIn()) return redirect('/login');
        $data['user'] = User::where('username', Session::get('username'))->first();
        $data['reservation_details'] = ReservationDetail::where('visitor_username', Session::get('username'))->get();
        return view('cart', $data);
    }

    public function getRefund(){
        if(!$this->isUserLoggedIn()) return redirect('/login');
        $data['user'] = User::where('username', Session::get('username'))->first();
        $data['reservation_details'] = ReservationDetail::where('visitor_username', Session::get('username'))->get();
        $data['refunds'] = Refund::where('username', Session::get('username'))->get();
        return view('refund', $data);
    }

    public function getRefundDetail($invoice_number){
        if(!$this->isUserLoggedIn()) return redirect('/login');
        $data['user'] = User::where('username', Session::get('username'))->first();
        $data['reservation'] = Reservation::where('reservation_invoice', $invoice_number)->first();
        $data['place'] = Place::where('id', $data['reservation']->reservation_detail->first()->place_id)->first();
        return view('refund-detail', $data);
    }

    public function postRefundRequest(Request $request){
        $validated = $request->validate([
            'reservation_invoice' => 'required',
            'pesan_pengembalian' => 'required',
            'admin_username' => 'required',
        ]);

        $message = new RefundMessage();
        $message->reservation_invoice = $request->reservation_invoice;
        $message->message = $request->pesan_pengembalian;
        $message->admin_username = $request->admin_username;
        $message->save();
        $reservation = Reservation::where('reservation_invoice', $request->reservation_invoice)->first();
        
        $refund = new Refund();
        $reservation_id = $reservation->id;
        $username = $reservation->reservation_detail->visitor_username;
        $refund->reservation_id = $reservation_id;
        $refund->username = $username;
        $refund->save();
        return redirect('/refund');

        
        // untuk debug
        // return response()->json([
        //     'invoice_number' => $request->reservation_invoice,
        //     'reservation_id' => $reservation_id,
        //     'username' => $username,
        //     'admin_username' => $request->admin_username,
        //     'total_price' => $reservation->reservation_detail->quantity * $reservation->reservation_detail->unit_price,
        //     'refund' => $refund,
        //     'message' => $request->pesan_pengembalian,
        // ], 200);

    }

    public function validatePayment($invoice_number){
        $reservation = Reservation::where('reservation_invoice', $invoice_number)->first();
        $reservation->status = '1';
        $reservation->save();

        // add accumulation to user
        $accumulation = BalanceAccumulations::where('username', Session::get('username'))->first();
        
        if($accumulation){
            $accumulation->balance += $reservation->reservation_detail->quantity * $reservation->reservation_detail->unit_price;
            $accumulation->save();
        }

        else {
            $accumulation = new BalanceAccumulations();
            $accumulation->username = Session::get('username');
            $accumulation->balance = $reservation->reservation_detail->quantity * $reservation->reservation_detail->unit_price;
            $accumulation->save();
        }

        return redirect('/cart');
    }
}
