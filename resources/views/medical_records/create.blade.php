@extends('layouts.app')
@section('title', 'Create Medical Record')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('medical_records.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-medical-primary transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Back to Records History
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-premium overflow-hidden">
        <div class="p-8 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center mr-4">
                    <i data-lucide="clipboard-plus" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Add Clinical Entry</h2>
                    <p class="text-sm text-slate-500">Document the diagnostic findings and prescribed treatments.</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('medical_records.store') }}" class="p-8 space-y-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Patient</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                        <select name="patient_id" required 
                                class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all appearance-none">
                            <option value="">-- Select Patient --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id', $selectedPatientId ?? '') == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->prenom }} {{ $patient->nom }}
                                </option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>
                    @error('patient_id') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Attending Physician</label>
                    <div class="relative">
                        <i data-lucide="user-round" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                        <select name="doctor_id" required 
                                class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all appearance-none">
                            <option value="">-- Select Doctor --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ old('doctor_id', $selectedDoctorId ?? '') == $doctor->id ? 'selected' : '' }}>
                                    Dr. {{ $doctor->user->name }} ({{ $doctor->specialite }})
                                </option>
                            @endforeach
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none"></i>
                    </div>
                    @error('doctor_id') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="space-y-2 max-w-xs">
                <label class="text-sm font-bold text-slate-700 ml-1">Date of Consultation</label>
                <div class="relative">
                    <i data-lucide="calendar" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                    <input type="date" name="date" required value="{{ old('date') }}"
                           class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all">
                </div>
                @error('date') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-6 pt-6 border-t border-slate-100">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Diagnostic Details</label>
                    <textarea name="diagnostic" required rows="4"
                              class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all"
                              placeholder="Describe the medical diagnosis in detail...">{{ old('diagnostic') }}</textarea>
                    @error('diagnostic') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Prescribed Treatment</label>
                    <textarea name="traitement" required rows="4"
                              class="w-full px-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm transition-all"
                              placeholder="Outline the recommended treatment plan and medications...">{{ old('traitement') }}</textarea>
                    @error('traitement') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-8">
                <button type="submit" class="w-full md:w-auto px-8 py-4 rounded-2xl bg-medical-primary text-white font-bold text-lg hover:bg-emerald-800 transition-all shadow-xl shadow-emerald-900/10 flex items-center justify-center">
                    <i data-lucide="file-check" class="w-5 h-5 mr-2"></i>
                    Save Medical Record
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
