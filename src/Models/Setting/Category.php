<?php

namespace QuickPanel\Platform\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'icon',
        'image',
        'language',
        'description',
        'sort_order',
    ];
}
