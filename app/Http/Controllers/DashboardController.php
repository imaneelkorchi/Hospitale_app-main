<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $totalAppointments = Appointment::count();
        
        $recentAppointments = Appointment::with(['patient', 'doctor.user'])
            ->latest('date')
            ->take(5)
            ->get();
            
        // For the Chart
        $appointmentsCountByStatus = Appointment::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Default to 0 if not set
        $appointmentsCountByStatus['pending'] = $appointmentsCountByStatus['pending'] ?? 0;
        $appointmentsCountByStatus['done'] = $appointmentsCountByStatus['done'] ?? 0;

        return view('admin.dashboard', compact('totalPatients', 'totalDoctors', 'totalAppointments', 'recentAppointments', 'appointmentsCountByStatus'));
    }

    public function medecinDashboard()
    {
        $doctor = auth()->user()->doctor;
        if (!$doctor) {
            abort(403, 'No doctor profile linked to this user.');
        }
        
        $recentAppointments = Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->latest('date')
            ->take(10)
            ->get();
            
        $todayAppointmentsCount = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('date', today())
            ->count();
            
        return view('medecin.dashboard', compact('recentAppointments', 'todayAppointmentsCount'));
    }

    public function patientDashboard()
    {
        $patient = Patient::where('user_id', auth()->id())->first();
        
        if (!$patient) {
            abort(403, 'No patient profile linked to this user.');
        }

        $upcomingAppointments = Appointment::with('doctor.user')
            ->where('patient_id', $patient->id)
            ->where('date', '>=', now())
            ->where('status', 'pending')
            ->orderBy('date')
            ->take(5)
            ->get();

        $pastAppointments = Appointment::with('doctor.user')
            ->where('patient_id', $patient->id)
            ->where(function($q) {
                $q->where('date', '<', now())
                  ->orWhere('status', 'done');
            })
            ->latest('date')
            ->take(5)
            ->get();

        $totalAppointments = Appointment::where('patient_id', $patient->id)->count();
        $pendingCount = Appointment::where('patient_id', $patient->id)->where('status', 'pending')->count();
        $doneCount = Appointment::where('patient_id', $patient->id)->where('status', 'done')->count();

        return view('patient.dashboard', compact('patient', 'upcomingAppointments', 'pastAppointments', 'totalAppointments', 'pendingCount', 'doneCount'));
    }

    public function patientMedicalRecords()
    {
        $patient = Patient::where('user_id', auth()->id())->first();
        
        if (!$patient) {
            abort(403, 'No patient profile linked to this user.');
        }

        $records = $patient->medicalRecords()->with('doctor.user')->latest('date')->paginate(10);

        return view('patient.medical_records', compact('patient', 'records'));
    }
}
