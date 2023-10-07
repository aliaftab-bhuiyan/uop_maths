<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id',
    ];
    public function setSlugAttribute($value): void
    {
        $this->attributes['slug'] = $value;
    }

    public function generateSlug(): void
    {
        $baseSlug = Str::slug($this->title);

        $slug = $baseSlug;
        $counter = 1;

        while (Question::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $this->attributes['slug'] = $slug;
    }

    // relation with users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // relation with keywords
    public function keyword(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class);
    }
    // relation with solutions
    public function solutions(): HasMany
    {
     return $this->hasMany(Solution::class)
         ->whereNull('parent_id')
         ->orderByDesc('updated_at');
    }
}
