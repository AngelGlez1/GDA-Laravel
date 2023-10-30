<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id_reg';
    protected $dates = 'deleted_at';
    protected $fillable = [
        'id_reg',
        'description',
        'status',
    ];


    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'dni');
    }

    public function communes(): HasMany
    {
        return $this->hasMany(Region::class, 'id_com', 'id_com');
    }
}
