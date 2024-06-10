<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait ForeignKey
{
    public function disableForeignKey()
    {
        return DB::statement('set foreign_key_checks=0');
    } 
        public function enableForeignKey()
    {
        return DB::statement('set foreign_key_checks=1');
    } 
}