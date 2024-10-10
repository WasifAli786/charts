<?php

namespace App\Http\Controllers;

use App\Models\Setups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetupsController extends Controller
{
    public function store(Request $request, $id)
    {
        Setups::create([
            'heading' => $request->heading,
            'content' => $request->content,
            'tradeId' => $id,
        ]);

        return redirect('/trade/' . Auth::id() . '/' . $id);
    }

    public function show(string $setup)
    {
        try {
            $setup = Setups::where('id', $setup)->first();

            if ($setup) {
                return response()->json(['setup' => $setup]);
            } else {
                return response()->json(['error' => 'Description not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request, string $setup)
    {
        Setups::where('id', $setup)->update([
            'heading' => $request->heading,
            'content' => $request->content
        ]);
    }

    public function destroy(string $setup)
    {
        try {
            Setups::destroy($setup);
            return response()->json(['message' => 'Record deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
