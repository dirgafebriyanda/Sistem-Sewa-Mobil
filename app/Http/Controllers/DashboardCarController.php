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
    // Mengambil data Cars dengan pagination
    $cars = Cars::orderBy('id', 'DESC')->paginate(10);

    // Mengambil data Rentals yang terkait dengan Cars
    $rentals = Rentals::all();

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
    public function create()
    {
        return view('car.create',[
            'title' => 'Dashboard | Tambah Mobil'
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

    return redirect()->route('car.index')->with('success','Mobil '. $cars->brand . ' berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}