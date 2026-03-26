<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Legacy model from the previous normalized menu schema.
class MenuItem extends Model
{
    protected $fillable = [
        'menu_section_id',
        'name',
        'description',
        'price',
        'position',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(MenuSection::class, 'menu_section_id');
    }
}
