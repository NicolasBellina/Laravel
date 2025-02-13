<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <h2 style="font-size: 24px;">
                {{ __('Locataires') }}
            </h2>
            <a href="{{ route('locataire.create') }}" style="color: #007bff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                + Ajouter un locataire
            </a>
        </div>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border: 1px solid #ddd;">
                @if(session('success'))
                    <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                        {{ session('error') }}
                    </div>
                @endif

                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Nom</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Téléphone</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Email</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Adresse</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Compte Bancaire</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locataires as $locataire)
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $locataire->nom }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $locataire->tel }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $locataire->mail }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $locataire->adresse }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $locataire->compte_bancaire }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">
                                    <div style="display: flex; gap: 10px;">
                                        <a href="{{ route('locataire.edit', $locataire) }}" 
                                        style="color: #28a745; padding: 4px 8px; text-decoration: none; border-radius: 4px;">
                                            Modifier
                                        </a>
                                        <form action="{{ route('locataire.destroy', $locataire) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style= "color: #dc3545; padding: 4px 8px; border: none; border-radius: 4px; cursor: pointer;" onclick="return confirm('Êtes-vous sûr ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                    Aucun locataire trouvé
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 