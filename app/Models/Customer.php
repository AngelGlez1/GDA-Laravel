<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'dni';
    protected $keyType = 'string';
    protected $dates = 'deleted_at';
    protected $fillable = [
        'dni',
        'id_reg',
        'id_com',
        'name',
        'last_name',
        'email',
        'address',
    ];
    protected $casts = [
        'date_reg' => 'datetime',
        //'status' => 'A',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'id_reg', 'id_reg');
    }
    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class, 'id_com', 'id_com');
    }
}
