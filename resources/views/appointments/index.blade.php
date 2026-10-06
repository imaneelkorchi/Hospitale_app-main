@extends('layouts.app')
@section('title', 'Appointments')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Appointments Schedule</h2>
        <p class="text-sm text-slate-500">Track and manage all medical consultations.</p>
    </div>
    <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-6 py-3 rounded-2xl bg-medical-primary text-white font-bold hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/10">
        <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
        New Appointment
    </a>
</div>

<div class="bg-white rounded-[2rem] border border-slate-200 shadow-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($appointments as $appointment)
                <tr class="group hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $appointment->patient->prenom }} {{ $appointment->patient->nom }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center font-bold mr-3 text-xs">
                                {{ substr($appointment->doctor->user->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-slate-700 text-slate-600">Dr. {{ $appointment->doctor->user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">
                        <div class="flex flex-col">
                            <span class="font-bold">{{ $appointment->date->format('M d, Y') }}</span>
                            <span class="text-xs text-slate-400">{{ $appointment->date->format('H:i A') }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusConfig = [
                                'done' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'dot' => 'bg-emerald-500'],
                                'cancelled' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'dot' => 'bg-slate-400'],
                                'pending' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'dot' => 'bg-amber-500'],
                            ];
                            $config = $statusConfig[$appointment->status] ?? $statusConfig['pending'];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold {{ $config['bg'] }} {{ $config['text'] }} uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }} mr-2"></span>
                            {{ $appointment->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('appointments.edit', $appointment) }}" 
                               class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-medical-primary hover:text-white transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline" onsubmit="return confirm('Delete this appointment?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-300 mb-4">
                                <i data-lucide="calendar" class="w-8 h-8"></i>
                            </div>
                            <p class="text-slate-500 font-medium">No appointments scheduled.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($appointments->hasPages())
    <div class="px-6 py-6 border-t border-slate-100 bg-slate-50/30">
        {{ $appointments->links() }}
    </div>
    @endif
</div>
@endsection
