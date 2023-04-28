<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok_in extends Model
{
    protected $table = 'stok_in';
    protected $fillable = ['barang_id', 'jumlah', 'no_ppb', 'date', 'name','barang_name', 'input_by'];
    public function barang_stok()
    {
        return $this->belongsTo('App\Barang_stok', 'barang_id', 'id');
    }
}
