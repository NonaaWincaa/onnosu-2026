<div class="max-w-md w-full bg-[#1A0305] border border-[#C69968] rounded-xl p-6 shadow-2xl text-center">
    <h1 class="text-3xl font-bold tracking-wider text-[#C69968]">ONNOSU 2026</h1>
    <p class="text-sm tracking-widest text-gray-300 uppercase mt-1">One Night in North Sumatera</p>
    <div class="text-xs text-gray-300 mt-2 mb-6 space-y-1">
        <p>📅 Jumat, 27 November 2026 | 🕕 18.00 WIB</p>
        <p>📍 Lapangan GSG, Telkom University</p>
        <p class="text-amber-300 font-semibold pt-1">Open Order Tiket: 17 – 27 November 2026</p>
    </div>

    <div class="bg-[#3D0C10] border border-[#C69968]/40 rounded-lg p-3 mb-6">
        <span class="bg-[#C69968] text-[#1A0305] text-xs font-bold px-2.5 py-1 rounded-full uppercase">
            Batch Aktif
        </span>
        <h2 class="text-lg font-semibold mt-2 text-[#F9F3DC]">
            Batch 3 — Rp 25.000 / Tiket
        </h2>
        <p class="text-xs text-amber-300 mt-1">
            🎁 Promo Bundle: Beli ≥ 4 Tiket Potongan Rp 5.000!
        </p>
    </div>

    @if(session('sukses') || session('success'))
        <div class="bg-emerald-800 text-emerald-100 text-sm p-3 rounded-lg mb-4">
            {{ session('sukses') ?? session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-800 text-red-100 text-sm p-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-900/80 border border-red-500 text-red-200 text-xs text-left p-3 rounded-lg mb-4">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($is_buka) && !$is_buka)
        <div class="bg-red-900/60 border border-red-500 text-red-200 p-4 rounded-lg my-4">
            <p class="font-bold">Pemesanan Tiket Ditutup</p>
            <p class="text-xs mt-1">Pemesanan tiket hanya dibuka pada tanggal 17 – 27 November 2026.</p>
        </div>
    @else
        <form action="{{ route('tiket.store') }}" method="POST" enctype="multipart/form-data" class="text-left space-y-4">
            @csrf

            <div>
                <label for="nama" class="block text-xs font-semibold uppercase tracking-wider text-[#C69968] mb-1">
                    Nama Lengkap
                </label>
                <input 
                    type="text" 
                    id="nama" 
                    name="nama" 
                    value="{{ old('nama') }}"
                    required 
                    placeholder="Masukkan nama lengkap"
                    class="w-full bg-[#2A080C] border border-[#C69968]/50 rounded-lg px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C69968]"
                >
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-[#C69968] mb-1">
                    Email Aktif (Untuk Pengiriman E-Tiket)
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required 
                    placeholder="contoh@gmail.com"
                    class="w-full bg-[#2A080C] border border-[#C69968]/50 rounded-lg px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C69968]"
                >
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="jurusan" class="block text-xs font-semibold uppercase tracking-wider text-[#C69968] mb-1">
                        Jurusan / Prodi
                    </label>
                    <input 
                        type="text" 
                        id="jurusan" 
                        name="jurusan" 
                        value="{{ old('jurusan') }}"
                        required 
                        placeholder="Contoh: D4 SIKC"
                        class="w-full bg-[#2A080C] border border-[#C69968]/50 rounded-lg px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C69968]"
                    >
                </div>

                <div>
                    <label for="asal_fakultas" class="block text-xs font-semibold uppercase tracking-wider text-[#C69968] mb-1">
                        Fakultas / Instansi
                    </label>
                    <input 
                        type="text" 
                        id="asal_fakultas" 
                        name="asal_fakultas" 
                        value="{{ old('asal_fakultas') }}"
                        required 
                        placeholder="Contoh: FIT"
                        class="w-full bg-[#2A080C] border border-[#C69968]/50 rounded-lg px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C69968]"
                    >
                </div>
            </div>

            <div>
                <label for="jumlah_tiket" class="block text-xs font-semibold uppercase tracking-wider text-[#C69968] mb-1">
                    Jumlah Tiket
                </label>
                <input 
                    type="number" 
                    id="jumlah_tiket" 
                    name="jumlah_tiket" 
                    min="1" 
                    value="{{ old('jumlah_tiket', 1) }}" 
                    required 
                    class="w-full bg-[#2A080C] border border-[#C69968]/50 rounded-lg px-4 py-2.5 text-sm text-white focus:outline-none focus:border-[#C69968]"
                >
            </div>

            <div>
                <label for="bukti_pembayaran" class="block text-xs font-semibold uppercase tracking-wider text-[#C69968] mb-1">
                    Upload Bukti Pembayaran (JPG/PNG, Max 2MB)
                </label>
                <input 
                    type="file" 
                    id="bukti_pembayaran" 
                    name="bukti_pembayaran" 
                    accept="image/jpeg,image/png,image/jpg"
                    required 
                    class="w-full bg-[#2A080C] border border-[#C69968]/50 rounded-lg px-3 py-2 text-xs text-gray-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#C69968] file:text-[#1A0305] hover:file:bg-[#b58857]"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-[#C69968] hover:bg-[#b58857] text-[#1A0305] font-bold py-3 rounded-lg shadow-lg transition duration-200 mt-2"
            >
                Pesan Tiket Sekarang
            </button>
        </form>
    @endif
</div>