<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStudentForm extends Model
{
    public function UserStudentItemForms()
    {
        return $this->hasMany(UserStudentItemForm::class);
    }
}
