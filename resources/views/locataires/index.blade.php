<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-size: 24px; margin: 0;">
                {{ __('Locataires') }}
            </h2>
            <a href="{{ route('locataire.create') }}" 
               style="background-color: #007bff; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-flex; align-items: center; gap: 4px;">
                <span>+</span> Ajouter un locataire
            </a>
        </div>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                @if(session('success'))
                    <div style="background: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #c3e6cb;">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #f5c6cb;">
                        {{ session('error') }}
                    </div>
                @endif

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
                        <thead>
                            <tr style="background-color: #f8f9fa;">
                                <th style="border: 1px solid #dee2e6; padding: 12px; text-align: left;">Nom</th>
                                <th style="border: 1px solid #dee2e6; padding: 12px; text-align: left;">Téléphone</th>
                                <th style="border: 1px solid #dee2e6; padding: 12px; text-align: left;">Email</th>
                                <th style="border: 1px solid #dee2e6; padding: 12px; text-align: left;">Adresse</th>
                                <th style="border: 1px solid #dee2e6; padding: 12px; text-align: left;">Compte Bancaire</th>
                                <th style="border: 1px solid #dee2e6; padding: 12px; text-align: center; width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($locataires as $locataire)
                                <tr>
                                    <td style="border: 1px solid #dee2e6; padding: 12px;">{{ $locataire->nom }}</td>
                                    <td style="border: 1px solid #dee2e6; padding: 12px;">{{ $locataire->tel }}</td>
                                    <td style="border: 1px solid #dee2e6; padding: 12px;">{{ $locataire->mail }}</td>
                                    <td style="border: 1px solid #dee2e6; padding: 12px;">{{ $locataire->adresse }}</td>
                                    <td style="border: 1px solid #dee2e6; padding: 12px;">{{ $locataire->compte_bancaire }}</td>
                                    <td style="border: 1px solid #dee2e6; padding: 12px;">
                                        <div style="display: flex; justify-content: center; gap: 8px;">
                                            <a href="{{ route('locataire.edit', $locataire) }}" 
                                               style="background-color: #28a745; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 14px;">
                                                Modifier
                                            </a>
                                            <form action="{{ route('locataire.destroy', $locataire) }}" method="POST" style="margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        style="background-color: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce locataire ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="border: 1px solid #dee2e6; padding: 12px; text-align: center; color: #6c757d;">
                                        Aucun locataire trouvé
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 