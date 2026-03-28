<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
         // Créer un admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pgst.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
        
        // Créer des sous-traitants
        SousTraitant::create(['nom' => 'Société A', 'contact' => 'Jean Dupont', 'specialite' => 'Électricité']);
        SousTraitant::create(['nom' => 'Société B', 'contact' => 'Marie Martin', 'specialite' => 'Plomberie']);
        
        // Créer des zones
        Zone::create(['nom' => 'Zone Nord', 'description' => 'Secteur nord de la ville']);
        Zone::create(['nom' => 'Zone Sud', 'description' => 'Secteur sud de la ville']);
        
        // Paramètres par défaut
        Parametre::create(['cle' => 'nom_societe', 'valeur' => 'PGST']);
        Parametre::create(['cle' => 'email_contact', 'valeur' => 'contact@pgst.com']);
    
    }
}
