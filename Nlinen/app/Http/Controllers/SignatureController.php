<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->input('image');

        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageData = base64_decode($image);

        $fileName = 'signatures/' . uniqid() . '.png';

        Storage::disk('public')->put($fileName, $imageData);

        return response()->json([
            'message' => 'บันทึกลายเซ็นสำเร็จ',
            'file' => $fileName
        ]);
    }
}
