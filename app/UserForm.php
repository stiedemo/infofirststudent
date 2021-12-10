<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserForm extends Model
{
    public function UserStudentForms()
    {
        return $this->hasMany(UserStudentForm::class);
    }

    public function UserConfigForms()
    {
        return $this->hasMany(UserConfigForm::class);
    }
}
