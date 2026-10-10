<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Officer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'officer_name',
        'gender',
        'dob',
        'email',
        'phone',
        'address',
        'hire_date',
        'salary',
        'status',
        'department_id',
        'position_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'hire_date' => 'date',
            'salary' => 'decimal:2',
        ];
    }

    /**
     * Get the department that the officer belongs to.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the position that the officer holds.
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }
}
