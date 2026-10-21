<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ONNOSU 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#2A080C] text-white p-6 min-h-screen">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6 border-b border-[#E5C158]/30 pb-4">
            <div>
                <h1 class="text-2xl font-bold text-[#E5C158]">Dashboard Admin ONNOSU 2026</h1>
                <p class="text-xs text-gray-300">Kelola & Verifikasi Pemesanan Tiket</p>
            </div>

            <!-- TOMBOL DOWNLOAD REKAP EXCEL/CSV -->
            <a href="{{ route('admin.export') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-4 py-2 rounded-lg flex items-center gap-2 transition shadow-lg">
                📊 Download Rekap (Excel/CSV)
            </a>
        </div>

        @if(session('sukses'))
            <div class="bg-emerald-800 text-emerald-100 p-3 rounded-lg mb-4 text-xs font-semibold shadow-lg">
                {{ session('sukses') }}
            </div>
        @endif

        <div class="bg-[#3B0A11] border border-[#E5C158]/40 rounded-xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#2A080C] text-[#E5C158] uppercase font-semibold">
                        <tr>
                            <th class="p-3">#</th>
                            <th class="p-3">Nama & Email</th>
                            <th class="p-3">Jurusan / Fakultas</th>
                            <th class="p-3">Jumlah & Batch</th>
                            <th class="p-3">Total Bayar</th>
                            <th class="p-3">Bukti Bayar</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Aksi / Kirim Email</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E5C158]/10 text-gray-200">
                        @foreach($orders as $key => $row)
                        <tr class="hover:bg-[#2A080C]/50 transition duration-150">
                            <td class="p-3">{{ $key + 1 }}</td>
                            
                            <!-- KOLOM NAMA & EMAIL -->
                            <td class="p-3 font-bold text-white">
                                {{ $row->nama }} <br>
                                @if(!empty($row->email))
                                    <a href="mailto:{{ $row->email }}" class="text-[#E5C158] hover:underline font-normal text-[11px] flex items-center gap-1 mt-0.5">
                                        ✉️ {{ $row->email }}
                                    </a>
                                @else
                                    <span class="text-rose-400 font-normal italic text-[10px]">(Email belum diisi)</span>
                                @endif
                            </td>

                            <!-- KOLOM JURUSAN & ASAL FAKULTAS -->
                            <td class="p-3">{{ $row->jurusan }} / <br><span class="text-gray-400">{{ $row->asal_fakultas }}</span></td>
                            <td class="p-3">{{ $row->jumlah_tiket }} Tiket <br><span class="text-[#E5C158] font-semibold">{{ $row->batch_pembelian }}</span></td>
                            <td class="p-3 font-semibold text-emerald-400">
                                Rp {{ number_format($row->total_bayar, 0, ',', '.') }}
                                @if($row->diskon > 0)
                                    <span class="text-[10px] text-amber-400 block">(Diskon 5k)</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <a href="{{ asset('uploads/'.$row->bukti_pembayaran) }}" target="_blank" class="text-xs text-[#E5C158] underline hover:text-white">Lihat Bukti</a>
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded text-[10px] font-bold {{ $row->status_pembayaran == 'Verified' ? 'bg-emerald-900 text-emerald-300' : ($row->status_pembayaran == 'Rejected' ? 'bg-rose-900 text-rose-300' : 'bg-amber-900 text-amber-300') }}">
                                    {{ $row->status_pembayaran }}
                                </span>
                            </td>

                            <!-- TOMBOL AKSI & KIRIM TIKET (DIUBAH DARI <a> JADI <form>) -->
                            <td class="p-3 space-y-1">
                                <div class="flex gap-1">
                                    <!-- FORM APPROVE -->
                                    <form action="{{ route('admin.update', [$row->id, 'Verified']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white px-2 py-1 rounded text-[10px] font-bold transition">
                                            Approve & Kirim Tiket
                                        </button>
                                    </form>

                                    <!-- FORM REJECT -->
                                    <form action="{{ route('admin.update', [$row->id, 'Rejected']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-rose-600 hover:bg-rose-500 text-white px-2 py-1 rounded text-[10px] font-bold transition">
                                            Reject
                                        </button>
                                    </form>
                                </div>

                                @if(!empty($row->email))
                                    <a href="mailto:{{ $row->email }}?subject=[ONNOSU%202026]%20E-Tiket%20Resmi&body=Halo%20{{ urlencode($row->nama) }},%20pembayaran%20tiket%20ONNOSU%202026%20kamu%20telah%20VERIFIED!" target="_blank" class="inline-block bg-amber-600 hover:bg-amber-500 text-white px-2 py-0.5 rounded text-[9px] font-semibold mt-1">
                                        📬 Kirim Email Manual
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>