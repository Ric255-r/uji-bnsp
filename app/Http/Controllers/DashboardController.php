<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // query count groupby berdasarkan bulan tanggal penjualan (bulan)
        $forCount = Penjualan::selectRaw('DATE_FORMAT(tgl_jual, "%Y-%m") AS bulan')
            ->selectRaw('COUNT(*) AS jlh_jual')
            ->groupByRaw('DATE_FORMAT(tgl_jual, "%Y-%m")')
            ->get();

        // ini pake array karena menyesuaikan apexchart
        $isiJlhJual = array();
        $isiBln = array();
        foreach ($forCount as $row) {
            array_push($isiJlhJual, $row['jlh_jual']);
            array_push($isiBln, $row['bulan']);
        }

        // query sum groupby berdasarkan tanggal penjualan (bulan) 
        $omset = Penjualan::join('produk', 'penjualan.id_produk', '=', 'produk.id')
            ->selectRaw('DATE_FORMAT(penjualan.tgl_jual, "%Y-%m") AS bulan')
            ->selectRaw('SUM(produk.harga) AS total_jual')
            ->groupByRaw('DATE_FORMAT(penjualan.tgl_jual, "%Y-%m")')
            ->get();

        // tampung seluruh omset dari query diatas
        $totalOmset = 0;

        // ini untuk cek omset bulan ini
        $tgl = date("Y-m");
        $splitNowMonth = explode("-", $tgl);
        $nowOmset = 0;

        foreach ($omset as $row) {
            $rowTotalJual = $row['total_jual'];
            $totalOmset += $rowTotalJual;

            // split bulan
            $rowBulan = $row['bulan'];
            $splitRowBulan = explode("-", $rowBulan);

            // kondisi kalau bulan sekarang sama dengan di database.
            if($splitNowMonth[1] == $splitRowBulan[1]){
                $nowOmset += $rowTotalJual;
            }
        }

        // kategori
        $groupKategori = Penjualan::join("produk", 'penjualan.id_produk', '=', 'produk.id')
                            ->selectRaw("COUNT(penjualan.id_produk) AS jlh_user")
                            ->selectRaw("produk.kategori")
                            ->groupBy("produk.kategori")
                            ->get();

        $arrKategori = array();
        $arrJlhUser = array();
        foreach ($groupKategori as $row) {
            array_push($arrKategori, $row['kategori']);
            array_push($arrJlhUser, $row['jlh_user']);
        }

        return view('dashboard', [
            'data_jual' => $forCount,
            'jlh_jual'=>$isiJlhJual,
            'isi_bulan'=>$isiBln,
            'total_omset' => $totalOmset,
            'now_omset' => $nowOmset,
            'arr_kategori' => $arrKategori,
            'arr_jlh_user' => $arrJlhUser
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
