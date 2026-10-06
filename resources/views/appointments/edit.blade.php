@extends('layouts.app')
@section('title', 'Edit Appointment')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <a href="{{ route('appointments.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-medical-primary transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Back to Schedule
        </a>
        <div class="px-4 py-1 rounded-full bg-slate-100 text-slate-500 text-[10px] font-bold uppercase tracking-widest">
            Appointment #{{ $appointment->id }}
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-premium overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-2xl bg-medical-secondary/10 text-medical-secondary flex items-center justify-center mr-4">
                    <i data-lucide="calendar-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Edit Appointment</h2>
                    <p class="text-sm text-slate-500">Update scheduling details for this consultation.</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('appointments.update', $appointment) }}" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Patient</label>
                <div class="relative">
                    <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <select name="patient_id" required
                            class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all appearance-none">
                        <option value="">-- Select Patient --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id', $appointment->patient_id) == $patient->id ? 'selected' : '' }}>
                                {{ $patient->prenom }} {{ $patient->nom }}
                            </option>
                        @endforeach
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                </div>
                @error('patient_id') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-sm font-bold text-slate-700 ml-1">Assigned Physician</label>
                <div class="relative">
                    <i data-lucide="user-round" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    <select name="doctor_id" required
                            class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all appearance-none">
                        <option value="">-- Select Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                Dr. {{ $doctor->user->name }} ({{ $doctor->specialite }})
                            </option>
                        @endforeach
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                </div>
                @error('doctor_id') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Date & Time</label>
                    <div class="relative">
                        <i data-lucide="clock" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="datetime-local" name="date" required value="{{ old('date', $appointment->date->format('Y-m-d\TH:i')) }}"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all">
                    </div>
                    @error('date') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Status</label>
                    <div class="relative">
                        <i data-lucide="activity" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                        <select name="status" required
                                class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all appearance-none">
                            <option value="pending" {{ old('status', $appointment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="done" {{ old('status', $appointment->status) == 'done' ? 'selected' : '' }}>Done</option>
                            <option value="cancelled" {{ old('status', $appointment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>
                    @error('status') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row gap-4">
                <button type="submit" class="px-8 py-4 rounded-2xl bg-medical-primary text-white font-bold text-lg hover:bg-emerald-800 transition-all shadow-xl shadow-emerald-900/10 flex items-center justify-center">
                    <i data-lucide="refresh-cw" class="w-5 h-5 mr-2"></i>
                    Update Appointment
                </button>
                <a href="{{ route('appointments.index') }}" class="px-8 py-4 rounded-2xl bg-slate-100 text-slate-600 font-bold text-lg hover:bg-slate-200 transition-all flex items-center justify-center">
                    Cancel Changes
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
