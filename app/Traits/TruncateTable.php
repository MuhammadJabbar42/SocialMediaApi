<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait TruncateTable
{
    public function truncate($table)
    {
        return DB::table($table)->truncate();
    } 
}