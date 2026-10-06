@extends('layouts.app')
@section('title', 'Billing & Invoices')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Billing Overview</h2>
        <p class="text-sm text-slate-500">Track and manage patient invoices and payment statuses.</p>
    </div>
    <a href="{{ route('admin.invoices.create') }}" class="inline-flex items-center px-6 py-3 rounded-2xl bg-medical-primary text-white font-bold hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-900/10">
        <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
        Generate Invoice
    </a>
</div>

<div class="bg-white rounded-[2rem] border border-slate-200 shadow-premium overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Invoice ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Patient</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($invoices as $invoice)
                <tr class="group hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <span class="font-bold text-slate-400 tracking-tighter">#INV-{{ $invoice->id }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $invoice->patient->prenom }} {{ $invoice->patient->nom }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-slate-900">{{ number_format($invoice->montant, 2) }}</span>
                        <span class="text-[10px] font-bold text-slate-400 ml-1 uppercase">MAD</span>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusConfig = [
                                'paid' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'dot' => 'bg-emerald-500'],
                                'unpaid' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'dot' => 'bg-red-500'],
                            ];
                            $config = $statusConfig[$invoice->statut] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'dot' => 'bg-slate-400'];
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold {{ $config['bg'] }} {{ $config['text'] }} uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full {{ $config['dot'] }} mr-2"></span>
                            {{ $invoice->statut }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                        {{ $invoice->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.invoices.edit', $invoice) }}" 
                               class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:bg-medical-primary hover:text-white transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('Delete this invoice?');">
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
                    <td colspan="6" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-300 mb-4">
                                <i data-lucide="credit-card" class="w-8 h-8"></i>
                            </div>
                            <p class="text-slate-500 font-medium">No invoices generated yet.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($invoices->hasPages())
    <div class="px-6 py-6 border-t border-slate-100 bg-slate-50/30">
        {{ $invoices->links() }}
    </div>
    @endif
</div>
@endsection
