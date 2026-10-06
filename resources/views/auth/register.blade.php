@extends('layouts.app')
@section('title', 'Patient Registration - Zenith Health Center')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 p-6">
    <div class="w-full max-w-2xl">
        <!-- Logo Area -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-medical-primary text-white shadow-xl shadow-emerald-900/20 mb-4 animate-in zoom-in duration-700">
                <i data-lucide="user-plus" class="w-8 h-8"></i>
            </div>
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Patient Registration</h1>
            <p class="text-slate-500 mt-2">Join Zenith Health Center for premium medical care</p>
        </div>

        <!-- Card -->
        <div class="bg-white p-10 rounded-[2.5rem] shadow-premium border border-slate-100 animate-in fade-in slide-in-from-bottom-8 duration-700">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">First Name</label>
                        <input type="text" name="prenom" value="{{ old('prenom') }}"
                               class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                               placeholder="John" required autofocus>
                        @error('prenom') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Last Name</label>
                        <input type="text" name="nom" value="{{ old('nom') }}"
                               class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                               placeholder="Doe" required>
                        @error('nom') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Username -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="user" class="w-4 h-4 text-slate-400"></i>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                                   placeholder="johndoe123" required>
                        </div>
                        @error('name') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Date of Birth</label>
                        <input type="date" name="date_naissance" value="{{ old('date_naissance') }}"
                               class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                               required>
                        @error('date_naissance') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Phone Number</label>
                        <input type="text" name="telephone" value="{{ old('telephone') }}"
                               class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                               placeholder="(555) 000-0000">
                        @error('telephone') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                                   placeholder="name@example.com" required>
                        </div>
                        @error('email') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                        <input type="password" name="password" 
                               class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                               placeholder="••••••••" required>
                        @error('password') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" 
                               class="block w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:ring-2 focus:ring-medical-primary focus:border-medical-primary transition-all outline-none"
                               placeholder="••••••••" required>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-medical-primary text-white font-bold shadow-lg shadow-emerald-900/10 hover:bg-emerald-800 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center pt-8 border-t border-slate-100">
                <p class="text-sm text-slate-500">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-bold text-medical-primary hover:text-medical-secondary">Sign in instead</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

