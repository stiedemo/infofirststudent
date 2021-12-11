<?php

namespace App\Exports;

use App\UserForm;
use App\UserStudentForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserFormExport implements FromCollection,WithHeadings,WithMapping
{
    public $idItem = 0;
    public function __construct($id)
    {
        $this->idItem = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserStudentForm::where('user_form_id', $this->idItem)->get();
    }

    public function headings(): array {
        $userForm = UserForm::find($this->idItem);
        $userFormHeaders = ["ID"];
        foreach ($userForm->UserConfigForms as $userConfigForm) {
            $userFormHeaders[] = $userConfigForm->name;
        }
        return $userFormHeaders;
    }

    public function map($data): array {
        $dataResult = [$data->id];
        foreach ($data->UserStudentItemForms as $userStudentItemForm) {
            $dataResult[] = $userStudentItemForm->value;
        }
        return $dataResult;
    }
}
