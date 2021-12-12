<?php

namespace App\Http\Controllers;

use App\Exports\UserFormExport;
use App\UserConfigForm;
use Illuminate\Http\Request;
use App\UserForm;
use App\UserStudentForm;
use App\UserStudentItemForm;
use Auth;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

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
        $userStudentForm = UserStudentForm::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $text = $section->addText("THU THẬP THÔNG TIN HỌC SINH ĐẦU KHÓA HỌC", array('name'=>'Times New Roman','size' => 12,'bold' => true,  'align' => 'center'), array('align' => 'center'));
        foreach ($userStudentForm->UserStudentItemForms as $userStudentItemForm) {
            $text = $section->addText($userStudentItemForm->UserConfigForm->name . ": " . $userStudentItemForm->value, array('name'=>'Times New Roman','size' => 12));
        }
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $nameFile = "Thông tin nhập số " . $id;
        $objWriter->save($nameFile. '.docx');
        return response()->download(public_path($nameFile. '.docx'));
    }

    public function downloadExcel($id)
    {
        $userForm = UserForm::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        return Excel::download(new UserFormExport($userForm->id), $userForm->name . '.xlsx');
    }

    public function create()
    {
        return view('create');
    }

    public function actionCreate(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $userForm = new UserForm;
        $userForm->name = $request->name;
        $userForm->user_id = Auth::user()->id;
        $userForm->hash_code = Str::random(5);
        $userForm->public = false;
        $userForm->save();
        return redirect()->route('edit', [$userForm->id, $userForm->hash_code])->with('suss', 'Tạo thành công biểu mẫu');
    }

    public function actionEditItem($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required'
        ]);
        $userFormItem = UserConfigForm::findOrFail($id);
        $userFormItem->name = $request->name;
        $userFormItem->type = $request->type;
        $userFormItem->config_content = $request->config_content;
        if($request->required && $request->required == "Có") {
            $userFormItem->required = true;
        } else {
            $userFormItem->required = false;
        }
        $userFormItem->save();
        return redirect()->route('edit', [$userFormItem->UserForm->id, $userFormItem->UserForm->hash_code])->with('suss', 'Chỉnh sửa item thành công');
    }

    public function createEditItem($id)
    {
        $userForm = UserForm::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $userFormItem = new UserConfigForm;
        $userFormItem->name = "Trường dữ liệu";
        $userFormItem->type = "text";
        $userFormItem->user_id = Auth::user()->id;
        $userFormItem->user_form_id = $id;
        $userFormItem->order = 1;
        $userFormItem->required = false;
        $userFormItem->save();
        return redirect()->route('edit', [$userForm->id, $userForm->hash_code])->with('suss', 'Tạo mới item thành công');
    }
}
