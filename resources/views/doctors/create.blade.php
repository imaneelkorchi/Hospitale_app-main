@extends('layouts.app')
@section('title', 'Add New Doctor')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.doctors.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-medical-primary transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Back to Doctors Directory
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-premium overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-2xl bg-medical-primary/10 text-medical-primary flex items-center justify-center mr-4">
                    <i data-lucide="user-plus" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Register New Doctor</h2>
                    <p class="text-sm text-slate-500">Create a new physician account with login credentials.</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.doctors.store') }}" class="p-8 space-y-6">
            @csrf

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Full Name</label>
                <div class="relative">
                    <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="text" name="name" required value="{{ old('name') }}"
                           class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all"
                           placeholder="e.g. Dr. Ahmed Benali">
                </div>
                @error('name') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Email Address</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="email" name="email" required value="{{ old('email') }}"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all"
                               placeholder="doctor@zenithhealth.com">
                    </div>
                    @error('email') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="password" name="password" required
                               class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all"
                               placeholder="••••••••">
                    </div>
                    @error('password') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-100 pt-6 mt-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Specialty</label>
                    <div class="relative">
                        <i data-lucide="stethoscope" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="specialite" required value="{{ old('specialite') }}"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all"
                               placeholder="e.g. Cardiologue">
                    </div>
                    @error('specialite') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Phone Number</label>
                    <div class="relative">
                        <i data-lucide="phone" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="telephone" value="{{ old('telephone') }}"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all"
                               placeholder="+212 6XX XXX XXX">
                    </div>
                    @error('telephone') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full md:w-auto px-8 py-4 rounded-2xl bg-medical-primary text-white font-bold text-lg hover:bg-emerald-800 transition-all shadow-xl shadow-emerald-900/10 flex items-center justify-center">
                    <i data-lucide="save" class="w-5 h-5 mr-2"></i>
                    Save Doctor Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
