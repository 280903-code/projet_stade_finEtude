<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Terrain;
use App\Models\Horaire;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un administrateur par défaut
        User::firstOrCreate(
            ['email' => 'admin@minifoot.sn'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'telephone' => '+221 77 000 00 00',
                'adresse' => 'Dakar, Sénégal',
            ]
        );

        // Créer un client de test
        User::firstOrCreate(
            ['email' => 'client@test.com'],
            [
                'name' => 'Client Test',
                'password' => Hash::make('client123'),
                'role' => 'client',
                'telephone' => '+221 77 111 11 11',
                'adresse' => 'Dakar, Sénégal',
            ]
        );

        // Créer le terrain par défaut
        $terrain = Terrain::create([
            'nom' => 'Terrain FootArena',
            'description' => 'Le meilleur terrain de FootArena de Dakar avec des installations modernes et un gazon synthétique de qualité professionnelle.',
            'adresse' => 'Dakar, Sénégal',
            'telephone' => '+221 77 440 95 66',
            'email' => 'ben@gmail.com',
            'image' => null,
            'prix_matin' => 10000,
            'prix_apres_midi' => 15000,
            'prix_soir' => 20000,
            'horaire_ouverture' => '08:00:00',
            'horaire_fermeture' => '23:59:00',
            'actif' => true,
        ]);

        // Créer les horaires par défaut (tous les jours de 8h à 22h)
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
        
        foreach ($jours as $jour) {
            // Matin: 8h-10h
            Horaire::create([
                'jour_semaine' => $jour,
                'heure_debut' => '08:00:00',
                'heure_fin' => '10:00:00',
                'disponible' => true,
                'raison_blocage' => null,
            ]);

            // Matin: 10h-12h
            Horaire::create([
                'jour_semaine' => $jour,
                'heure_debut' => '10:00:00',
                'heure_fin' => '12:00:00',
                'disponible' => true,
                'raison_blocage' => null,
            ]);

            // Après-midi: 12h-14h
            Horaire::create([
                'jour_semaine' => $jour,
                'heure_debut' => '12:00:00',
                'heure_fin' => '14:00:00',
                'disponible' => true,
                'raison_blocage' => null,
            ]);

            // Après-midi: 14h-16h
            Horaire::create([
                'jour_semaine' => $jour,
                'heure_debut' => '14:00:00',
                'heure_fin' => '16:00:00',
                'disponible' => true,
                'raison_blocage' => null,
            ]);

            // Après-midi: 16h-18h
            Horaire::create([
                'jour_semaine' => $jour,
                'heure_debut' => '16:00:00',
                'heure_fin' => '18:00:00',
                'disponible' => true,
                'raison_blocage' => null,
            ]);

            // Soir: 18h-20h
            Horaire::create([
                'jour_semaine' => $jour,
                'heure_debut' => '18:00:00',
                'heure_fin' => '20:00:00',
                'disponible' => true,
                'raison_blocage' => null,
            ]);

            // Soir: 20h-23h
            Horaire::create([
                'jour_semaine' => $jour,
                'heure_debut' => '20:00:00',
                'heure_fin' => '23:59:00',
                'disponible' => true,
                'raison_blocage' => null,
            ]);
        }
    }
}