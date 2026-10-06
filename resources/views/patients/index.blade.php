@extends('layouts.app')
@section('title', 'Patients Directory')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Patients Directory</h2>
        <p class="text-sm text-slate-500">Manage and view all registered patients.</p>
    </div>
    <a href="{{ route('patients.create') }}" class="inline-flex items-center px-6 py-3 rounded-2xl bg-medical-primary text-white font-bold hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/10">
        <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
        Add New Patient
    </a>
</div>

<div class="bg-white rounded-[2rem] border border-slate-200 shadow-premium overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <form method="GET" action="{{ route('patients.index') }}" class="flex flex-col sm:flex-row gap-4 max-w-2xl">
            <div class="relative flex-1">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                <input type="text" name="search" placeholder="Search by name, email or phone..." 
                       class="w-full pl-11 pr-4 py-3 rounded-xl border-slate-200 focus:border-medical-primary focus:ring-medical-primary/20 text-sm"
                       value="{{ request('search') }}">
            </div>
            <button type="submit" class="px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-700 font-bold text-sm hover:bg-slate-50 transition-all shadow-sm">
                Filter Results
            </button>
            @if(request('search'))
                <a href="{{ route('patients.index') }}" class="px-4 py-3 text-slate-400 hover:text-red-500 transition-colors self-center">
                    <i data-lucide="x-circle" class="w-5 h-5"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date of Birth</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Contact Info</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($patients as $patient)
                <tr class="group hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-medical-primary/10 text-medical-primary flex items-center justify-center font-bold mr-4">
                                {{ substr($patient->prenom, 0, 1) }}{{ substr($patient->nom, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">{{ $patient->prenom }} {{ $patient->nom }}</p>
                                <p class="text-xs text-slate-400">ID: #{{ $patient->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">
                        <div class="flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 text-slate-300 mr-2"></i>
                            {{ $patient->date_naissance }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="space-y-1">
                            <div class="flex items-center text-sm text-slate-600">
                                <i data-lucide="phone" class="w-3.5 h-3.5 text-slate-300 mr-2"></i>
                                {{ $patient->telephone }}
                            </div>
                            <div class="flex items-center text-xs text-slate-400">
                                <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-300 mr-2"></i>
                                {{ $patient->email }}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('patients.edit', $patient) }}" 
                               class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-medical-primary hover:text-white transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this patient?');">
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
                    <td colspan="4" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-300 mb-4">
                                <i data-lucide="users" class="w-8 h-8"></i>
                            </div>
                            <p class="text-slate-500 font-medium">No patients found matching your search.</p>
                            <a href="{{ route('patients.index') }}" class="mt-2 text-medical-primary font-bold hover:underline">Clear all filters</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($patients->hasPages())
    <div class="px-6 py-6 border-t border-slate-100 bg-slate-50/30">
        {{ $patients->links() }}
    </div>
    @endif
</div>
@endsection
