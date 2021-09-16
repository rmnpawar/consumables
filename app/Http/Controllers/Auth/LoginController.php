<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        try
        {
            $this->validateLogin($request);
        }
        catch (ValidationException $e)
        {
            return response()->json($e->validator->errors(), 200);
        }

        if (Auth::guard('web')->attempt($request->all())) 
        {
            $user = Auth::guard('web')->user();
            $user->generateToken();

            return response()->json($user->
            load(array('roles'=> function($query) {
                $query->select('id', 'name');
            }))
            ->load('section')
            ->toArray(), 200);
        }

        return response()->json(['data' => 'Invalid details'], 200);
    }

    public function logOut()
    {
        $user = Auth::user();

        if ($user)
        {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data' => "Log out Successful"], 200);
    }

    public function user(Request $request)
    {
        $user = $request->user();

        if (!$user) return response()->json(['data' => 'Not logged in'], 200);

        return response()->json($user->toArray(), 200);
    }

}
