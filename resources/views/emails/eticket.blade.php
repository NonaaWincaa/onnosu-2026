<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .card { background-color: #3B0A11; color: #ffffff; border: 2px solid #E5C158; border-radius: 12px; padding: 25px; max-width: 500px; margin: auto; }
        .header { text-align: center; border-bottom: 1px solid #E5C158; padding-bottom: 15px; }
        .title { color: #E5C158; font-size: 24px; font-weight: bold; margin: 0; }
        .badge { background-color: #22c55e; color: #ffffff; font-weight: bold; padding: 5px 10px; border-radius: 20px; font-size: 12px; display: inline-block; margin-top: 10px; }
        .detail { margin: 20px 0; font-size: 14px; line-height: 1.6; color: #fdf8ec; }
        .footer { text-align: center; font-size: 11px; color: #E5C158; margin-top: 20px; border-top: 1px stroke #444; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h1 class="title">ONNOSU 2026</h1>
            <p style="margin: 5px 0; font-size: 12px; color: #E5C158;">One Night in North Sumatera</p>
            <span class="badge">STATUS: E-TIKET VERIFIED / LUNAS</span>
        </div>
        
        <div class="detail">
            <p>Halo <strong>{{ $order->nama }}</strong>,</p>
            <p>Pembayaran tiket kamu telah diverifikasi oleh panitia! Berikut adalah detail E-Tiket resmi kamu:</p>
            
            <table style="width: 100%; color: #fdf8ec; font-size: 13px;">
                <tr><td><strong>ID Pesanan:</strong></td><td>ONNOSU-{{ $order->id }}</td></tr>
                <tr><td><strong>Jurusan / Univ:</strong></td><td>{{ $order->jurusan }} / {{ $order->asal_univ }}</td></tr>
                <tr><td><strong>Jumlah Tiket:</strong></td><td>{{ $order->jumlah_tiket }} Tiket</td></tr>
                <tr><td><strong>Batch:</strong></td><td>{{ $order->batch_pembelian }}</td></tr>
                <tr><td><strong>Total Pembayaran:</strong></td><td>Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</td></tr>
            </table>

            <p style="margin-top: 20px; background-color: #2A080C; padding: 10px; border-radius: 8px; text-align: center; color: #E5C158;">
                📌 Tunjuukan email ini kepada panitia di pintu masuk venue pada tanggal <strong>07 November 2026</strong>.
            </p>
        </div>

        <div class="footer">
            Sampai jumpa di ONNOSU 2026! 🎉<br>
            <i>Panitia ONNOSU 2026</i>
        </div>
    </div>
</body>
</html>