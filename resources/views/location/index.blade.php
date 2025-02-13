<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <h2 style="font-size: 24px;">
            {{ __('Locations') }}
            </h2>
            <a href="{{ route('location.create') }}" style="color: #007bff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                + Ajouter une location
            </a>
        </div>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border: 1px solid #ddd;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Date de début</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Date de fin</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Montant payé</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Locataire</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $location)
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $location->date_de_debut }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $location->date_de_fin }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $location->montant_paye }}€</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $location->locataire_id }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('location.edit', $location) }}" style="color: #28a745; padding: 4px 8px; text-decoration: none; border-radius: 4px;">
                                        Modifier
                                    </a>
                                    <form action="{{ route('location.destroy', $location) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style= "color: #dc3545; padding: 4px 8px; border: none; border-radius: 4px; cursor: pointer;" onclick="return confirm('Êtes-vous sûr ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 