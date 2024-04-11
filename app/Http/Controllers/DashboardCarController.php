<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Rentals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mendapatkan data mobil dengan filter dan pagination
        $cars = Cars::orderBy('id', 'DESC')
            ->filter(['search' => request('search')])
            ->paginate(10);

        // Mendapatkan semua data penyewaan
        $rentals = Rentals::all();

        // Mengembalikan tampilan dengan data yang diperlukan
        return view('car.index', [
            'title' => 'Dashboard | Daftar Mobil',
            'cars' => $cars,
            'rentals' => $rentals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Dapatkan nilai pencarian dari input form
        $search = $request->input('search');

        // Lakukan query pencarian berdasarkan merek atau model
        $cars = Cars::query()
            ->where('brand', 'like', "%$search%")
            ->orWhere('model', 'like', "%$search%")
            ->where('status', 0) // Assuming 0 means available
            ->get();

        // Tampilkan hasil pencarian ke dalam view atau lakukan operasi lainnya
        return view('car.create', [
            'title' => 'Dashboard | Tambah Mobil',
            'cars' => $cars,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{
    $data = $request->validate([
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'brand' => 'required|max:255',
        'model' => 'required|max:255',
        'license_plate' => 'required|max:255|unique:cars',
        'rental_rate' => 'required|numeric',
        'specification' => 'string',
    ]);

    $files = [];
    if ($request->hasfile('images')) {
        foreach ($request->file('images') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('car', $name); // Menyimpan file ke storage dengan nama unik
            $files[] = ($name);
        }
    }

    $data['image'] = implode(',',$files);

    $car = Cars::create($data);

    return redirect()
        ->route('car.index')
        ->with('success', 'Mobil ' . $car->brand . ' berhasil ditambahkan.');
}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Cars::find($id);
        return view ('car.show',[
            'title' => 'Dashboard | Detail Mobil',
            'cars' => $car
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function destroy($id)
{
    $car = Cars::find($id);

    if ($car) {
        // Hapus gambar mobil dari storage
        $images = explode(',', $car->image);
        foreach ($images as $image) {
            $path = 'storage/car/' . $image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        // Hapus entri mobil dari database
        $car->delete();
        
        return redirect()->route('car.index')->with('success', 'Mobil ' . $car->brand . ' berhasil dihapus');
    } else {
        return redirect()->back()->with('error', 'Mobil tidak ditemukan');
    }

}}