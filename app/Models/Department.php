<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'department_name',
        'description',
    ];

    /**
     * Get the officers that belong to the department.
     */
    public function officers(): HasMany
    {
        return $this->hasMany(Officer::class);
    }
}
