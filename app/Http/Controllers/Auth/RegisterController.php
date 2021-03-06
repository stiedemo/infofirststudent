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
        if($user->id == 1) {
            $form = new UserForm;
            $form->user_id = $user->id;
            $form->name = "Thu th???p th??ng tin h???c sinh ?????u n??m h???c " . (now()->month >= 6 ? now()->year : now()->year - 1 ). " - " . (now()->month >= 6 ? now()->year + 1 : now()->year);
            $form->public = false;
            $form->hash_code = Str::random(5);
            $form->save();
            // Create default config form
            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "H??? v?? t??n h???c sinh";
            $formConfig->type = "text";
            $formConfig->description = "Nh???p v??o h??? v?? t??n c???a b???n";
            $formConfig->required = true;
            $formConfig->order = 1;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "Gi???i t??nh";
            $formConfig->type = "radio";
            $formConfig->required = true;
            $formConfig->config_content = json_encode(["Nam", "N???"]);
            $formConfig->order = 2;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "L???p";
            $formConfig->type = "select";
            $formConfig->required = true;
            $formConfig->config_content = json_encode(["10C1", "10C2", "10C3", "10C4", "10C5", "10C6", "10C7", "10C8", "10C9", "10C10"]);
            $formConfig->order = 3;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "Ng??y, th??ng, n??m sinh";
            $formConfig->type = "date";
            $formConfig->required = true;
            $formConfig->order = 4;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "D??n t???c";
            $formConfig->type = "text";
            $formConfig->required = true;
            $formConfig->order = 5;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "Qu???c t???ch";
            $formConfig->type = "text";
            $formConfig->required = true;
            $formConfig->order = 6;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "N??i sinh";
            $formConfig->type = "text";
            $formConfig->required = true;
            $formConfig->order = 7;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "Qu?? qu??n";
            $formConfig->type = "text";
            $formConfig->required = true;
            $formConfig->order = 8;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "N??i ??? hi???n nay";
            $formConfig->type = "text";
            $formConfig->required = true;
            $formConfig->order = 9;
            $formConfig->save();


            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "H??? v?? t??n cha";
            $formConfig->type = "text";
            $formConfig->required = true;
            $formConfig->order = 10;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "??i???n tho???i (cha)";
            $formConfig->type = "text";
            $formConfig->required = true;
            $formConfig->order = 11;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "H??? v?? t??n m???";
            $formConfig->type = "text";
            $formConfig->required = true;
            $formConfig->order = 12;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "??i???n tho???i (m???)";
            $formConfig->type = "text";
            $formConfig->required = true;
            $formConfig->order = 13;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "H??? v?? t??n ng?????i d??m h??? (n???u c??)";
            $formConfig->type = "text";
            $formConfig->required = false;
            $formConfig->order = 14;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "??i???n tho???i (ng?????i d??m h??? (n???u c??))";
            $formConfig->type = "text";
            $formConfig->required = false;
            $formConfig->order = 15;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "N??ng khi???u (n???u c??)";
            $formConfig->type = "text";
            $formConfig->required = false;
            $formConfig->order = 16;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "???? t???ng tham gia thi HSG";
            $formConfig->config_content = json_encode(["C??", "Kh??ng"]);
            $formConfig->type = "radio";
            $formConfig->required = true;
            $formConfig->order = 17;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "Tham gia thi HSG huy???n m??n";
            $formConfig->type = "text";
            $formConfig->required = false;
            $formConfig->order = 18;
            $formConfig->target = 17;
            $formConfig->target_value = "C??";
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "K???t qu??? tham gia thi HSG huy???n";
            $formConfig->type = "radio";
            $formConfig->required = false;
            $formConfig->config_content = json_encode(["?????u", "Tr?????t"]);
            $formConfig->order = 18;
            $formConfig->target = 17;
            $formConfig->target_value = "C??";
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "Thu???c ?????i t?????ng hs h??a nh???p";
            $formConfig->type = "radio";
            $formConfig->required = true;
            $formConfig->config_content = json_encode(["C??", "Kh??ng"]);
            $formConfig->order = 19;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "Thu???c ?????i t?????ng khuy???t t???t n???ng";
            $formConfig->type = "radio";
            $formConfig->required = true;
            $formConfig->config_content = json_encode(["C??", "Kh??ng"]);
            $formConfig->order = 20;
            $formConfig->save();

            $formConfig = new UserConfigForm;
            $formConfig->user_id = $user->id;
            $formConfig->user_form_id = $form->id;
            $formConfig->name = "???? t???ng l??m c??n s??? l???p (l???p tr?????ng/l???p ph??)";
            $formConfig->type = "radio";
            $formConfig->required = true;
            $formConfig->config_content = json_encode(["C??", "Kh??ng"]);
            $formConfig->order = 21;
            $formConfig->save();
        }

        return $user;
    }
}
