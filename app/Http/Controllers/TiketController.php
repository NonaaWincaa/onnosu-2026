<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TiketOrder;
use Illuminate\Support\Facades\Mail;
use App\Mail\ETicketMail;

class TiketController extends Controller
{
    public function index()
    {
        $tgl_sekarang = date('Y-m-d');

        if ($tgl_sekarang <= '2026-10-31') {
            $batch_nama = "Presale 1";
            $harga_tiket = 20000;
        } else { 
            $batch_nama = "Presale 2";
            $harga_tiket = 25000;
        }

        return view('tiket.index', compact('batch_nama', 'harga_tiket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'jurusan' => 'required|string|max:100',
            'asal_fakultas' => 'required|string|max:100',
            'jumlah_tiket' => 'required|integer|min:1',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $tgl_sekarang = date('Y-m-d');

        if ($tgl_sekarang <= '2026-10-31') {
            $batch_nama = "Presale 1";
            $harga_tiket = 20000;
        } else { 
            $batch_nama = "Presale 2";
            $harga_tiket = 25000;
        }

        $jumlah_tiket = $request->jumlah_tiket;
        $diskon = ($jumlah_tiket >= 4) ? 5000 : 0;
        $total_bayar = ($jumlah_tiket * $harga_tiket) - $diskon;

        $file = $request->file('bukti_pembayaran');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);

        TiketOrder::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
            'asal_fakultas' => $request->asal_fakultas,
            'jumlah_tiket' => $jumlah_tiket,
            'batch_pembelian' => $batch_nama,
            'harga_per_tiket' => $harga_tiket,
            'diskon' => $diskon,
            'total_bayar' => $total_bayar,
            'bukti_pembayaran' => $filename,
        ]);

        return redirect()->back()->with('sukses', 'Pemesanan tiket berhasil dikirim!');
    }

    public function admin()
    {
        $orders = TiketOrder::latest()->get();
        // Sesuaikan dengan letak admin.blade.php
        return view('admin', compact('orders'));
    }

    public function updateStatus($id, $status)
    {
        $order = TiketOrder::findOrFail($id);
        $order->update(['status_pembayaran' => $status]);

        if ($status === 'Verified' && !empty($order->email)) {
            Mail::to($order->email)->send(new ETicketMail($order));
        }

        return redirect()->back()->with('sukses', 'Status pembayaran berhasil diperbarui dan E-Tiket telah dikirim ke email pemesan.');
    }

    public function exportCsv()
    {
        $fileName = 'Rekap_Tiket_ONNOSU_2026_' . date('Y-m-d_H-i') . '.csv';
        $orders = TiketOrder::latest()->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Nama', 'Email', 'Jurusan', 'Asal Univ', 'Jumlah Tiket', 'Batch', 'Harga/Tiket', 'Diskon', 'Total Bayar', 'Status Pembayaran'];

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->nama,
                    $order->email ?? '-',
                    $order->jurusan,
                    $order->asal_fakultas,
                    $order->jumlah_tiket,
                    $order->batch_pembelian,
                    $order->harga_per_tiket,
                    $order->diskon,
                    $order->total_bayar,
                    $order->status_pembayaran
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}