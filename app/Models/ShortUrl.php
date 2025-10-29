<?php

namespace App\Models;

use App\Policies\ShortUrlPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#UsePolicy[ShortUrlPolicy::class]
class ShortUrl extends Model
{

    protected $fillable = [
        'shortcode',
        'url',
        'hits',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
