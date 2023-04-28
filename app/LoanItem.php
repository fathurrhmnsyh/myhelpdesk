<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanItem extends Model
{
    protected $table = 'epinjam';
    protected $primaryKey = 'id_epinjam';
    protected $fillable = [
        'name', 
        'section', 
        'contact',
        'item_name', 
        'amount', 
        'purpose', 
        'date', 
        'return_date', 
        'created-at', 
        'updated_at', 
    ];
}
