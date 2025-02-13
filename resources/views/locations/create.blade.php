<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px;">
            {{ __('Créer une location') }}
        </h2>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border: 1px solid #ddd;">
                @if ($errors->any())
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 4px;">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('locations.store') }}">
                    @csrf
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Box
                        </label>
                        <select name="box_id" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                            <option value="">Sélectionnez une box</option>
                            @foreach(auth()->user()->boxes as $box)
                                <option value="{{ $box->id }}">{{ $box->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Locataire
                        </label>
                        <select name="locataire_id" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                            <option value="">Sélectionnez un locataire</option>
                            @foreach(auth()->user()->locataires as $locataire)
                                <option value="{{ $locataire->id }}">{{ $locataire->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Date de début
                        </label>
                        <input type="date" name="date_de_debut" required 
                               style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Date de fin
                        </label>
                        <input type="date" name="date_de_fin" required 
                               style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Montant payé
                        </label>
                        <input type="number" step="0.01" name="montant_paye" required 
                               style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" style="color: rgb(0, 0, 0); padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                            Créer
                        </button>
                        <a href="{{ route('locations.index') }}" style="color: rgb(0, 0, 0); padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 