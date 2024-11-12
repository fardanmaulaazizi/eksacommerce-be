<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected $hidden = ['created_at', 'updated_at'];
}
