<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email, $password;
    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.login');
    }
    public function proses() 
    {
        $credential = $this->validate([
                'email' => 'required',
                'password' => 'required'
        ],[
            'email.required'=>'Silahkan isi email',
            'password.required' => 'Silahkan isi password'
        ]);


        if (Auth::attempt($credential)) {
            session()->regenerate();
 
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function keluar()
    {
        Auth::logout();
 
        session()->invalidate();
     
        session()->regenerateToken();
     
        return redirect()->route('login');  
    }
}
