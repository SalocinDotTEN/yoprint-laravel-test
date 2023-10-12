<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CsvToDbController extends Controller
{
    public function updatedb(Request $request)
    {
        //die(var_dump($request->all()));
        $csv = array_map('str_getcsv', file($request->input('filepath')));
        array_walk($csv, function (&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv);
        // var_dump($csv);
        foreach ($csv as $rowNo => $datas) {
            DB::table('parsed_csv')->upsert(
                [
                    [
                        'UNIQUE_KEY' => isset($datas['UNIQUE_KEY']) ? $datas['UNIQUE_KEY'] : $datas['﻿UNIQUE_KEY'],
                        'PRODUCT_TITLE' => $datas['PRODUCT_TITLE'],
                        'PRODUCT_DESCRIPTION' => $datas['PRODUCT_DESCRIPTION'],
                        'STYLE#' => $datas['STYLE#'],
                        'SANMAR_MAINFRAME_COLOR' => $datas['SANMAR_MAINFRAME_COLOR'],
                        'SIZE' => $datas['SIZE'],
                        'COLOR_NAME' => $datas['COLOR_NAME'],
                        'PIECE_PRICE' => $datas['PIECE_PRICE']
                    ]
                ],
                [
                    'UNIQUE_KEY'
                ]
            );
        }
        return true;
        // return redirect()->back();
    }
}
