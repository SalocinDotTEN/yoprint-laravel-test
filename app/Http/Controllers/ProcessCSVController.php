<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProcessCSVController extends Controller
{
    public function storeCsv(Request $request): RedirectResponse
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');
        $file->storeAs('csv', 'uploaded.csv');

        return redirect()->view('uploader');
    }
}
