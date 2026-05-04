<?php

namespace App\Http\Controllers;

use App\Jobs\exportCSV;
use App\Jobs\generateBulk;
use Illuminate\Http\Request;

class ExportProductData extends Controller
{
    public function index()
    {
        return view('import_data');
    }

    public function import(Request $request)
    {
        $validated = $request->validate([
            'input_num' => 'min:1|required|max:1000',
            'type' => 'required',
        ]);

        generateBulk::dispatch($validated['input_num'], $validated['type']);

        return response()->json(['message' => 'Bulk generation inprogress'], 202);
    }

    public function exportCsv()
    {
        return view('export_csv');
    }

    public function exportToCsv(Request $request)
    {
        exportCSV::dispatch($request->type);
    }
}
