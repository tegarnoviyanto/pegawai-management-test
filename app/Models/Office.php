<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = ['name'];

    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}