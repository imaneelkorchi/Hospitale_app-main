<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'telephone' => 'nullable|string|max:20',
        ]);

        // Do NOT use Hash::make() here — the User model has 'password' => 'hashed'
        // in its $casts, so Laravel will hash it automatically on assignment.
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'patient',
        ]);

        Patient::create([
            'user_id' => $user->id,
            'prenom' => $validated['prenom'],
            'nom' => $validated['nom'],
            'date_naissance' => $validated['date_naissance'],
            'telephone' => $validated['telephone'] ?? null,
            'email' => $validated['email'],
        ]);

        Auth::login($user);

        return redirect()->route('patient.dashboard')->with('success', 'Account created successfully! Welcome.');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            }

            if (Auth::user()->role === 'patient') {
                return redirect()->intended('patient/dashboard');
            }
            
            return redirect()->intended('medecin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
