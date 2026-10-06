@extends('layouts.app')
@section('title', 'Login - Zenith Health Center')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 p-6">
    <div class="w-full max-w-md">
        <!-- Logo Area -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-medical-primary text-white shadow-xl shadow-emerald-900/20 mb-4 animate-in zoom-in duration-700">
                <i data-lucide="plus-circle" class="w-8 h-8"></i>
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Welcome Back</h1>
            <p class="text-slate-500 mt-2">Sign in to Zenith Health Center Portal</p>
        </div>

        <!-- Card -->
        <div class="bg-white p-10 rounded-[2.5rem] shadow-premium border border-slate-100 animate-in fade-in slide-in-from-bottom-8 duration-700">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                        </div>
                        <input type="email" name="email" 
                               class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                               placeholder="name@example.com" required autofocus>
                    </div>
                    @error('email') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-bold text-slate-700">Password</label>
                        <a href="#" class="text-xs font-bold text-medical-primary hover:text-medical-secondary">Forgot Password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                        </div>
                        <input type="password" name="password" 
                               class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                               placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-medical-primary border-slate-300 rounded focus:ring-medical-primary">
                    <label for="remember_me" class="ml-2 block text-xs font-bold text-slate-500 uppercase tracking-wider">Remember me</label>
                </div>

                <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-medical-primary text-white font-bold shadow-lg shadow-emerald-900/10 hover:bg-emerald-800 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center pt-8 border-t border-slate-100">
                <p class="text-sm text-slate-500">
                    New patient? 
                    <a href="{{ route('register') }}" class="font-bold text-medical-primary hover:text-medical-secondary">Create an account</a>
                </p>
            </div>
        </div>

        <!-- Demo Credentials -->
        <div class="mt-10 p-6 rounded-3xl bg-indigo-50 border border-indigo-100 animate-in fade-in delay-500 duration-1000 fill-mode-both">
            <h5 class="text-xs font-bold text-indigo-700 uppercase tracking-widest mb-3 flex items-center">
                <i data-lucide="info" class="w-3.5 h-3.5 mr-2"></i>
                Demo Credentials
            </h5>
            <div class="grid grid-cols-1 gap-3 text-xs">
                <div class="flex justify-between p-2 bg-white rounded-xl shadow-sm border border-indigo-100/50">
                    <span class="text-indigo-500 font-bold">Administrator</span>
                    <span class="text-slate-600">admin@email.com</span>
                </div>
                <div class="flex justify-between p-2 bg-white rounded-xl shadow-sm border border-indigo-100/50">
                    <span class="text-indigo-500 font-bold">Physician</span>
                    <span class="text-slate-600">smith@email.com</span>
                </div>
                <div class="flex justify-between p-2 bg-white rounded-xl shadow-sm border border-indigo-100/50">
                    <span class="text-indigo-500 font-bold">Patient</span>
                    <span class="text-slate-600">patient@email.com</span>
                </div>
                <div class="flex justify-between p-2 bg-white rounded-xl shadow-sm border border-indigo-100/50">
                    <span class="text-indigo-500 font-bold">Password (all)</span>
                    <span class="text-slate-600">password</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

