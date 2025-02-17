<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px;">
            {{ __('Aperçu du contrat') }}
        </h2>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 800px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border: 1px solid #ddd;">
                <div style="white-space: pre-wrap;">{{ $contrat }}</div>
                
                <div style="margin-top: 20px;">
                    <a href="{{ route('contrat-templates.download', ['location' => $location, 'template' => $template]) }}" 
                       class="button"
                       style="color: rgb(0, 0, 0); padding: 8px 16px; text-decoration: none; border-radius: 4px; margin-left: 10px;">
                        Télécharger PDF
                    </a>
                    <a href="{{ route('locations.index') }}" 
                       style="color: rgb(0, 0, 0); padding: 8px 16px; text-decoration: none; border-radius: 4px; margin-left: 10px;">
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 