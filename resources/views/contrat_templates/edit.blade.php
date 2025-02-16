<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px;">
            {{ __('Modifier le modèle de contrat') }}
        </h2>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                @if ($errors->any())
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('contrat-templates.update', $template) }}">
                    @csrf
                    @method('PUT')
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                            Nom du modèle
                        </label>
                        <input type="text" name="nom" value="{{ old('nom', $template->nom) }}" required 
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                            Contenu du contrat
                        </label>
                        <div style="margin-bottom: 10px;">
                            <button type="button" id="insertExample" 
                                    style="background: #6c757d; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                                <span style="margin-right: 5px;">📄</span> Insérer un exemple
                            </button>
                        </div>
                        <textarea name="contenu" id="contenuTextarea" required 
                                  style="width: 100%; height: 70vh; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-family: monospace; font-size: 14px; line-height: 1.5; resize: vertical;">{{ old('contenu', $template->contenu) }}</textarea>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <a href="{{ route('contrat-templates.index') }}" 
                           style="color: #6c757d; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                            Annuler
                        </a>
                        <button type="submit" 
                                style="color: #007bff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('insertExample').addEventListener('click', function() {
            const example = `CONTRAT DE LOCATION

Entre les soussignés :
@{{ nom_locataire }}
Demeurant à : @{{ adresse_locataire }}
Téléphone : @{{ tel_locataire }}
Email : @{{ mail_locataire }}

Et le propriétaire de la box @{{ box_name }}

Il a été convenu ce qui suit :

Article 1 - Objet du contrat
Le propriétaire donne en location au locataire la box @{{ box_name }}.

Article 2 - Durée
La présente location est consentie pour une durée déterminée :
Du @{{ date_debut }} au @{{ date_fin }}

Article 3 - Loyer
Le montant du loyer est fixé à @{{ montant }} euros.

Fait le @{{ date_debut }}

Signature du locataire                    Signature du propriétaire
________________                          ________________`;

            document.getElementById('contenuTextarea').value = example;
        });
    </script>
</x-app-layout> 