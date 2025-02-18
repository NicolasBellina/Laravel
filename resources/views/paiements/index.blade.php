<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 24px;">
            Suivi des paiements - Location {{ $location->box->name }}
        </h2>
    </x-slot>

    <div style="padding: 20px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                        <div>
                            <p style="color: #6c757d;">Locataire</p>
                            <p style="font-weight: 500;">{{ $location->locataire->nom }}</p>
                        </div>
                        <div>
                            <p style="color: #6c757d;">Box</p>
                            <p style="font-weight: 500;">{{ $location->box->name }}</p>
                        </div>
                        <div>
                            <p style="color: #6c757d;">Période</p>
                            <p style="font-weight: 500;">
                                Du {{ $location->date_de_debut->format('d/m/Y') }} 
                                au {{ $location->date_de_fin->format('d/m/Y') }}
                            </p>
                        </div>
                        <div>
                            <p style="color: #6c757d;">Montant mensuel</p>
                            <p style="font-weight: 500;">{{ $location->montant_paye }}€</p>
                        </div>
                    </div>
                </div>

                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="padding: 12px; border-bottom: 2px solid #dee2e6; text-align: left;">Mois</th>
                            <th style="padding: 12px; border-bottom: 2px solid #dee2e6; text-align: left;">Statut</th>
                            <th style="padding: 12px; border-bottom: 2px solid #dee2e6; text-align: left;">Date de paiement</th>
                            <th style="padding: 12px; border-bottom: 2px solid #dee2e6; text-align: left;">Mode de paiement</th>
                            <th style="padding: 12px; border-bottom: 2px solid #dee2e6; text-align: left;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paiements as $paiement)
                        <tr>
                            <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                                {{ $paiement->date_paiement->format('F Y') }}
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                                <form action="{{ route('paiements.update', $paiement) }}" 
                                      method="POST" 
                                      style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="date_paiement" value="{{ $paiement->date_paiement->format('Y-m-d') }}">
                                    <input type="hidden" name="est_paye" value="0">
                                    <label style="display: flex; align-items: center; gap: 8px;">
                                        <input type="checkbox" 
                                               name="est_paye" 
                                               value="1" 
                                               {{ $paiement->est_paye ? 'checked' : '' }}
                                               onchange="this.form.submit()"
                                               style="width: 18px; height: 18px;">
                                        {{ $paiement->est_paye ? 'Payé' : 'Non payé' }}
                                    </label>
                                </form>
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                                {{ $paiement->est_paye ? $paiement->date_paiement->format('d/m/Y') : '-' }}
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                                <form action="{{ route('paiements.update', $paiement) }}" 
                                      method="POST" 
                                      style="display: flex; gap: 10px; align-items: center;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="date_paiement" value="{{ $paiement->date_paiement->format('Y-m-d') }}">
                                    <input type="hidden" name="est_paye" value="{{ $paiement->est_paye }}">
                                    <select name="methode_paiement" 
                                            onchange="this.form.submit()"
                                            style="padding: 6px; border: 1px solid #ddd; border-radius: 4px; background-color: white;">
                                        <option value="" {{ is_null($paiement->methode_paiement) ? 'selected' : '' }}>-</option>
                                        <option value="carte_bancaire" {{ $paiement->methode_paiement === 'carte_bancaire' ? 'selected' : '' }}>Carte bancaire</option>
                                        <option value="virement" {{ $paiement->methode_paiement === 'virement' ? 'selected' : '' }}>Virement bancaire</option>
                                        <option value="especes" {{ $paiement->methode_paiement === 'especes' ? 'selected' : '' }}>Espèces</option>
                                        <option value="cheque" {{ $paiement->methode_paiement === 'cheque' ? 'selected' : '' }}>Chèque</option>
                                        <option value="prelevement" {{ $paiement->methode_paiement === 'prelevement' ? 'selected' : '' }}>Prélèvement</option>
                                    </select>
                                </form>
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                                {{ $paiement->methode_paiement_formattee }}
                            </td>
                            <td style="padding: 12px; border-bottom: 1px solid #dee2e6;">
                                @if($paiement->est_paye)
                                    <a href="{{ route('factures.generate', $paiement) }}" 
                                       target="_blank"
                                       style="color: #28a745; padding: 4px 8px; text-decoration: none; border-radius: 4px; margin-right: 8px;">
                                        Générer Facture
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(paiementId) {
        }
    </script>
</x-app-layout> 