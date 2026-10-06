@extends('layouts.app')
@section('title', 'Edit Patient Profile')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <a href="{{ route('patients.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-medical-primary transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Back to Patients Directory
        </a>
        <div class="px-4 py-1 rounded-full bg-slate-100 text-slate-500 text-[10px] font-bold uppercase tracking-widest">
            Patient ID: #{{ $patient->id }}
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-premium overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-2xl bg-medical-secondary/10 text-medical-secondary flex items-center justify-center mr-4">
                    <i data-lucide="user-cog" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Edit Patient Profile</h2>
                    <p class="text-sm text-slate-500">Update personal details for <strong>{{ $patient->prenom }} {{ $patient->nom }}</strong>.</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('patients.update', $patient) }}" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">First Name (Prénom)</label>
                    <input type="text" name="prenom" required value="{{ old('prenom', $patient->prenom) }}"
                           class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all">
                    @error('prenom') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Last Name (Nom)</label>
                    <input type="text" name="nom" required value="{{ old('nom', $patient->nom) }}"
                           class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all">
                    @error('nom') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Date of Birth</label>
                <div class="relative">
                    <i data-lucide="calendar" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="date" name="date_naissance" required value="{{ old('date_naissance', $patient->date_naissance) }}"
                           class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all">
                </div>
                @error('date_naissance') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-100 pt-6 mt-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Phone Number</label>
                    <div class="relative">
                        <i data-lucide="phone" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="telephone" value="{{ old('telephone', $patient->telephone) }}"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Email Address</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="email" name="email" value="{{ old('email', $patient->email) }}"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all">
                    </div>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row gap-4">
                <button type="submit" class="px-8 py-4 rounded-2xl bg-medical-primary text-white font-bold text-lg hover:bg-emerald-800 transition-all shadow-xl shadow-emerald-900/10 flex items-center justify-center">
                    <i data-lucide="refresh-cw" class="w-5 h-5 mr-2"></i>
                    Update Information
                </button>
                <a href="{{ route('patients.index') }}" class="px-8 py-4 rounded-2xl bg-slate-100 text-slate-600 font-bold text-lg hover:bg-slate-200 transition-all flex items-center justify-center">
                    Cancel Changes
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
