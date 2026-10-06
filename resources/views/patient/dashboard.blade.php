@extends('layouts.app')
@section('title', 'My Health Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-premium relative overflow-hidden">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                <i data-lucide="calendar" class="w-5 h-5"></i>
            </div>
            <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Appointments</h6>
        </div>
        <h2 class="text-3xl font-bold text-slate-900">{{ $totalAppointments }}</h2>
    </div>

    <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-premium relative overflow-hidden">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 mr-3">
                <i data-lucide="clock" class="w-5 h-5"></i>
            </div>
            <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pending</h6>
        </div>
        <h2 class="text-3xl font-bold text-slate-900">{{ $pendingCount }}</h2>
    </div>

    <div class="p-6 rounded-3xl bg-white border border-slate-200 shadow-premium relative overflow-hidden">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600 mr-3">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
            <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Completed</h6>
        </div>
        <h2 class="text-3xl font-bold text-slate-900">{{ $doneCount }}</h2>
    </div>
</div>

<div class="flex flex-col lg:flex-row gap-8">
    <div class="lg:w-2/3 space-y-8">
        {{-- Upcoming Appointments --}}
        <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-premium">
            <div class="flex items-center justify-between mb-8">
                <h5 class="text-lg font-bold text-slate-800">Upcoming Appointments</h5>
                <a href="{{ route('patient.appointments.create') }}" class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-bold bg-medical-primary text-white hover:bg-medical-secondary transition-all shadow-md shadow-emerald-900/10">
                    <i data-lucide="calendar-plus" class="w-4 h-4 mr-2"></i>
                    Book Visit
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Doctor</th>
                            <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date & Time</th>
                            <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($upcomingAppointments as $appointment)
                        <tr class="group hover:bg-slate-50 transition-colors">
                            <td class="py-4">
                                <div class="flex items-center">
                                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center mr-3 text-xs font-bold">
                                        Dr
                                    </div>
                                    <div>
                                        <p class="font-semibold text-sm text-slate-700">Dr. {{ $appointment->doctor->user->name }}</p>
                                        <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest px-2 py-0.5 bg-indigo-50 rounded">{{ $appointment->doctor->specialite }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 text-sm text-slate-600">
                                <span class="font-medium">{{ $appointment->date->format('M d, Y') }}</span>
                                <span class="text-slate-400 ml-1">at {{ $appointment->date->format('H:i') }}</span>
                            </td>
                            <td class="py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 uppercase tracking-wider">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-12 text-center text-slate-400 font-medium italic">
                                No upcoming appointments. Book one now!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Past Appointments --}}
        <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-premium">
            <h5 class="text-lg font-bold text-slate-800 mb-8">Visit History</h5>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Doctor</th>
                            <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date</th>
                            <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pastAppointments as $appointment)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 font-semibold text-sm text-slate-700">Dr. {{ $appointment->doctor->user->name }}</td>
                            <td class="py-4 text-sm text-slate-500">{{ $appointment->date->format('Y-m-d H:i') }}</td>
                            <td class="py-4">
                                @php
                                    $statusClasses = [
                                        'done' => 'bg-emerald-100 text-emerald-700',
                                        'cancelled' => 'bg-slate-100 text-slate-600',
                                        'pending' => 'bg-amber-100 text-amber-700'
                                    ];
                                    $class = $statusClasses[$appointment->status] ?? 'bg-slate-100 text-slate-600';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold {{ $class }} uppercase tracking-wider">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-slate-400 italic">No past records.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="lg:w-1/3">
        <div class="p-8 rounded-3xl bg-gradient-to-br from-medical-primary to-emerald-900 text-white shadow-xl shadow-emerald-900/20">
            <h5 class="text-xl font-bold mb-4">Ready for your next checkup?</h5>
            <p class="text-emerald-100 text-sm mb-8 leading-relaxed opacity-90">Maintaining regular visits with your physician helps in early detection of potential health issues.</p>
            <a href="{{ route('patient.appointments.create') }}" class="block w-full text-center py-4 rounded-2xl bg-white text-medical-primary font-bold hover:bg-emerald-50 transition-all shadow-lg">
                Schedule Appointment
            </a>
            
            <div class="mt-12 pt-8 border-t border-white/10 space-y-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center mr-3">
                        <i data-lucide="phone" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium">Emergency: (555) 123-4567</span>
                </div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center mr-3">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                    </div>
                    <span class="text-sm font-medium">24/7 Support available</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

