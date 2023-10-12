<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowDatabaseController extends Controller
{
    public function index()
    {
        $data = DB::table('parsed_csv')->paginate(10);
        return view('dbviewer', ['data' => $data]);
    }
}
