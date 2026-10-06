@extends('layouts.app')
@section('title', 'Book Appointment')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('patient.dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-medical-primary transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Back to My Health Dashboard
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-premium overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-2xl bg-medical-primary/10 text-medical-primary flex items-center justify-center mr-4">
                    <i data-lucide="calendar-plus" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Book a New Appointment</h2>
                    <p class="text-sm text-slate-500">Choose a specialist and your preferred date.</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('patient.appointments.store') }}" class="p-8 space-y-6">
            @csrf
            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Choose a Doctor</label>
                <div class="relative">
                    <i data-lucide="stethoscope" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <select name="doctor_id" required class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all appearance-none">
                        <option value="">-- Select a Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                Dr. {{ $doctor->user->name }} — {{ $doctor->specialite }}
                            </option>
                        @endforeach
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                </div>
                @error('doctor_id') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Preferred Date & Time</label>
                <div class="relative">
                    <i data-lucide="clock" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="datetime-local" name="date" required value="{{ old('date') }}" class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all">
                </div>
                @error('date') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-6 border-t border-slate-100">
                <button type="submit" class="w-full py-4 px-6 rounded-2xl bg-medical-primary text-white font-bold text-lg shadow-lg shadow-emerald-900/10 hover:bg-emerald-800 transition-all flex items-center justify-center">
                    <i data-lucide="calendar-check" class="w-5 h-5 mr-2"></i>
                    Book Appointment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
