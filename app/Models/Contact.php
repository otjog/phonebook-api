<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fio', 'phone', 'is_favorite'
    ];

    public function scopeBelongsToUser(Builder $query): void
    {
        $query->where('user_id', '=', auth()->user()->id);
    }

    public function scopeHasId(Builder $query, int $id): void
    {
        $query->where('id', '=', $id);
    }
}
