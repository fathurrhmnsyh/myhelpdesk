<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    protected $table = "printer";
    protected $fillable = [
        'purc_date',
        'purc_ppb',
        'printer_name',
        'kode_fa',
        'type',
        'code',
        'status',
        'info',

    ];
}
