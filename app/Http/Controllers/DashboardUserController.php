<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Mendapatkan data mobil dengan filter dan pagination
        $user = User::orderBy('id', 'DESC')
            ->filter(['search' => request('search')])
            ->paginate(10);
        return view('user.index',[
            'title' => 'Dashboard | User',
            'users' => $user,
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
        $user = User::find($id);
        return view('user.show',[
            'title' => 'Dashboard | Profile',
            'users' => $user
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
    $validatedData = $request->validate([
        'name' => 'required|max:50',
        'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'gender' => 'required|max:9',
        'driver_license_number' => 'required|numeric',
        'phone_number' => 'required|numeric',
        'address' => 'required|max:255',
        'email' => 'required|email',
    ]);

    $user = User::find($id);
    
    if ($request->file('image')) {
        if ($request->oldImage) {
            Storage::delete($request->oldImage);
        }
        $validatedData['image'] = $request->file('image')->store('user');
    }
    $user->update($validatedData);
    
    if (!$user) {
        return redirect()->back()->with('error', 'Profile anda gagal diperbarui');
    }

    return redirect()->back()->with('success', 'Profile anda berhasil diperbarui');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
{
    $user = User::find($id);
    if ($user->image) {
            Storage::delete($user->image);
        }
        $user->delete();
    if ($user) {
        return redirect()->route('user.index')->with('success', 'Akun ' .$user->name. ' berhasil dihapus');
    } else {
        return redirect()->back()->with('error', 'Akun '.$user->name.' gagal dihapus');
    }
}
public function ubahPassword(Request $request, $id)
{
    $validatedData = $request->validate([
        'password' => 'required|min:5|max:255|confirmed'
    ]);

    $user = User::find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'User tidak ditemukan');
    }
    $validatedData['password'] = Hash::make($validatedData['password']);
    $user->update($validatedData);
    if ($user) {
        return redirect()->back()->with('success', 'Password berhasil diubah');
    }
    return redirect()->back()->with('error', 'Password gagal diubah');
}


}
