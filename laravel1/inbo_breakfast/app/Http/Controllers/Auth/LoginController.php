<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('username', $request->username)->first();
        $events = Event::all();

            if ($user) {
                if ($request->password == $user->password) {
                    Auth::login($user);

                    $request->session()->regenerate();

                    return view('home', ['events' => $events]);
                }

                return back()->withErrors([

                    'username' => 'The provided credentials do not match our records.'

                ])->onlyInput('username');
            } else {
                return back()->withErrors([

                    'username' => 'This User Do Not Exist.'

                ])->onlyInput('username');
            }
        }

//    public static function login(Request $request)
//    {
//        $events = Event::all();
////        $logged = Auth::user();
//        $userInfo = User::where('username', $request->username)->first();
//
////        if (!$logged) {
//            if (!$userInfo) {
//                return back()->with('fail', 'Username is Incorrect');
//            } else {
//                if ($request->password == $userInfo->password) {
//                    $request->session()->put('loggedUser', $userInfo->id);
//                    $GLOBALS['auth'] = $userInfo;
//                    $GLOBALS['admin'] = $userInfo->is_admin;
//                    return view('home', ['events' => $events, 'userInfo' => $userInfo]);
//                } else {
//                    return back()->with('fail', "Password is Incorrect");
//                }
//            }
////        } else {
////            return view('home', ['events' => $events, 'userInfo' => $logged]);
////        }
//    }

    public function loggedIn()
    {
        $events = Event::all();
        if (Auth::check()){
            return view('home', ['events' => $events]);
        }else{
            return redirect('login');
        }
}
}
