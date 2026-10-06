@extends('layouts.app')
@section('title', 'Doctors Directory')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Medical Specialists</h2>
        <p class="text-sm text-slate-500">Manage and view all healthcare professionals.</p>
    </div>
    <a href="{{ route('admin.doctors.create') }}" class="inline-flex items-center px-6 py-3 rounded-2xl bg-medical-primary text-white font-bold hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/10">
        <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
        Add New Doctor
    </a>
</div>

<div class="bg-white rounded-[2rem] border border-slate-200 shadow-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Doctor</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Specialty</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Contact Info</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($doctors as $doctor)
                <tr class="group hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center font-bold mr-4 shadow-sm">
                                {{ substr($doctor->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">Dr. {{ $doctor->user->name }}</p>
                                <p class="text-xs text-slate-400">Staff ID: #{{ $doctor->id }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-600 uppercase tracking-wider border border-indigo-100">
                            {{ $doctor->specialite }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="space-y-1">
                            <div class="flex items-center text-sm text-slate-600">
                                <i data-lucide="mail" class="w-3.5 h-3.5 text-slate-300 mr-2"></i>
                                {{ $doctor->user->email }}
                            </div>
                            <div class="flex items-center text-xs text-slate-400">
                                <i data-lucide="phone" class="w-3.5 h-3.5 text-slate-300 mr-2"></i>
                                {{ $doctor->telephone ?? 'Not provided' }}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.doctors.edit', $doctor) }}" 
                               class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-medical-primary hover:text-white transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="inline" onsubmit="return confirm('Delete this doctor?');">
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
                            <p class="text-slate-500 font-medium">No doctors found.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($doctors->hasPages())
    <div class="px-6 py-6 border-t border-slate-100 bg-slate-50/30">
        {{ $doctors->links() }}
    </div>
    @endif
</div>
@endsection
