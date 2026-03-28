<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ZonesController extends Controller
{
    public function index()
    {
        $zonesRaw = Zone::orderBy('wilaya')->orderBy('commune')->get();
        $zones = [];

        // Mapping des icônes par Wilaya
        $icons = [
            'Adrar' => '🏜️', 'Chlef' => '🌾', 'Alger' => '🌆', 'Oran' => '🏙️',
            'Constantine' => '🏛️', 'Mostaganem' => '⚓', 'Blida' => '🌸'
            // ... ajoutez les autres ici
        ];

        foreach ($zonesRaw as $z) {
            $zoneId = $z->id;

            // 1. Sous-traitants actifs
            $sousTraitantsCount = $z->sousTraitants()->where('actif', 1)->count();

            // 2. Total Interventions & En cours (via la relation Tickets)
            $interventionsCount = DB::table('interventions')
                ->join('tickets', 'interventions::ticket_id', '=', 'tickets.id')
                ->where('tickets.zone_id', $zoneId)
                ->count();

            $enCoursCount = DB::table('interventions')
                ->join('tickets', 'interventions.ticket_id', '=', 'tickets.id')
                ->where('tickets.zone_id', $zoneId)
                ->whereIn('interventions.statut_terrain', ['EN_ROUTE', 'EN_COURS'])
                ->count();

            // 3. Calcul SLA
            $totalTickets = $z->tickets()->count();
            $respectedSla = $z->tickets()
                ->where(function($query) {
                    $query->where('deadline_at', '>=', now())
                          ->orWhere('statut', 'CLOTURE');
                })->count();

            $sla = $totalTickets > 0 ? round(($respectedSla / $totalTickets) * 100) : 100;

            $zones[] = [
                'id' => $z->id,
                'icon' => $icons[$z->wilaya] ?? '📍',
                'name' => $z->wilaya . ' - ' . ($z->quartier ? $z->commune . ' - ' . $z->quartier : $z->commune),
                'wilaya' => $z->wilaya,
                'commune' => $z->commune,
                'quartier' => $z->quartier,
                'sous_traitants' => $sousTraitantsCount,
                'interventions' => $interventionsCount,
                'en_cours' => $enCoursCount,
                'sla' => $sla
            ];
        }

        return view('zones.index', compact('zones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'wilaya' => 'required|string',
            'commune' => 'required|string',
            'quartier' => 'nullable|string'
        ]);

        // Génération de l'ID unique comme dans votre code natif
        $validated['id'] = (string) Str::uuid();

        Zone::create($validated);

        return redirect()->back()->with('success', 'Zone ajoutée avec succès !');
    }

    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);

        // Vérification des contraintes
        if ($zone->sousTraitants()->exists() || $zone->tickets()->exists()) {
            return redirect()->back()->with('error', 'Impossible de supprimer : la zone est liée à des données !');
        }

        $zone->delete();
        return redirect()->back()->with('success', 'Zone supprimée avec succès !');
    }
}
