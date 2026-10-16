<ElicitationsGroup>

Ini salinan kodenya tanpa blok format khusus agar kamu bisa langsung me-blok dan meng-copast teksnya dengan mudah:

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket ONNOSU 2026</title>
    <script src="[https://cdn.tailwindcss.com](https://cdn.tailwindcss.com)"></script>
</head>
<body class="bg-[#2A080C] text-white flex justify-center items-center min-h-screen p-4">

    <div class="max-w-md w-full bg-[#1A0305] border border-[#C69968] rounded-xl p-6 shadow-2xl text-center">
        <h1 class="text-3xl font-bold tracking-wider text-[#C69968]">ONNOSU 2026</h1>
        <p class="text-sm tracking-widest text-gray-300 uppercase mt-1">One Night in North Sumatera</p>
        <p class="text-xs text-gray-400 mt-1 mb-6">📅 07 November 2026</p>

        <div class="bg-[#3D0C10] border border-[#C69968]/40 rounded-lg p-3 mb-6">
            <span class="bg-[#C69968] text-[#1A0305] text-xs font-bold px-2.5 py-1 rounded-full uppercase">
                Batch Aktif
            </span>
            <h2 class="text-lg font-semibold mt-2 text-[#F9F3DC]">
                Presale 1 (Early Bird) — Rp 20.000 / Tiket
            </h2>
            <p class="text-xs text-amber-300 mt-1">
                🎁 Promo Bundle: Beli ≥ 4 Tiket Potongan Rp 5.000!
            </p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-800 text-emerald-100 text-sm p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('tiket.store') }}" method="POST" class="text-left space-y-4">
            @csrf

            <div>
                <label for="nama" class="block text-xs font-semibold uppercase tracking-wider text-[#C69968] mb-1">
                    Nama Lengkap
                </label>
                <input 
                    type="text" 
                    id="nama" 
                    name="nama" 
                    required 
                    placeholder="Masukkan nama lengkap"
                    class="w-full bg-[#2A080C] border border-[#C69968]/50 rounded-lg px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C69968]"
                >
            </div>

            <div>
                <label for="jumlah" class="block text-xs font-semibold uppercase tracking-wider text-[#C69968] mb-1">
                    Jumlah Tiket
                </label>
                <input 
                    type="number" 
                    id="jumlah" 
                    name="jumlah" 
                    min="1" 
                    value="1" 
                    required 
                    class="w-full bg-[#2A080C] border border-[#C69968]/50 rounded-lg px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C69968]"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-[#C69968] hover:bg-[#b58857] text-[#1A0305] font-bold py-3 rounded-lg shadow-lg transition duration-200 mt-2"
            >
                Pesan Tiket Sekarang
            </button>
        </form>
    </div>

</body>
</html>