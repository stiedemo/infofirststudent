<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\UserConfigForm;
use App\UserForm;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        // Create default form
        // $form = new UserForm;
        // $form->user_id = $user->id;
        // $form->name = "Thu thập thông tin học sinh đầu năm học " . (now()->month >= 6 ? now()->year : now()->year - 1 ). " - " . (now()->month >= 6 ? now()->year + 1 : now()->year);
        // $form->public = false;
        // $form->hash_code = Str::random(5);
        // $form->save();
        // // Create default config form
        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Họ và tên học sinh";
        // $formConfig->type = "text";
        // $formConfig->description = "Nhập vào họ và tên của bạn";
        // $formConfig->required = true;
        // $formConfig->order = 1;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Giới tính";
        // $formConfig->type = "radio";
        // $formConfig->required = true;
        // $formConfig->config_content = json_encode(["Nam", "Nữ"]);
        // $formConfig->order = 2;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Lớp";
        // $formConfig->type = "select";
        // $formConfig->required = true;
        // $formConfig->config_content = json_encode(["10C1", "10C2", "10C3", "10C4", "10C5", "10C6", "10C7", "10C8", "10C9", "10C10"]);
        // $formConfig->order = 3;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Ngày, tháng, năm sinh";
        // $formConfig->type = "date";
        // $formConfig->required = true;
        // $formConfig->order = 4;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Dân tộc";
        // $formConfig->type = "text";
        // $formConfig->required = true;
        // $formConfig->order = 5;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Quốc tịch";
        // $formConfig->type = "text";
        // $formConfig->required = true;
        // $formConfig->order = 6;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Nơi sinh";
        // $formConfig->type = "text";
        // $formConfig->required = true;
        // $formConfig->order = 7;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Quê quán";
        // $formConfig->type = "text";
        // $formConfig->required = true;
        // $formConfig->order = 8;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Nơi ở hiện nay";
        // $formConfig->type = "text";
        // $formConfig->required = true;
        // $formConfig->order = 9;
        // $formConfig->save();


        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Họ và tên cha";
        // $formConfig->type = "text";
        // $formConfig->required = true;
        // $formConfig->order = 10;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Điện thoại (cha)";
        // $formConfig->type = "text";
        // $formConfig->required = true;
        // $formConfig->order = 11;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Họ và tên mẹ";
        // $formConfig->type = "text";
        // $formConfig->required = true;
        // $formConfig->order = 12;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Điện thoại (mẹ)";
        // $formConfig->type = "text";
        // $formConfig->required = true;
        // $formConfig->order = 13;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Họ và tên người dám hộ (nếu có)";
        // $formConfig->type = "text";
        // $formConfig->required = false;
        // $formConfig->order = 14;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Điện thoại (người dám hộ (nếu có))";
        // $formConfig->type = "text";
        // $formConfig->required = false;
        // $formConfig->order = 15;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Năng khiếu (nếu có)";
        // $formConfig->type = "text";
        // $formConfig->required = false;
        // $formConfig->order = 16;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Đã từng tham gia thi HSG";
        // $formConfig->config_content = json_encode(["Có", "Không"]);
        // $formConfig->type = "radio";
        // $formConfig->required = true;
        // $formConfig->order = 17;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Tham gia thi HSG huyện môn";
        // $formConfig->type = "text";
        // $formConfig->required = false;
        // $formConfig->order = 18;
        // $formConfig->target = 17;
        // $formConfig->target_value = "Có";
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Kết quả tham gia thi HSG huyện";
        // $formConfig->type = "radio";
        // $formConfig->required = false;
        // $formConfig->config_content = json_encode(["Đậu", "Trượt"]);
        // $formConfig->order = 18;
        // $formConfig->target = 17;
        // $formConfig->target_value = "Có";
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Thuộc đối tượng hs hòa nhập";
        // $formConfig->type = "radio";
        // $formConfig->required = true;
        // $formConfig->config_content = json_encode(["Có", "Không"]);
        // $formConfig->order = 19;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Thuộc đối tượng khuyết tật nặng";
        // $formConfig->type = "radio";
        // $formConfig->required = true;
        // $formConfig->config_content = json_encode(["Có", "Không"]);
        // $formConfig->order = 20;
        // $formConfig->save();

        // $formConfig = new UserConfigForm;
        // $formConfig->user_id = $user->id;
        // $formConfig->user_form_id = $form->id;
        // $formConfig->name = "Đã từng làm cán sự lớp (lớp trưởng/lớp phó)";
        // $formConfig->type = "radio";
        // $formConfig->required = true;
        // $formConfig->config_content = json_encode(["Có", "Không"]);
        // $formConfig->order = 21;
        // $formConfig->save();

        return $user;
    }
}
