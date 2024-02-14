<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Patient;
use App\Models\Doctor;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }
    public function createdoctor(): View
    {
        return view('auth.registerdoctor');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string'],
            'phonenumber' => ['required', 'string'],
            'bloodtype' => ['required', 'string'],
            'usertype' => [ 'string'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'phonenumber' => $request->phonenumber,
            'bloodtype' => $request->bloodtype,
            'usertype' => $request->usertype,
        ]);
        $patient = Patient::create([
            "user_id"=> $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phonenumber' => $request->phonenumber,
            'bloodtype' => $request->bloodtype,
          
        ]);


        

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
    
     public function storedoctor(Request $request): RedirectResponse
    {
     
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phonenumber' => ['required', 'string'],
            'address' => ['required', 'string'],
            'specialization' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'usertype' => ['string'],
        ]);

        $user = User::create([
        
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
            'specialization' => $request->specialization,
            'gender' => $request->gender,
            'usertype' => $request->usertype,
        ]);
        $doctor = Doctor::create([
            "user_id"=> $user->id,
            'name' => $request->name,
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
            'specialization' => $request->specialization,
     
       
        ]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
