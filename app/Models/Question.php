<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id'
    ];

    public static function generateUniqueSlug(string $title): string
    {
        $uglified = Str::slug($title);
        $result = Question::all()->where('slug', '=', $uglified)->first();

        if ($result === null) {
            return $uglified;
        }

        //try to regenerate with name or title, default to the given value
        if (isset($result->title)) {
            $value = $result->title;
        }

        return self::generateUniqueSlug(Str::lower($value . '-' . time()));
    }

    // relation with users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
