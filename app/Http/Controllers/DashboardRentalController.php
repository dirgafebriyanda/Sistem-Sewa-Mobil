<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Rentals;
use Illuminate\Http\Request;

class DashboardRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $rentals = Rentals::with('user', 'car')->orderBy('id', 'desc')->paginate(10);

    return view('rental.index', [
        'title' => 'Dashboard | Daftar Sewa',
        'rentals' => $rentals,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create($id)
{
    $car = Cars::find($id);
    return view('rental.create', [
        'title' => 'Dashboard | Sewa',
        'cars' => $car, // Kirim data mobil ke view
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
        'user_id' => 'required|max:255',
        'car_id' => 'required|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    $rental = Rentals::create($data);

    return redirect()->route('rental.index')->with('success','Mobil '. $rental->brand . ' berhasil disewa.');

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
