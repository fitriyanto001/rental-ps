<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Penjualan Kantin AJIS-PS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            background-color: #fff;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 20px;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 12px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 8px 12px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature-box {
            text-align: center;
            width: 200px;
        }
        .signature-box p {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>AJIS-PS PLAYSTATION RENTAL & KANTIN</h2>
        <p>Laporan Penjualan Kantin & Billing Rental Terpadu</p>
        <p>Tanggal Cetak: {{ date('d-m-Y H:i') }} WIB | Oleh: Fitriyanto (Kasir)</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Nama PS</th>
                <th>Rincian Menu Kantin</th>
                <th class="text-right">Total Kantin</th>
                <th class="text-right">Total Rental</th>
                <th class="text-right">Grand Total</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $grandTotalKantin = 0;
                $grandTotalRental = 0;
                $grandTotalOmset = 0;
            @endphp
            @forelse($transactions as $key => $tx)
                @php
                    $grandTotalKantin += $tx->total_kantin;
                    $grandTotalRental += $tx->total_rental;
                    $grandTotalOmset += $tx->grand_total;
                @endphp
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $tx->created_at->format('d-m-Y H:i') }} WIB</td>
                    <td><strong>{{ $tx->renter_name }}</strong></td>
                    <td>{{ $tx->console->name ?? 'PS Terhapus' }}</td>
                    <td>
                        @php $foodStrings = []; @endphp
                        @foreach($tx->transactionFoods as $food)
                            @php $foodStrings[] = ($food->menuKantin->nama_menu ?? 'Menu Terhapus') . ' (x' . $food->qty . ')'; @endphp
                        @endforeach
                        {{ implode(', ', $foodStrings) ?: '-' }}
                    </td>
                    <td class="text-right">Rp {{ number_format($tx->total_kantin, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($tx->total_rental, 0, ',', '.') }}</td>
                    <td class="text-right"><strong>Rp {{ number_format($tx->grand_total, 0, ',', '.') }}</strong></td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada transaksi ditemukan</td>
                </tr>
            @endforelse
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="5" class="text-center">TOTAL KESELURUHAN</td>
                <td class="text-right">Rp {{ number_format($grandTotalKantin, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($grandTotalRental, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($grandTotalOmset, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <div class="signature-box">
            <p>Kasir Operasional</p>
            <p>( Fitriyanto )</p>
        </div>
        <div class="signature-box">
            <p>Owner AJIS-PS</p>
            <p>( Owner PS )</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
