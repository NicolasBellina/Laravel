<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px;">
            {{ __('Créer un modèle de contrat') }}
        </h2>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 1000px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <form method="POST" action="{{ route('contrat-templates.store') }}">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                            Nom du modèle
                        </label>
                        <input type="text" name="nom" placeholder="Ex: Contrat de location standard" required 
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>

                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">
                                Contenu du contrat
                            </label>
                            <div style="margin-bottom: 10px;">
                                <button type="button" id="insertExample" 
                                        style="background: #6c757d; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; transition: background 0.3s;">
                                    <span style="margin-right: 5px;">📄</span> Insérer un exemple
                                </button>
                            </div>
                            <textarea name="contenu" id="contenuTextarea" required 
                                      style="width: 100%; height: 600px; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-family: monospace; font-size: 14px; line-height: 1.5;"></textarea>
                        </div>

                        <div>
                            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; position: sticky; top: 20px;">
                                <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 15px;">Variables disponibles</h3>
                                <div style="display: grid; gap: 10px;">
                                    @foreach([
                                        'nom_locataire' => 'Nom du locataire',
                                        'tel_locataire' => 'Téléphone',
                                        'mail_locataire' => 'Email',
                                        'adresse_locataire' => 'Adresse',
                                        'box_name' => 'Nom de la box',
                                        'date_debut' => 'Date de début',
                                        'date_fin' => 'Date de fin',
                                        'montant' => 'Montant du loyer'
                                    ] as $var => $desc)
                                        <div class="variable-item" 
                                             style="padding: 8px; background: white; border-radius: 4px; cursor: pointer; transition: all 0.2s;"
                                             onclick="insertVariable('{{ $var }}')">
                                            <code style="color: #007bff;">@{{ {{ $var }} }}</code>
                                            <span style="color: #6c757d; font-size: 0.9em;"> - {{ $desc }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 20px; text-align: right;">
                        <button type="submit" 
                                style="color: #007bff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                            Créer le modèle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .variable-item:hover {
            background: #e9ecef !important;
            transform: translateX(5px);
        }
    </style>

    <script>
        function insertVariable(variable) {
            const textarea = document.getElementById('contenuTextarea');
            const text = `@{{ ${variable} }}`;
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            textarea.value = textarea.value.substring(0, start) + text + textarea.value.substring(end);
            textarea.focus();
            textarea.selectionStart = textarea.selectionEnd = start + text.length;
        }

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