<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eticket extends Model
{
    protected $table = 'eticket';
    protected $fillable = [
        'ticket_no',
        'date',
        'time',
        'id_user',
        'problem',
        'problem_type',
        'solution',
        'rep_part',
        'status',
        'id_kode_fa',
        'id_asset',
        'technician',
        'rep_part'
    ];
}
