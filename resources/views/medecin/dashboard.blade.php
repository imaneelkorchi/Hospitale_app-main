@extends('layouts.app')
@section('title', 'Physician Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="p-6 rounded-3xl bg-medical-primary text-white shadow-lg relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 opacity-10">
            <i data-lucide="calendar" class="w-24 h-24"></i>
        </div>
        <div class="relative z-10">
            <h5 class="text-emerald-100 text-sm font-semibold uppercase tracking-wider mb-2">Today's Appointments</h5>
            <div class="flex items-end">
                <h2 class="text-4xl font-bold mr-3">{{ $todayAppointmentsCount }}</h2>
                <span class="text-emerald-200 text-sm mb-1 pb-1">Scheduled for today</span>
            </div>
        </div>
    </div>
</div>

<div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-premium">
    <div class="flex items-center justify-between mb-8">
        <h5 class="text-lg font-bold text-slate-800">My Recent Appointments</h5>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-100">
                    <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Patient</th>
                    <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date & Time</th>
                    <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="pb-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($recentAppointments as $appointment)
                <tr class="group hover:bg-slate-50 transition-colors">
                    <td class="py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center mr-3 font-bold">
                                {{ substr($appointment->patient->prenom, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-700">{{ $appointment->patient->prenom }} {{ $appointment->patient->nom }}</p>
                                <p class="text-xs text-slate-400">Patient ID: #{{ $appointment->patient_id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 text-sm text-slate-600">
                        <div class="flex flex-col">
                            <span class="font-medium text-slate-700">{{ $appointment->date->format('M d, Y') }}</span>
                            <span class="text-xs text-slate-400">{{ $appointment->date->format('H:i A') }}</span>
                        </div>
                    </td>
                    <td class="py-4">
                        @if($appointment->status == 'done')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2"></span>
                                Done
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-2"></span>
                                Pending
                            </span>
                        @endif
                    </td>
                    <td class="py-4 text-right">
                        <a href="{{ route('medical_records.create', ['appointment_id' => $appointment->id, 'patient_id' => $appointment->patient_id]) }}" 
                           class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold bg-medical-primary/10 text-medical-primary hover:bg-medical-primary hover:text-white transition-all duration-200">
                            <i data-lucide="plus" class="w-3.5 h-3.5 mr-1.5"></i>
                            Medical Record
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-12 text-center text-slate-400 font-medium">
                        <div class="flex flex-col items-center">
                            <i data-lucide="calendar-x" class="w-12 h-12 mb-3 opacity-20 text-slate-400"></i>
                            No appointments scheduled recently.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

