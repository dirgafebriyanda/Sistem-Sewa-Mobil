<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use App\Models\Rentals;
use App\Models\Returns;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Cars::orderBy('brand', 'asc')
            ->filter(['search' => request('search')])
            ->paginate(9);
        $rentals = Rentals::all();
        $returns = Returns::all();
        $countCars = Cars::all()->count();
        $countRentals = Rentals::all()->count();
        $countReturns = Returns::all()->count();

        $totalMonthlyEarnings = $returns->sum('total_cost');
        $averageEarnings = $returns->avg('total_cost');


        return view('index', [
            'title' => 'Dashboard',
            'cars' => $cars,
            'totalMonthlyEarnings' => $totalMonthlyEarnings,
            'averageEarnings' => $averageEarnings,
            'rentals' => $rentals,
            'countCars' => $countCars,
            'countRentals' => $countRentals,
            'countReturns' => $countReturns,
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
        //
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
