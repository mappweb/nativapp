<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Patient extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document',
        'first_name',
        'last_name',
        'birthday',
        'email',
        'phone',
        'genre',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthday' => 'date',
    ];

    /**
     * @return BelongsToMany
     */
    public function diagnostics(): BelongsToMany
    {
        return $this->belongsToMany(Diagnostic::class);
    }
}
