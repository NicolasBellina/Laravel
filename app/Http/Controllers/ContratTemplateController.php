<?php

namespace App\Http\Controllers;

use App\Models\ContratTemplate;
use App\Models\Location;
use Illuminate\Http\Request;

class ContratTemplateController extends Controller
{
    public function index()
    {
        $templates = auth()->user()->contratTemplates()->latest()->get();
        return view('contrat_templates.index', compact('templates'));
    }

    public function create()
    {
        return view('contrat_templates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        try {
            $template = auth()->user()->contratTemplates()->create($validated);
            return redirect()->route('contrat-templates.index')->with('success', 'Modèle créé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création du modèle')->withInput();
        }
    }

    public function showTemplateSelection(Location $location)
    {
        $templates = auth()->user()->contratTemplates()->latest()->get();
        if ($templates->isEmpty()) {
            return redirect()->route('contrat-templates.create')
                ->with('error', 'Veuillez d\'abord créer un modèle de contrat');
        }
        return view('contrat_templates.select', compact('templates', 'location'));
    }

    public function generateContrat(Location $location, ContratTemplate $template)
    {
        $contrat = $template->generateContrat($location);
        return view('contrat_templates.preview', compact('contrat'));
    }

    public function destroy(ContratTemplate $template)
    {
        if ($template->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            $template->delete();
            return redirect()->route('contrat-templates.index')->with('success', 'Modèle supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression du modèle');
        }
    }
} 