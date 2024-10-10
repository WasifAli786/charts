<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Trades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('trade_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
        $trade = Trades::findOrFail($request->tradeId);
        $trade->images()->create(['image_path' => $imageName]);

        return redirect('/trade/' . Auth::id() . '/' . $request->input('tradeId'));
    }

    public function destroy(string $image)
    {
        $image = Image::find($image);
        $filePath = public_path('uploads/' . $image->image_path);
        File::delete(($filePath));
        $image::destroy($image->id);
    }
}
