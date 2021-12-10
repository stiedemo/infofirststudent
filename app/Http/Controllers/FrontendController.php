<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserForm;
use App\UserStudentForm;
use App\UserStudentItemForm;

class FrontendController extends Controller
{
    public function writeStudent($hash_code)
    {
        $userForm = UserForm::where('hash_code', $hash_code)->firstOrFail();
        return view('writeStudent', compact('userForm'));
    }

    public function saveWriteStudent($hash_code, Request $request)
    {
        $userForm = UserForm::where('hash_code', $hash_code)->where('public', true)->firstOrFail();
        // Make validation
        $validations = [];
        foreach ($userForm->UserConfigForms as $userConfigForm) {
            if($userConfigForm->required) {
                $validations['studentinput__' . $userConfigForm->id] = 'required';
            }
        }
        $request->validate($validations);
        $userStudentForm = new UserStudentForm;
        $userStudentForm->user_form_id = $userForm->id;
        $userStudentForm->save();
        foreach ($request->all() as $index => $value) {
            if(count(explode('__', $index)) > 1) {
                $id = explode('__', $index)[1];
                $userStudentItemForm = new UserStudentItemForm;
                $userStudentItemForm->user_student_form_id = $userStudentForm->id;
                $userStudentItemForm->user_config_form_id = $id;
                $userStudentItemForm->value = $value;
                $userStudentItemForm->save();
            }
        }
        return redirect()->back();
    }
}
