<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sudoku extends Model
{
    protected $fillable = [
        'sudoku', 'response', 'name'
    ];

}
