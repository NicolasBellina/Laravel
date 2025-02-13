<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 24px;">
                {{ __('Sélectionner un modèle de contrat') }}
            </h2>
            <a href="{{ route('contrat-templates.create') }}" 
               style="color: #007bff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                + Nouveau modèle
            </a>
        </div>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Information sur la location -->
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <h3 style="font-size: 16px; color: #495057; margin-bottom: 10px;">Détails de la location</h3>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                    <div>
                        <p style="color: #6c757d; font-size: 14px;">Box</p>
                        <p style="font-weight: 500;">{{ $location->box->name }}</p>
                    </div>
                    <div>
                        <p style="color: #6c757d; font-size: 14px;">Locataire</p>
                        <p style="font-weight: 500;">{{ $location->locataire->nom }}</p>
                    </div>
                    <div>
                        <p style="color: #6c757d; font-size: 14px;">Période</p>
                        <p style="font-weight: 500;">Du {{ $location->date_de_debut->format('d/m/Y') }} au {{ $location->date_de_fin->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p style="color: #6c757d; font-size: 14px;">Montant</p>
                        <p style="font-weight: 500;">{{ $location->montant_paye }}€</p>
                    </div>
                </div>
            </div>

            <!-- Liste des modèles -->
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="font-size: 18px; margin-bottom: 20px;">Modèles disponibles</h3>
                
                <div style="display: grid; gap: 15px;">
                    @forelse($templates as $template)
                        <div style="border: 1px solid #e9ecef; padding: 20px; border-radius: 8px;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h4 style="font-size: 16px; font-weight: 600; color: #212529;">{{ $template->nom }}</h4>
                                    <p style="color: #6c757d; font-size: 14px; margin-top: 5px;">
                                        Créé le {{ $template->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <form action="{{ route('contrat-templates.generate', ['location' => $location->id, 'template' => $template->id]) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" 
                                                style="color: #007bff; padding: 4px 8px; border: none; border-radius: 4px; cursor: pointer; background: none;">
                                            Utiliser
                                        </button>
                                    </form>
                                    <form action="{{ route('contrat-templates.destroy', $template) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce modèle ?')"
                                                style="color: #dc3545; padding: 4px 8px; border: none; border-radius: 4px; cursor: pointer; background: none;">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 40px;">
                            <p style="color: #6c757d; margin-bottom: 15px;">Aucun modèle de contrat disponible</p>
                            <a href="{{ route('contrat-templates.create') }}" 
                               style="color: #007bff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                                Créer votre premier modèle
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 