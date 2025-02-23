<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::all();
        return view('admin', ['data'=>$data] );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'thumbnail'=>'required|mimes:jpg,jpeg,bmp,png',
            'produk'=>'required',
            'kategori'=>'required',
            'harga'=>'required'
        ], [
            'thumbnail.mimes' => ' thumbnail hrs bertipe jpg,jpeg,bmp,png',
        ]);

        $data['thumbnail'] = $request->file('thumbnail')->store(
            'assets/thumbnail', 'public'
        );

        $query = Produk::create($data);

        if($query){
            return response()->json($data, 200);
        }else{
            return response()->json([
                "fail"=>$data
            ], 400);
        }
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
        $data = Produk::findOrFail($id);
        return view('edit', ['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $query = Produk::find($id);

        if($request->thumbnail != null){
            $filePath = $query->thumbnail;
    
            // delete file dari storage
            if($filePath && Storage::disk('public')->exists($filePath)){
                Storage::disk('public')->delete($filePath);
            }

            // Bagian Store Data Terbaru
            $data = $this->validate($request, [
                'thumbnail'=>'required|mimes:jpg,jpeg,bmp,png',
                'produk'=>'required',
                'kategori'=>'required',
                'harga'=>'required'
            ], [
                'thumbnail.mimes' => ' thumbnail hrs bertipe jpg,jpeg,bmp,png',
            ]);
    
            $data['thumbnail'] = $request->file('thumbnail')->store(
                'assets/thumbnail', 'public'
            );
        }else {
            $data = $this->validate($request, [
                'produk'=>'required',
                'kategori'=>'required',
                'harga'=>'required'
            ]);
        }

        if($query->update($data)){
            session()->flash('success', 'Product Selesai di Update');
    
        }else{
            session()->flash('error', $query);
        }


        $allData = Produk::all();
        return redirect()->route('home', ['data'=>$allData]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Produk::find($id);

        $filePath = $product->thumbnail;

        // delete file dari storage
        if($filePath && Storage::disk('public')->exists($filePath)){
            Storage::disk('public')->delete($filePath);
        }

        // query delete, lgsg ambil dr variabel
        if($product->delete()){
            return response()->json([
                "success"=>"hapus data done"
            ],  200);
        }else{
            return response()->json([
                "message"=>"gagal hapus data"
            ], 400);
        }
    }
}
