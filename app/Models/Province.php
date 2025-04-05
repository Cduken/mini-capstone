<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'region_code',
        'name'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_code', 'code');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'province_code', 'code');
    }
}
