<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture {{ $numero_facture }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            margin-bottom: 40px;
        }
        .facture-info {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FACTURE</h1>
        <p>N° {{ $numero_facture }}</p>
        <p>Date : {{ $date_facture }}</p>
    </div>

    <div class="facture-info">
        <div style="float: left;">
            <strong>Émetteur :</strong><br>
            {{ auth()->user()->name }}<br>
        </div>
        <div style="float: right;">
            <strong>Client :</strong><br>
            {{ $locataire->nom }}<br>
            {{ $locataire->adresse }}<br>
            {{ $locataire->email }}
        </div>
        <div style="clear: both;"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Période</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Location Box {{ $box->name }}</td>
                <td>{{ $paiement->date_paiement->format('F Y') }}</td>
                <td>{{ number_format($paiement->montant, 2, ',', ' ') }} €</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total TTC : {{ number_format($paiement->montant, 2, ',', ' ') }} €</strong></p>
    </div>

    <div style="margin-top: 40px;">
        <p>Mode de paiement : {{ $paiement->methode_paiement_formattee }}</p>
        <p>Date de paiement : {{ $paiement->date_paiement->format('d/m/Y') }}</p>
    </div>
</body>
</html>