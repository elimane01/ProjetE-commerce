<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Affiche le formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Traite l'inscription
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('home')->with('success', 'Inscription réussie !');
    }

    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traite la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ])->withInput();
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Déconnexion réussie.');
    }

    // Affiche le profil
    public function showProfile()
    {
        return view('auth.profile');
    }

    // Met à jour le profil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
        ]);

        $user->update($request->only([
            'first_name', 'last_name', 'email', 'phone', 'address', 'city', 'postal_code', 'country'
        ]));

        return back()->with('success', 'Profil mis à jour !');
    }

    // Change le mot de passe
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Mot de passe changé avec succès !');
    }
} 