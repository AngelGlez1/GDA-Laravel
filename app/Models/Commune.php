<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commune extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $primaryKey = 'id_com';
    protected $dates = 'deleted_at';
    protected $fillable = [
        'id_com',
        'id_reg',
        'description',
        'status',
    ];



    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'dni');
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'id_reg', 'id_reg');
    }

}
