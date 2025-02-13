<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px;">
            {{ __('Modifier le locataire') }}
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

                <form method="POST" action="{{ route('locataire.update', $locataire) }}">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Nom
                        </label>
                        <input type="text" name="nom" value="{{ $locataire->nom }}" required 
                            style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Téléphone
                        </label>
                        <input type="text" name="tel" value="{{ $locataire->tel }}" required 
                            style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Mail
                        </label>
                        <input type="text" name="mail" value="{{ $locataire->mail }}" required 
                            style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Adresse
                        </label>
                        <input type="text" name="adresse" value="{{ $locataire->adresse }}" required 
                            style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px;">
                            Compte Bancaire
                        </label>
                        <input type="text" name="compte_bancaire" value="{{ $locataire->compte_bancaire }}" required 
                            style="width: 100%; padding: 8px; border: 1px solid #ddd;">
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" style="color: rgb(0, 0, 0); padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                            Modifier
                        </button>
                        <a href="{{ route('locataire.index') }}" style="color: rgb(0, 0, 0); padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 