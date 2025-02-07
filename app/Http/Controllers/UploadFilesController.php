<?php

namespace App\Http\Controllers;

use App\Imports\ImportExcel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadFilesController extends Controller
{
    //file upload methods here

    public function updloadExcelFile()
    {
        return view('fam.upload');
    }

    public function updloadExcelFilePost(Request $request)
    {
        //dd($request->getAcceptableContentTypes());
        if ($request->file('excelfile')) {
            Excel::import(new ImportExcel, $request->file('excelfile'));
            return redirect()->route('updloadExcelFile')->with('msgSs', 'The file has been uploaded');
        }else{
            return redirect()->route('updloadExcelFile')->with('msgEr', 'No file has been uploaded!');
        }
    }
}
