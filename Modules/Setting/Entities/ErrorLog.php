<?php

namespace Modules\Setting\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'name' => ''
        ]);

    }
}
