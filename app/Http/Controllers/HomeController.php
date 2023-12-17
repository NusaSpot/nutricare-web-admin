<?php

namespace App\Http\Controllers;

use App\Models\Nutritionist;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['total_guest'] = User::where('is_guest', 1)->count();
        $data['total_user'] = User::where('is_guest', 0)->count();
        $data['total_recipe'] = Recipe::count();
        $data['total_nutritionist'] = Nutritionist::where('is_eligible', 'approved')->count();

        return view('dashboard', $data);
    }

    public function getPieChart()
    {
        $guest = User::where('is_guest', 1)->count();
        $user = User::count();
        $active = $user - $guest;
        
        $arr_series = [
            [ 'name' => 'Pengguna', 'value' => $active ],
            [ 'name' => 'Tamu', 'value' => $guest, 'selected' => 'true' ]
        ];
      
        $data['json_data'] = json_encode($arr_series);
        return response()->json($data);
    }
}
