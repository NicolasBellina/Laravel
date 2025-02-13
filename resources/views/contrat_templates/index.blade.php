<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <h2 style="font-size: 24px;">
                {{ __('Modèles de contrat') }}
            </h2>
            <a href="{{ route('contrat-templates.create') }}" style="color: #007bff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                + Créer un modèle
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

                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Nom</th>
                            <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($templates as $template)
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px;">{{ $template->nom }}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">
                                    <div style="display: flex; gap: 10px;">
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
                                </td>
                            </tr>
                        @empty
                    
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 