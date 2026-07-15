<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Laporan PDF')</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #1a202c;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #718096;
        }
        .table-responsive {
            width: 100%;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #cbd5e0;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f7fafc;
            font-weight: bold;
            color: #4a5568;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-bold { font-weight: bold; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #718096;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }
        .badge-success { background-color: #c6f6d5; color: #276749; }
        .badge-warning { background-color: #feebc8; color: #c05621; }
        .badge-danger { background-color: #fed7d7; color: #9b2c2c; }
        .badge-info { background-color: #bee3f8; color: #2c5282; }
        
        .page-break {
            page-break-after: always;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="header">
        <h1>TokoKita</h1>
        <p>Platform E-Commerce UMKM</p>
        <p>@yield('report_title')</p>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
        <p>&copy; {{ date('Y') }} TokoKita. Hak Cipta Dilindungi.</p>
    </div>
</body>
</html>
