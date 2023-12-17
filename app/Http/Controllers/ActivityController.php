<?php

namespace App\Http\Controllers;

use App\Models\NutritionistActivity;

class ActivityController extends Controller
{
    public function index(){
        $data['activities'] = NutritionistActivity::orderBy('created_at', 'DESC')->get();
        return view('activity.index', $data);
    }

    public function detail($activityId)
    {
        $data['activity'] = NutritionistActivity::find($activityId);
        return view('activity.detail', $data);
    }
}
