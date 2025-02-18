<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .info-block {
            margin-bottom: 20px;
        }
        .info-label {
            color: #666;
            font-size: 14px;
        }
        .info-value {
            font-size: 16px;
            font-weight: bold;
        }
        .warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            margin-top: 20px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Déclaration d'Impôts {{ $impot->annee }}</h1>
    </div>

    <div class="info-block">
        <p class="info-label">Montant total des revenus</p>
        <p class="info-value">{{ number_format($impot->montant_total, 2, ',', ' ') }} €</p>
    </div>

    <div class="info-block">
        <p class="info-label">Régime fiscal</p>
        <p class="info-value">{{ ucfirst($impot->regime) }}</p>
    </div>

    <div class="info-block">
        <p class="info-label">Case de déclaration</p>
        <p class="info-value">{{ $impot->case_declaration }}</p>
    </div>

    <div class="info-block">
        <p class="info-label">Montant imposable</p>
        <p class="info-value">{{ number_format($impot->montant_imposable, 2, ',', ' ') }} €</p>
        @if($impot->regime === 'micro-foncier')
            <p><em>(Après abattement de 30%)</em></p>
        @endif
    </div>

    @if($impot->regime_reel_obligatoire)
        <div class="warning">
            Régime réel obligatoire (revenus > 15 000€)
        </div>
    @endif
</body>
</html> 