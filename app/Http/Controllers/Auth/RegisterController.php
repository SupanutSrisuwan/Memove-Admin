<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'coin' => $data['coin'],
            'password' => Hash::make($data['password']),
            'photo' => $data['photo'],
            'major' => $data['major'],
            'phone' => $data['phone'],
            'student_id' => $data['studentID'],
        ]);
        
        // $filenameWithExt = $request->file('photo')->getClientOriginalName();
        // $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        // $extension = $request->file('photo')->getClientOriginalExtension();
        // $today = date('YmdHis');
        // $filenameToStore = $today.'_user_'.$filename.'.'.$extension;
        
        // $data['photo']->move('uploads/photos/',$data['photo']);
        
        $user->img = $data['photo'];
        $user->coin = '0';
        $user->username = $data['username'];
        $user->roles = 'user';
        $user->phone = $data['phone'];
        $user->major = $data['major'];
        $user->student_id = $data['studentID'];
        $user->fav = '0';
        $user->dislike = '0';
        $user->save();
        return $user;
    }
}
