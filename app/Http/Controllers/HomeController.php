<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Profile;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        if($user->profile == null){
            $profile = Profile::create([
                'province' => 'Damascus',
                'user_id' => $id,
                'gender' => 'Male',
                'bio' => 'Hello world',
                'facebook' => 'https://facebook.com/'
            ]);
        }
        return view('home',compact('user'))
        ->with('success','login successfully');
    }
}
