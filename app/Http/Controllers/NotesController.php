<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function store(Request $request, $id)
    {
        Notes::create([
            'heading' => $request->heading,
            'content' => $request->content,
            'type' => $request->type,
            'trades_id' => $id,
        ]);

        return redirect('/trade/' . Auth::id() . '/' . $id);
    }

    public function show(string $id)
    {
        try {
            $note = Notes::where('id', $id)->first();

            if ($note) {
                return response()->json($note);
            } else {
                return response()->json(['error' => 'Description not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(Request $request, string $setup)
    {
        Notes::where('id', $setup)->update([
            'heading' => $request->heading,
            'content' => $request->content
        ]);
    }

    public function destroy(string $note)
    {
        try {
            Notes::destroy($note);
            return response()->json(['message' => 'Record deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Record not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
