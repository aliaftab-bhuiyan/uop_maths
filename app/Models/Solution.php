<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
    ];

    // relation with question
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function question(): belongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Solution::class, 'parent_id');
    }
}
