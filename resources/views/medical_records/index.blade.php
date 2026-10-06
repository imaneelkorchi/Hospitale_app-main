@extends('layouts.app')
@section('title', 'Medical Records')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Clinical Records</h2>
        <p class="text-sm text-slate-500">Comprehensive history of patient diagnoses and treatments.</p>
    </div>
    <a href="{{ route('medical_records.create') }}" class="inline-flex items-center px-6 py-3 rounded-2xl bg-medical-primary text-white font-bold hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/10">
        <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
        New Medical Record
    </a>
</div>

<div class="bg-white rounded-[2rem] border border-slate-200 shadow-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Diagnostic</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($records as $record)
                <tr class="group hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $record->patient->prenom }} {{ $record->patient->nom }}</div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">ID: #{{ $record->patient_id }}</p>
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
                    <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                        {{ $record->date->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('medical_records.edit', $record) }}" 
                               class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-medical-primary hover:text-white transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('medical_records.destroy', $record) }}" method="POST" class="inline" onsubmit="return confirm('Delete this record?');">
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
                                <i data-lucide="clipboard-list" class="w-8 h-8"></i>
                            </div>
                            <p class="text-slate-500 font-medium">No medical records found.</p>
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
