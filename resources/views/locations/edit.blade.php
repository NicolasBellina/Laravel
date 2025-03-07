<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px;">
            {{ __('Modifier la location') }}
        </h2>
    </x-slot>  

    

    <div style="padding: 20px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border: 1px solid #ddd;">
                @if ($errors->any())
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('locations.update', $location) }}">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Box
                        </label>
                        <select name="box_id" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                            @foreach(auth()->user()->boxes as $box)
                                <option value="{{ $box->id }}" {{ $location->box_id == $box->id ? 'selected' : '' }}>
                                    {{ $box->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Locataire
                        </label>
                        <select name="locataire_id" required style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                            @foreach(auth()->user()->locataires as $locataire)
                                <option value="{{ $locataire->id }}" {{ $location->locataire_id == $locataire->id ? 'selected' : '' }}>
                                    {{ $locataire->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Date de début
                        </label>
                        <input type="date" name="date_de_debut" value="{{ $location->date_de_debut->format('Y-m-d') }}" required 
                            style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Date de fin
                        </label>
                        <input type="date" name="date_de_fin" value="{{ $location->date_de_fin->format('Y-m-d') }}" required 
                            style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Montant payé
                        </label>
                        <input type="number" step="0.01" name="montant_paye" value="{{ $location->montant_paye }}" required 
                            style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" style="color: rgb(0, 0, 0); padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                            Modifier
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