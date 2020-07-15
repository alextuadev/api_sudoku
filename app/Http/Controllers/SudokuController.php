<?php

namespace App\Http\Controllers;

use App\Sudoku;
use App\SudokuEntry;
use Illuminate\Http\Request;

class SudokuController extends Controller
{


    public function solve(Request $request)
    {
        $data_process = $request->input('data');
        $name = $request->input('name');

        $final_array = [];

        for ($i = 0; $i < 9; $i++) {
            $array_temp = [];
            for ($j = 0; $j < 9; $j++) {
                foreach ($data_process as $values) {
                    if (($values['y'] == $j) && ($values['x'] == $i)) {
                        $array_temp[$i][$j] = $values['value'];
                        // array_push($array_temp, $values['value']);
                    }
                }
            }

            $aux = [];
            for ($k = 0; $k < 9; $k++) {
                if (array_key_exists($k, $array_temp[$i]) ) {
                    $aux[] = $array_temp[$i][$k];
                } else {
                    $aux[] = 0;
                }
            }
            array_push($final_array, $aux);
        }

        $game = new SudokuEntry();
        $game->solve_it($final_array);
        $data = $game->getDataJson();

        Sudoku::create([
            'name' => $name,
            'sudoku'=> json_encode($final_array),
            'response' => json_encode($data)
        ]);

        return response()->json($data);
    }


    public function results(Request $request)
    {
        $response = Sudoku::all();
        return response()->json($response);
    }

    public function single(Request $request, $id)
    {
        $response = Sudoku::find($id);
        return response()->json($response);
    }
}
