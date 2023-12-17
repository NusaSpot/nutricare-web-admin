<?php

namespace App\Http\Controllers;

use App\Mail\ApprovedNutritionist;
use App\Mail\RejectedNutritionist;
use App\Models\Nutritionist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NutritionistController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;
        $data['nutritionists'] = Nutritionist::when($filter == 'pending', function ($query) {
            return $query->where('is_eligible', 'pending');
        })->when($filter == 'rejected', function ($query) {
            return $query->where('is_eligible', 'rejected');
        })->when($filter == 'approved', function ($query) {
            return $query->where('is_eligible', 'approved');
        })->when($filter == 'not_completed', function ($query) {
            return $query->where('is_eligible', 'not_completed');
        })->get();

        return view('nutritionist.index', $data);
    }

    public function detail($id)
    {
        $data['nutritionist'] = Nutritionist::withTrashed()->find($id);
        return view('nutritionist.detail', $data);
    }

    public function update(Request $request)
    {
        $nutritionist =  Nutritionist::find($request->id);
        $nutritionist->is_eligible = $request->is_eligible;
        $nutritionist->remark = $request->remark;
        $nutritionist->save();

        if($nutritionist->is_eligible == 'approved'){
            Mail::mailer('smtp')->to($nutritionist)->send(new ApprovedNutritionist($nutritionist));
        }else{
            Mail::mailer('smtp')->to($nutritionist)->send(new RejectedNutritionist($nutritionist));
        }
        
        return redirect()->back()->with('success', 'Data berhasil di ubah !');
    }

    public function delete($id)
    {
        Nutritionist::find($id)->delete();
        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
