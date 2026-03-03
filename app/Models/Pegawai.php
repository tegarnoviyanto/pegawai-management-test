<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pegawai extends Model
{
    protected $fillable = [
        'name',
        'position_id',
        'office_id',
        'tanggal_lahir',
        'cv',
    ];

    protected $appends = ['age'];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
}