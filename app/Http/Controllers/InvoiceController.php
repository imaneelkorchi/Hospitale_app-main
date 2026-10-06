<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('patient')->latest()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $patients = Patient::orderBy('nom')->get();
        return view('invoices.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'montant' => 'required|numeric|min:0',
            'statut' => 'required|in:unpaid,paid',
        ]);

        Invoice::create($validated);
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice created successfully.');
    }

    public function edit(Invoice $invoice)
    {
        $patients = Patient::orderBy('nom')->get();
        return view('invoices.edit', compact('invoice', 'patients'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'montant' => 'required|numeric|min:0',
            'statut' => 'required|in:unpaid,paid',
        ]);

        $invoice->update($validated);
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}
