<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Rentals;
use Illuminate\Http\Request;

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
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'license_plate' => 'required|max:255|unique:cars',
            'rental_rate' => 'required|numeric',
        ]);

        $cars = Cars::create($data);

        return redirect()
            ->route('car.index')
            ->with('success', 'Mobil ' . $cars->brand . ' berhasil ditambahkan.');
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
        $car->delete();
        return redirect()->route('car.index')->with('success', 'Mobil ' .$car->brand. ' berhasil dihapus');
    } else {
        return redirect()->back()->with('error', 'Akun anda gagal dihapus');
    }
    }
}
