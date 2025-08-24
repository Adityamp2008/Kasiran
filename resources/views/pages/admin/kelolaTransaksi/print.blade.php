<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Struk Transaksi</title>
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 20px;
    background: #fff;
    display: flex;
    justify-content: center;
}
.container {
    width: 350px;
    text-align: center;
}
.header img {
    max-width: 80px;
    margin-bottom: 10px;
}
.header h2, .header p {
    margin: 0;
}
hr {
    border: 0;
    border-top: 1px dashed #999;
    margin: 10px 0;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 14px;
}
th, td {
    padding: 4px 0;
}
th {
    text-align: left;
    border-bottom: 1px solid #000;
}
td.text-right {
    text-align: right;
}
.total-row td {
    font-weight: bold;
    border-top: 1px solid #000;
}
.footer p {
    margin: 5px 0;
    font-size: 12px;
}
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="{{ asset('frontend/assets/images/favicon.png') }}" alt="Logo">
        <h2>{{ config('app.name') }}</h2>
    </div>

    <hr>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $trx->product->supplier->nama_product ?? '-' }}</td>
                <td class="text-right">{{ $trx->jumlah }}</td>
                <td class="text-right">Rp {{ number_format($trx->product->harga_jual,0,',','.') }}</td>
                <td class="text-right">Rp {{ number_format($trx->total,0,',','.') }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="text-right">TOTAL</td>
                <td class="text-right">Rp {{ number_format($trx->total,0,',','.') }}</td>
            </tr>
        </tfoot>
    </table>

    <hr>

    <div class="footer">
        <p>Terima kasih telah berbelanja!</p>
    </div>
</div>

<script>
window.onload = function() {
    window.print();
}
</script>
</body>
</html>
