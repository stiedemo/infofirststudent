<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserForm;
use App\UserStudentForm;
use App\UserStudentItemForm;
use Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $headsUserForms = ["STT", "Tên mẫu thu thập", "Trạng thái", "Số lượng tham gia", "Ngày tạo", "Hành động"];
        $userForms = [];
        foreach (Auth::user()->UserForms as $index => $userForm) {
            $btnEdit = '<a href="'. route('edit', [$userForm->id, $userForm->hash_code]) .'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>';
            // $btnDelete = '<a href="/" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
            //                 <i class="fa fa-lg fa-fw fa-trash"></i>
            //             </a>';
            $btnDetails = '<a href="'. route('detail', [$userForm->id, $userForm->hash_code]) .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </a>';
            $userForms[] = [
                $index + 1,
                $userForm->name,
                $userForm->public ? "Mở" : "Đóng",
                $userForm->UserStudentForms->count(),
                $userForm->created_at->format('d/m/Y'),
                '<nobr>'.$btnEdit.$btnDetails.'</nobr>'
            ];
        }
        return view('home', compact('headsUserForms', 'userForms'));
    }

    public function redirectHome()
    {
        return redirect()->route('home');
    }

    public function detail($id, $hash_code)
    {
        $userForm = UserForm::where('id', $id)->where('hash_code', $hash_code)->where('user_id', Auth::user()->id)->firstOrFail();
        $tableUserStudentHeader = ["STT"];
        $tableUserStudentHeaderId = [];
        foreach ($userForm->UserConfigForms as $index => $value) {
            if($index <= 3) {
                $tableUserStudentHeader[] = $value->name;
                $tableUserStudentHeaderId[] = $value->id;
            }
        }
        $tableUserStudentHeader[] = "Hành động";
        $tableUserStudentData = [];
        foreach ($userForm->UserStudentForms as $index => $value) {
            $tableUserStudentData[$index] = [$index + 1];
            foreach ($tableUserStudentHeaderId as $idValue) {
                $valueStudent = UserStudentItemForm::where('user_student_form_id', $value->id)->where('user_config_form_id', $idValue)->first();
                if($valueStudent) {
                    $tableUserStudentData[$index][] = $valueStudent->value;
                } else {
                    $tableUserStudentData[$index][] = "";
                }
            }
            $btnDetails = '<button data-toggle="modal" data-target="#modalCustomFormStudent'. $value->id .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                        </button>';
            $tableUserStudentData[$index][] = $btnDetails;
        }
        return view('detail', compact('userForm', 'tableUserStudentHeader', 'tableUserStudentData'));
    }

    public function switchStatus($id, $hash_code)
    {
        $userForm = UserForm::where('id', $id)->where('hash_code', $hash_code)->where('user_id', Auth::user()->id)->firstOrFail();
        $userForm->public = !$userForm->public;
        $userForm->save();
        return redirect()->route('detail', [$userForm->id, $userForm->hash_code])->with('suss', 'Chuyển đổi trạng thái thành công');
    }

    public function edit($id, $hash_code)
    {
        $userForm = UserForm::where('id', $id)->where('hash_code', $hash_code)->where('user_id', Auth::user()->id)->firstOrFail();
        return view('editUserForm', compact('userForm'));
    }

    public function actionEdit($id, $hash_code, Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $userForm = UserForm::where('id', $id)->where('hash_code', $hash_code)->where('user_id', Auth::user()->id)->firstOrFail();
        $userForm->name = $request->name;
        $userForm->save();
        return redirect()->back()->with('suss', 'Sửa biểu mẫu thành công');
    }

    public function downloadWordItem($id)
    {
        $userStudentForm = UserStudentForm::findOrFail($id);
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $text = $section->addText("THU THẬP THÔNG TIN HỌC SINH ĐẦU KHÓA HỌC", array('name'=>'Times New Roman','size' => 12,'bold' => true,  'align' => 'center'), array('align' => 'center'));
        foreach ($userStudentForm->UserStudentItemForms as $userStudentItemForm) {
            $text = $section->addText($userStudentItemForm->UserConfigForm->name . ": " . $userStudentItemForm->value, array('name'=>'Times New Roman','size' => 12));
        }
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Appdividend.docx');
        return response()->download(public_path('Appdividend.docx'));
    }
}
