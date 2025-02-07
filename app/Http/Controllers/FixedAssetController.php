<?php

namespace App\Http\Controllers;

use Log;
use App\Models\FixedAsset;
use Illuminate\Http\Request;

class FixedAssetController extends Controller
{
    public function index()
    {
        $fas = FixedAsset::all();
        return view('fam.index', compact('fas'));
    }

    public function testing()
    {
        return view('fam.testing');
    }

    public function getFixedAsset($id)
    {
        // dd($id);
        return response()->json(FixedAsset::find($id));
    }

    public function updateFixedAsset(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required'
            ]);

            $faName = FixedAsset::find($id);
            if($faName)
            {
                $faName->status = $request->status;
                $faName->save();
                return response()->json(['message' => 'Fixed asset status is updated.']);
            }else{
                return response()->json(['message' => 'Asset not found!']);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
