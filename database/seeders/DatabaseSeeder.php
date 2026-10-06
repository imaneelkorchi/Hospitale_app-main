<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ─── Admin ───────────────────────────────────────
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@email.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        // ─── Doctor 1 ────────────────────────────────────
        $medecinUser1 = User::create([
            'name' => 'Dr. Smith',
            'email' => 'smith@email.com',
            'password' => 'password',
            'role' => 'medecin',
        ]);

        $doctor1 = Doctor::create([
            'user_id' => $medecinUser1->id,
            'specialite' => 'Cardiologue',
            'telephone' => '0612345678',
        ]);

        // ─── Doctor 2 ────────────────────────────────────
        $medecinUser2 = User::create([
            'name' => 'Dr. Johnson',
            'email' => 'johnson@email.com',
            'password' => 'password',
            'role' => 'medecin',
        ]);

        $doctor2 = Doctor::create([
            'user_id' => $medecinUser2->id,
            'specialite' => 'Pédiatre',
            'telephone' => '0698765432',
        ]);

        // ─── Patient 1 (with user account) ───────────────
        $patientUser1 = User::create([
            'name' => 'John Doe',
            'email' => 'patient@email.com',
            'password' => 'password',
            'role' => 'patient',
        ]);

        $patient1 = Patient::create([
            'user_id' => $patientUser1->id,
            'nom' => 'Doe',
            'prenom' => 'John',
            'date_naissance' => '1990-01-15',
            'telephone' => '0687654321',
            'email' => 'patient@email.com',
        ]);

        // ─── Patient 2 (with user account) ───────────────
        $patientUser2 = User::create([
            'name' => 'Marie Dupont',
            'email' => 'marie@email.com',
            'password' => 'password',
            'role' => 'patient',
        ]);

        $patient2 = Patient::create([
            'user_id' => $patientUser2->id,
            'nom' => 'Dupont',
            'prenom' => 'Marie',
            'date_naissance' => '1985-06-22',
            'telephone' => '0654321987',
            'email' => 'marie@email.com',
        ]);

        // ─── Appointments ────────────────────────────────
        $appointment1 = Appointment::create([
            'patient_id' => $patient1->id,
            'doctor_id' => $doctor1->id,
            'date' => now()->addDays(3)->setHour(10)->setMinute(0),
            'status' => 'pending',
        ]);

        $appointment2 = Appointment::create([
            'patient_id' => $patient1->id,
            'doctor_id' => $doctor2->id,
            'date' => now()->subDays(5)->setHour(14)->setMinute(30),
            'status' => 'done',
        ]);

        $appointment3 = Appointment::create([
            'patient_id' => $patient2->id,
            'doctor_id' => $doctor1->id,
            'date' => now()->addDays(1)->setHour(9)->setMinute(0),
            'status' => 'pending',
        ]);

        $appointment4 = Appointment::create([
            'patient_id' => $patient2->id,
            'doctor_id' => $doctor2->id,
            'date' => now()->subDays(10)->setHour(11)->setMinute(0),
            'status' => 'done',
        ]);

        // ─── Medical Records ─────────────────────────────
        MedicalRecord::create([
            'patient_id' => $patient1->id,
            'doctor_id' => $doctor1->id,
            'diagnostic' => 'Hypertension artérielle légère',
            'traitement' => 'Amlodipine 5mg, 1x/jour. Contrôle dans 1 mois.',
            'date' => now()->subDays(5),
        ]);

        MedicalRecord::create([
            'patient_id' => $patient2->id,
            'doctor_id' => $doctor2->id,
            'diagnostic' => 'Grippe saisonnière avec fièvre',
            'traitement' => 'Paracétamol 1g, 3x/jour pendant 5 jours. Repos.',
            'date' => now()->subDays(10),
        ]);

        // ─── Invoices ────────────────────────────────────
        Invoice::create([
            'patient_id' => $patient1->id,
            'montant' => 350.00,
            'statut' => 'paid',
        ]);

        Invoice::create([
            'patient_id' => $patient2->id,
            'montant' => 200.00,
            'statut' => 'unpaid',
        ]);

        Invoice::create([
            'patient_id' => $patient1->id,
            'montant' => 150.00,
            'statut' => 'unpaid',
        ]);
    }
}
