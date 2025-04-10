<?php

namespace App\Http\Controllers;

use App\Models\NewLinen;
use Illuminate\Http\Request;

class NewLinenController extends Controller
{

    public function index()
    {
        $newLinens = NewLinen::get();

        return response()->json($newLinens);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'DocNo' => 'required|string|max:255',
            'DocDate' => 'required|date',
            'HptCode' => 'required|string|max:50',
            'IsStatus' => 'required|string|max:50',
            'FacCode' => 'required|string|max:50',
            'SignFac' => 'required|string|max:50',
            'SignNH' => 'required|string|max:50',
            'SignFacTime' => 'required|date_format:Y-m-d H:i:s',
            'SignNHTime' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $linen = NewLinen::create($validated);
        return response()->json([
            'message' => 'Linen created successfully!',
            'data' => $linen
        ], 201);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'DocNo' => 'required|string|max:255',
            'DocDate' => 'required|date',
            'HptCode' => 'required|string|max:50',
            'IsStatus' => 'required|string|max:50',
            'FacCode' => 'required|string|max:50',
            'SignFac' => 'required|string|max:50',
            'SignNH' => 'required|string|max:50',
            'SignFacTime' => 'required|date_format:Y-m-d H:i:s',
            'SignNHTime' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $linen = NewLinen::findOrFail($id);
        $linen->update($validated);

        return response()->json([
            'message' => 'Linen updated successfully!',
            'data' => $linen
        ]);
    }

    public function destroy($id)
    {
        $linen = NewLinen::findOrFail($id);
        $linen->delete();

        return response()->json([
            'message' => 'Linen deleted successfully!'
        ]);
    }
}
