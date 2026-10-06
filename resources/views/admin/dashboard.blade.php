@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="group p-6 rounded-3xl bg-white border border-slate-200 shadow-premium hover:shadow-lg transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
            <i data-lucide="user-round" class="w-16 h-16 text-medical-primary"></i>
        </div>
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-700 mr-4">
                <i data-lucide="user-round" class="w-6 h-6"></i>
            </div>
            <h5 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Patients</h5>
        </div>
        <h2 class="text-4xl font-bold text-slate-900">{{ $totalPatients }}</h2>
        <div class="mt-4 flex items-center text-xs font-medium text-emerald-600">
            <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i>
            <span>+4.5% from last month</span>
        </div>
    </div>

    <div class="group p-6 rounded-3xl bg-white border border-slate-200 shadow-premium hover:shadow-lg transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
            <i data-lucide="users" class="w-16 h-16 text-medical-secondary"></i>
        </div>
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 rounded-2xl bg-teal-100 flex items-center justify-center text-teal-700 mr-4">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <h5 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Doctors</h5>
        </div>
        <h2 class="text-4xl font-bold text-slate-900">{{ $totalDoctors }}</h2>
        <div class="mt-4 flex items-center text-xs font-medium text-teal-600">
            <i data-lucide="activity" class="w-4 h-4 mr-1"></i>
            <span>On-duty now: 12</span>
        </div>
    </div>

    <div class="group p-6 rounded-3xl bg-white border border-slate-200 shadow-premium hover:shadow-lg transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
            <i data-lucide="calendar" class="w-16 h-16 text-medical-accent"></i>
        </div>
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-700 mr-4">
                <i data-lucide="calendar" class="w-6 h-6"></i>
            </div>
            <h5 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Total Appointments</h5>
        </div>
        <h2 class="text-4xl font-bold text-slate-900">{{ $totalAppointments }}</h2>
        <div class="mt-4 flex items-center text-xs font-medium text-indigo-600">
            <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
            <span>24 scheduled today</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Chart Section -->
    <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-premium">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-lg font-bold text-slate-800">Appointment Status</h3>
            <div class="flex items-center space-x-2">
                <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                <span class="text-xs text-slate-500 font-medium">Pending</span>
                <span class="w-3 h-3 rounded-full bg-emerald-500 ml-2"></span>
                <span class="text-xs text-slate-500 font-medium">Completed</span>
            </div>
        </div>
        <div class="relative h-[300px]">
            <canvas id="appointmentChart"></canvas>
        </div>
    </div>

    <!-- Recent Appointments -->
    <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-premium flex flex-col">
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-lg font-bold text-slate-800">Recent Appointments</h3>
            <a href="{{ route('appointments.index') }}" class="text-sm font-semibold text-medical-primary hover:text-medical-secondary transition-colors flex items-center">
                View All
                <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Patient</th>
                        <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Doctor</th>
                        <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date</th>
                        <th class="pb-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentAppointments as $appointment)
                    <tr class="group hover:bg-slate-50 transition-colors">
                        <td class="py-4 font-semibold text-sm text-slate-700">
                            {{ $appointment->patient->prenom }} {{ $appointment->patient->nom }}
                        </td>
                        <td class="py-4 text-sm text-slate-600 flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center mr-3 text-xs font-bold">
                                {{ substr($appointment->doctor->user->name, 0, 1) }}
                            </div>
                            Dr. {{ $appointment->doctor->user->name }}
                        </td>
                        <td class="py-4 text-sm text-slate-500">
                            {{ $appointment->date->format('M d, H:i') }}
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i data-lucide="calendar-off" class="w-12 h-12 text-slate-200 mb-3"></i>
                                <p class="text-slate-400 font-medium">No appointments found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('appointmentChart').getContext('2d');
        const data = @json(array_values($appointmentsCountByStatus));
        const labels = @json(array_keys($appointmentsCountByStatus)).map(l => l.charAt(0).toUpperCase() + l.slice(1));
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#f59e0b', '#10b981'],
                    hoverBackgroundColor: ['#d97706', '#059669'],
                    borderWidth: 8,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                cutout: '80%',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        cornerRadius: 12,
                        displayColors: false
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection

