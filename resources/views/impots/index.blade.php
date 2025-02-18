<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Déclaration d'impôts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($impots as $impot)
                        <div class="mb-8 p-4 border rounded">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Année {{ is_array($impot) ? $impot['annee'] : $impot->annee }}</h3>
                               
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-gray-600">Montant total des revenus</p>
                                    <p class="font-semibold">{{ number_format(is_array($impot) ? $impot['montant_total'] : $impot->montant_total, 2, ',', ' ') }} €</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-600">Régime recommandé</p>
                                    <p class="font-semibold">{{ ucfirst(is_array($impot) ? $impot['regime_recommande'] : $impot->regime) }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-600">Case de déclaration</p>
                                    <p class="font-semibold">{{ is_array($impot) ? $impot['case_declaration'] : $impot->case_declaration }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-gray-600">Montant imposable</p>
                                    <p class="font-semibold">{{ number_format(is_array($impot) ? $impot['montant_imposable'] : $impot->montant_imposable, 2, ',', ' ') }} €</p>
                                </div>
                            </div>

                            @if((!is_array($impot) && $impot->regime_reel_obligatoire) || (is_array($impot) && $impot['montant_total'] > 15000))
                                <div class="mt-4 p-2 bg-yellow-100 text-yellow-800 rounded">
                                    ⚠️ Régime réel obligatoire (revenus > 15 000€)
                                </div>
                            @endif
                            
                            @if(!is_array($impot) && $impot->montant_total > 0)
                            <a href="{{ route('impots.export', ['annee' => $impot->annee]) }}" 
                               class="text-blue-500" style="text-decoration: none;">
                                Exporter en PDF
                            </a>
                        @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 