<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <h2 style="font-size: 24px;">
                {{ __('Boxes') }}
            </h2>
            <a href="{{ route('boxes.create') }}" style="color: #007bff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                + Ajouter une box
            </a>
        </div>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border: 1px solid #ddd;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Nom</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Description</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Prix</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Stockage</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Date de création</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Date de modification</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boxes as $box)
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $box->name }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $box->description }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $box->price }}€</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $box->stockage }} m²</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $box->created_at->format('d/m/Y') }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $box->updated_at->format('d/m/Y') }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('boxes.edit', $box) }}" style="color: #28a745; padding: 4px 8px; text-decoration: none; border-radius: 4px;">
                                        Modifier
                                    </a>
                                    <form action="{{ route('boxes.destroy', $box) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color: #dc3545; padding: 4px 8px; border: none; border-radius: 4px; cursor: pointer;" onclick="return confirm('Êtes-vous sûr ?')">
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