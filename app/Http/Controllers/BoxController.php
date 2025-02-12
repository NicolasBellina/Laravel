<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index()
    {
        $boxes = Box::all();
        return view('boxes.index', compact('boxes'));
    }

    public function show(Box $box)
    {
        return view('boxes.show', compact('box'));
    }
    

    public function edit(Box $box)
    {
        return view('boxes.edit', compact('box'));
    }

    public function update(Request $request, Box $box)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        try {
            $box->update($validated);
            return redirect()->route('boxes.index')->with('success', 'Box modifiée avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la modification de la box')->withInput();
        }
    }

    public function destroy(Box $box)
    {
        $box->delete();
        return redirect()->route('boxes.index');
    }

    public function create()
    {
        return view('boxes.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        try {
            $box = Box::create($validated);
            return redirect()->route('boxes.index')->with('success', 'Box créée avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création de la box')->withInput();
        }
    }
    

}
