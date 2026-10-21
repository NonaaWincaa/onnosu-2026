<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket ONNOSU 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center bg-fixed min-h-screen font-sans flex flex-col items-center justify-center p-4" style="background-image: url('{{ asset('assets/bg-onnosu.jpg') }}');">

    <div class="max-w-lg w-full bg-[#3B0A11] border-2 border-[#E5C158] rounded-2xl p-6 shadow-2xl my-8">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-[#E5C158] tracking-wider uppercase mb-1">ONNOSU 2026</h1>
            <p class="text-sm text-[#FDF8EC] opacity-80 tracking-widest uppercase">One Night in North Sumatera</p>
            <p class="text-xs text-[#E5C158] mt-1">🗓 07 November 2026</p>
        </div>

        <div class="bg-[#2A080C] border border-[#E5C158]/50 rounded-xl p-3 text-center mb-6">
            <span class="bg-[#E5C158] text-[#2A080C] text-xs font-bold px-2 py-1 rounded-full uppercase">Batch Aktif</span>
            <p class="text-lg font-bold text-[#E5C158] mt-1">{{ $batch_nama }} — Rp {{ number_format($harga_tiket, 0, ',', '.') }} / Tiket</p>
            <p class="text-xs text-emerald-400 mt-1">🎁 Promo Bundle: Beli ≥ 4 Tiket Potongan Rp 5.000!</p>
        </div>

        @if(session('sukses'))
            <div class="bg-emerald-800/80 border border-emerald-400 text-emerald-100 p-3 rounded-lg text-center mb-4 text-sm">
                {{ session('sukses') }}
            </div>
        @endif

        <form action="{{ route('tiket.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-[#E5C158] uppercase mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required class="w-full bg-[#2A080C] border border-[#E5C158]/30 rounded-lg p-2.5 text-white focus:outline-none focus:border-[#E5C158]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#E5C158] uppercase mb-1">Alamat Email (Untuk Pengiriman E-Tiket)</label>
                <input type="email" name="email" required placeholder="nama@email.com" class="w-full bg-[#2A080C] border border-[#E5C158]/30 rounded-lg p-2.5 text-white focus:outline-none focus:border-[#E5C158]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#E5C158] uppercase mb-1">Jurusan</label>
                <input type="text" name="jurusan" required class="w-full bg-[#2A080C] border border-[#E5C158]/30 rounded-lg p-2.5 text-white focus:outline-none focus:border-[#E5C158]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#E5C158] uppercase mb-1">Asal fakultas</label>
                <input type="text" name="asal_fakultas" required class="w-full bg-[#2A080C] border border-[#E5C158]/30 rounded-lg p-2.5 text-white focus:outline-none focus:border-[#E5C158]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#E5C158] uppercase mb-1">Jumlah Tiket</label>
                <input type="number" id="jumlah_tiket" name="jumlah_tiket" min="1" value="1" oninput="hitungTotal()" required class="w-full bg-[#2A080C] border border-[#E5C158]/30 rounded-lg p-2.5 text-white focus:outline-none focus:border-[#E5C158]">
                <p id="info_diskon" class="text-xs text-emerald-400 font-semibold mt-1"></p>
            </div>

            <div class="bg-[#2A080C] border border-[#E5C158] rounded-xl p-4 text-center">
                <span class="text-xs text-gray-300 uppercase">Total Pembayaran</span>
                <div id="total_bayar" class="text-2xl font-black text-[#E5C158]">Rp {{ number_format($harga_tiket, 0, ',', '.') }}</div>
            </div>

            <div class="text-center pt-2">
                <p class="text-xs font-semibold text-[#E5C158] uppercase mb-2">Scan QRIS Untuk Pembayaran</p>
                <div class="bg-white p-3 rounded-xl inline-block border-2 border-[#E5C158]">
                    <img src="{{ asset('assets/qris.jpeg') }}" alt="QRIS ONNOSU 2026" class="w-48 h-48 object-contain mx-auto" onerror="this.src='https://via.placeholder.com/200x200?text=Gambar+QRIS+Panitia'">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#E5C158] uppercase mb-1">Upload Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" accept="image/*" required class="w-full bg-[#2A080C] border border-[#E5C158]/30 rounded-lg p-2 text-xs text-gray-300 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#E5C158] file:text-[#2A080C]">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-[#E5C158] to-[#DFB243] text-[#2A080C] font-bold py-3 rounded-xl hover:opacity-90 transition duration-200 uppercase tracking-wider shadow-lg">
                Pesan Tiket Sekarang
            </button>
        </form>
    </div>

    <!-- MODAL BUKTI PEMESANAN (E-RECEIPT) -->
    @if(session('sukses'))
    <div id="receiptModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 z-50">
        <div class="bg-[#3B0A11] border-2 border-[#E5C158] max-w-md w-full rounded-2xl p-6 shadow-2xl text-center relative">
            <div class="w-12 h-12 bg-amber-500/20 border border-[#E5C158] rounded-full flex items-center justify-center mx-auto mb-3 text-2xl">
                ⏳
            </div>
            <h2 class="text-xl font-bold text-[#E5C158] uppercase tracking-wider">Bukti Pemesanan Tiket</h2>
            <p class="text-xs text-gray-300 mb-4">ONNOSU 2026 — One Night in North Sumatera</p>
            
            <div class="bg-[#2A080C] border border-[#E5C158]/30 rounded-xl p-4 text-left space-y-2 text-xs mb-4">
                <div class="flex justify-between border-b border-gray-700 pb-2">
                    <span class="text-gray-400">Status Pembayaran:</span>
                    <span class="text-amber-400 font-bold">MENUNGGU VERIFIKASI</span>
                </div>
                <p class="text-gray-200 mt-2">Terima kasih telah melakukan pemesanan! Bukti transfer kamu sudah diterima dan sedang diproses panitia.</p>
                <div class="bg-amber-900/30 border border-amber-500/40 p-2.5 rounded-lg mt-3 text-[11px] text-amber-200">
                    💡 <strong>Catatan:</strong> E-Ticket resmi akan otomatis dikirimkan ke <strong>email kamu</strong> setelah pembayaran diverifikasi oleh panitia.
                </div>
            </div>

            <button onclick="document.getElementById('receiptModal').remove()" class="w-full bg-[#E5C158] text-[#2A080C] font-bold py-2.5 rounded-xl text-xs uppercase tracking-wider hover:bg-[#dfb243]">
                Tutup & Simpan
            </button>
        </div>
    </div>
    @endif

    <script>
        const hargaPerTiket = {{ $harga_tiket }};
        function hitungTotal() {
            let jumlah = parseInt(document.getElementById('jumlah_tiket').value) || 0;
            let diskon = (jumlah >= 4) ? 5000 : 0;
            if (diskon > 0) {
                document.getElementById('info_diskon').innerText = "🎉 Kamu hemat Rp 5.000 dengan promo bundle!";
            } else {
                document.getElementById('info_diskon').innerText = "";
            }
            let total = (jumlah * hargaPerTiket) - diskon;
            if (total < 0) total = 0;
            document.getElementById('total_bayar').innerText = "Rp " + total.toLocaleString('id-ID');
        }
    </script>
</body>
</html>