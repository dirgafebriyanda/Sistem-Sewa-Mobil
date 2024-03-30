<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Rentals;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $return = Returns::select('returns.*', 'cars.brand', 'cars.license_plate')->join('rentals', 'returns.rental_id', '=', 'rentals.id')->join('cars', 'rentals.car_id', '=', 'cars.id')->orderBy('returns.id', 'desc')->paginate(10);

        return view('return.index', [
            'title' => 'Dashboard | Daftar Mobil Dikembalikan',
            'returns' => $return,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'rental_id' => 'required|numeric',
        'return_date' => 'required|date',
        'rented_days' => 'required|numeric',
        'total_cost' => 'required|numeric',
    ]);

    Returns::create($data);

    return redirect()->route('return.index')->with('success', 'Mobil telah dikembalikan');

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
    
public function check(Request $request)
{
    return view('return.check',[
        'title' => 'Check'
    ]);
}

public function verifikasi(Request $request)
{
   $licensePlate = $request->input('license_plate');
$userId = Auth::id(); // Dapatkan ID pengguna yang sedang masuk

// Cari rental yang terkait dengan mobil berdasarkan license_plate dan ID pengguna yang sedang masuk
$rentals = Rentals::with('car')
    ->whereHas('car', function ($query) use ($licensePlate) {
        $query->where('license_plate', $licensePlate);
    })
    ->where('user_id', $userId)
    ->get();

// Jika ada mobil yang ditemukan, tampilkan data rental dan mobil
if ($rentals->isNotEmpty()) {
    return view('return.verifikasi', [
        'title' => 'Dashboard | Verifikasi',
        'rentals' => $rentals // Kirim data rental dan mobil ke view
    ]);
} else {
    return redirect()->route('return.check')->with('error', 'Mobil dengan plat nomor ' . $licensePlate . ' tidak ditemukan atau Anda tidak memiliki akses untuk mengecek mobil ini.');
}

}

}