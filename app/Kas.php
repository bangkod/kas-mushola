<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'kas';
    protected $fillable = ['kode', 'keterangan', 'tgl', 'jumlah', 'jenis', 'keluar'];
}
