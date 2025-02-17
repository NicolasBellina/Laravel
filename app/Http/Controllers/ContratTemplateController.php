<?php

namespace App\Http\Controllers;

use App\Models\ContratTemplate;
use App\Models\Location;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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
        return view('contrat_templates.preview', compact('contrat', 'location', 'template'));
    }

    public function generateContratPdf(Location $location, ContratTemplate $template)
    {
        $contrat = $template->generateContrat($location);
        
        $data = [
            'contrat' => $contrat,
            'location' => $location,
            'date' => now()->format('d/m/Y')
        ];

        $pdf = Pdf::loadView('contrat_templates.pdf', $data);
        
        $filename = 'contrat_location_' . $location->id . '_' . now()->format('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
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

    public function edit(ContratTemplate $template)
    {
        if ($template->user_id !== auth()->id()) {
            abort(403);
        }
        return view('contrat_templates.edit', compact('template'));
    }

    public function update(Request $request, ContratTemplate $template)
    {
        if ($template->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'contenu' => 'required|string',
        ]);

        try {
            $template->update($validated);
            return redirect()->route('contrat-templates.index')
                ->with('success', 'Modèle mis à jour avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la mise à jour du modèle')
                ->withInput();
        }
    }
} 