<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStudentItemForm extends Model
{
    public function UserConfigForm()
    {
        return $this->belongsTo(UserConfigForm::class);
    }
}
