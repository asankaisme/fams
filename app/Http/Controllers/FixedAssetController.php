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

    public function getFixedAsset(FixedAsset $fa)
    {
        // dd($id);
        return view('fam.fa', compact('fa'));
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
                $faName->remarks = $request->remarks;
                $faName->save();
                // return response()->json(['message' => 'Fixed asset status is updated.']);
                return redirect()->route('faindex')->with('msgSuccess', 'Asset status updated.');
            }else{
                return redirect()->route('faindex')->with('msgError', 'Asset status update failed!.');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
