<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contrat de Location</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content {
            margin: 30px 0;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 15px;
            text-decoration: underline;
        }
        .article {
            margin-bottom: 25px;
            padding-left: 20px;
        }
        .article-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .signatures {
            margin-top: 60px;
            page-break-inside: avoid;
        }
        .signature-block {
            width: 45%;
            float: left;
            margin-right: 5%;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 60px;
            width: 200px;
        }
        .signature-text {
            margin-top: 10px;
            font-style: italic;
        }
        .date {
            margin-top: 40px;
            text-align: right;
            font-style: italic;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CONTRAT DE LOCATION</h1>
    </div>

    <div class="content">
        {!! nl2br(e($contrat)) !!}
    </div>

    <div class="signatures clearfix">
        <div class="signature-block">
            <div class="signature-line"></div>
            <div class="signature-text">Signature du locataire<br>précédée de la mention "Lu et approuvé"</div>
        </div>
        <div class="signature-block">
            <div class="signature-line"></div>
            <div class="signature-text">Signature du propriétaire<br>précédée de la mention "Lu et approuvé"</div>
        </div>
    </div>

    <div class="date">
        Fait à ______________, le {{ $date }}
    </div>
</body>
</html> 