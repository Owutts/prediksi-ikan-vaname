<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataset extends Model
{
    use HasFactory;
    protected $table = 'dataset';
    protected $primaryKey = 'ID_DATASET';
    public $timestamps = false;
    protected $fillable = [
        'ID_USER',
        'TAHUN',
        'MUSIM PANEN',
        'LUAS',
        'QTY_TANAM',
        'LAMA',
        'HASIL_PANEN'
    ];
}
