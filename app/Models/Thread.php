<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    protected $fillable = ['category_id', 'user_id', 'title', 'slug', 'body_markdown', 'body_html', 'ai_tags', 'is_locked', 'is_pinned'];

    protected function casts(): array
    {
        return ['ai_tags' => 'array', 'is_locked' => 'boolean', 'is_pinned' => 'boolean'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
