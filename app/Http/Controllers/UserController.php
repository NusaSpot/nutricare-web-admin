<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::where('is_guest', 0)->get();
        return view('user.index', $data);
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
