<?php

namespace App\Modules\Link;

use Illuminate\Database\Eloquent\Model;

class LinkModel extends Model
{
    protected $table = "link";
    protected $fillable = [
        'url_original',
        'alias',
        'data_expira',
        'user_id',
    ];
}
