<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConfigForm extends Model
{
    public function UserForm()
    {
        return $this->belongsTo(UserForm::class);
    }
}
