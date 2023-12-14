<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class RecipeController extends Controller
{
    public function index()
    {
        $data['recipes'] = Recipe::all();
        return view('recipe.index', $data);
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $resizedImage = Image::make($image);
        $imageString = (string) $resizedImage->encode();

        $imagePath = 'img/recipe/' . time() . "_" .$image->getClientOriginalName();
        Storage::disk('gcs')->put($imagePath, $imageString);

        Recipe::create([
            'image' => $imagePath,
            'title' => $request->title,
            'ingredients' => $request->ingredients,
            'tutorials' => $request->tutorials,
            'category' => $request->category
        ]);

        return redirect()->route('recipe.index')->with('success','Data Berhasil Ditambahkan');
    }

    public function update(Request $request)
    {
        $recipe = Recipe::find($request->id);

        if($request->image){
            $image = $request->file('image');
            $resizedImage = Image::make($image);
            $imageString = (string) $resizedImage->encode();
    
            $imagePath = 'img/recipe/' . time() . "_" .$image->getClientOriginalName();
            Storage::disk('gcs')->put($imagePath, $imageString);

            $recipe->image = $imagePath;
            $recipe->save();
        }

        $recipe->update([
            'title' => $request->title,
            'ingredients' => $request->ingredients,
            'tutorials' => $request->tutorials,
            'category' => $request->category
        ]);

        return redirect()->back()->with('success','Data Berhasil Dirubah');
    }

    public function delete($id)
    {
        Recipe::find($id)->delete();

        return redirect()->back()->with('success','Data Berhasil Dihapus');
    }
}
