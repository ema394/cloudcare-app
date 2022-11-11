<?php  

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller
{

    /**
     * Login
     * @return response()
     */
    public function index()
    {
        if(Auth::check()){
            return redirect('beers');
        }
        return view('auth.login');
    }      

    /**
     * Post Login
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('beers')
                        ->withSuccess('You have Successfully loggedin');
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }    

    /**
     * Beer List
     * @return response()
     */
    public function beers(Request $request)
    {
        if(Auth::check()){
            $page = 1;
            if(!empty($request->input('page'))){
                $page = $request->input('page');
            }

            $response = $response = Http::get('https://api.punkapi.com/v2/beers', [
                'page' => $page,
                'per_page' => 10,
            ]);

            if($response->successful()){
                $beers_list = $response->object();
            }
            return view('beers', ['beers' => $beers_list, 'current_page' => $page]);
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Logout
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }

}