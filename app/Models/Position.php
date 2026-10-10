<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'position_name',
        'description',
    ];

    /**
     * Get the officers that hold this position.
     */
    public function officers(): HasMany
    {
        return $this->hasMany(Officer::class);
    }
}
