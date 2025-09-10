<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            max-width: 300px;
            margin: 0 auto;
        }
        .center { text-align: center; }
        .right { text-align: right; }
        .line { border-bottom: 1px dashed #000; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 2px 0; }
    </style>
</head>
<body onload="window.print()">
    <div class="center">
        <strong>Kasiran</strong><br>
        <p>JL.selajambe toko {{ENV('APP_NAME')}}</p><br><br>
        -------------------------------
    </div>

    <div>
        <table>
            <tr>
                <td>Kode Transaksi</td>
                <td class="right">{{ $transaksi->kode_transaksi }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td class="right">{{ $transaksi->created_at->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="line"></div>

    <table>
        @foreach($transaksi->details as $detail)
        <tr>
            <td>{{ $detail->product->supplier->nama_product ?? '-' }} x{{ $detail->jumlah }}</td>
            <td class="right">Rp {{ number_format($detail->subtotal,0,',','.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="line"></div>

    <table>
        @if($transaksi->diskon)
        <tr>
            <td>Diskon</td>
            <td class="right">- Rp {{ number_format($transaksi->total + $transaksi->diskon->nilai - $transaksi->total,0,',','.') }}</td>
        </tr>
        @endif
        <tr>
            <td><strong>Total</strong></td>
            <td class="right"><strong>Rp {{ number_format($transaksi->total,0,',','.') }}</strong></td>
        </tr>
    </table>

    <div class="line"></div>
    <div class="center">
        Terima kasih telah berbelanja!<br>
        **Barang yang sudah dibeli tidak dapat dikembalikan**
    </div>
</body>
</html>
