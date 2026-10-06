@extends('layouts.app')
@section('title', 'My Medical Records')

@section('content')
<div class="mb-8">
    <a href="{{ route('patient.dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-medical-primary transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
        Back to My Health Dashboard
    </a>
</div>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">My Medical Records</h2>
        <p class="text-sm text-slate-500">Complete history of your diagnoses and treatments.</p>
    </div>
</div>

<div class="bg-white rounded-[2rem] border border-slate-200 shadow-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Diagnostic</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Treatment</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($records as $record)
                <tr class="group hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium text-slate-700">
                        <div class="flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 text-slate-300 mr-2"></i>
                            {{ $record->date->format('M d, Y') }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold mr-3 text-xs">
                                {{ substr($record->doctor->user->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-slate-600">Dr. {{ $record->doctor->user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="max-w-xs">
                            <p class="text-sm text-slate-700 font-medium truncate">{{ $record->diagnostic }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="max-w-xs">
                            <p class="text-sm text-slate-600 truncate">{{ $record->traitement }}</p>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-300 mb-4">
                                <i data-lucide="clipboard-list" class="w-8 h-8"></i>
                            </div>
                            <p class="text-slate-500 font-medium">No medical records found.</p>
                            <p class="text-xs text-slate-400 mt-1">Records will appear here after your consultations.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($records->hasPages())
    <div class="px-6 py-6 border-t border-slate-100 bg-slate-50/30">
        {{ $records->links() }}
    </div>
    @endif
</div>
@endsection
