<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Legacy model from the previous normalized menu schema.
class MenuSection extends Model
{
    protected $fillable = [
        'lang',
        'page',
        'title',
        'position',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('position');
    }
}
