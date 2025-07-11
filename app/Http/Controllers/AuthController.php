<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Role;
use App\Models\User;
use App\Models\Water;
use App\Models\BigCar;
use App\Models\Family;
use App\Models\Garden;
use App\Models\Worker;
use App\Models\Teacher;
use App\Models\CarWater;
use App\Models\Cleaning;
use App\Models\PublicGe;
use App\Models\Department;
use App\Models\Contracting;
use App\Models\FollowCamera;
use Illuminate\Http\Request;
use App\Models\CounterInsects;
use App\Models\UserDepartment;
use App\Models\PartyPreparation;
use App\Services\Auth\UserServices;
use App\Http\Controllers\Controller;
use App\Models\AirCondition;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\FurnitureTransportation;
use App\Models\Governements;
use App\Models\HeavyEquipment;
use App\Models\SpareParts;
use App\Models\VanTruck;
use Exception;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class AuthController extends Controller
{
    public $userService;

    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }
    public function loginPage()
    {
        $previous_url = url()->previous();
        $url = explode('/', $previous_url);
        $end_url =  end($url);
        if (isset($end_url) && $end_url == 'show') {
            $message = 'من فضلك سجل الدخول اولا';
        } else {
            $message = null;
        }
        return view('front_office.auth.login', compact('message'));
    }
    public function registerPage()
    {
        $previous_url = url()->previous();
        $url = explode('/', $previous_url);
        $end_url =  end($url);
        if (isset($end_url) && $end_url == 'show') {
            $message = 'من فضلك سجل الدخول اولا';
        } else {
            $message = null;
        }




        $countries = Country::all();
        $govers = Governements::all();


        return view('front_office.auth.register', compact('message', 'countries', 'govers'));
    }


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $user = User::where('email', $request['email'])->orWhere('phone', $request['email'])->first();
        } else {
            return back()->withErrors([
                'loginError' => 'خطأ في البريد الالكتروني او كلمة المرور . من فضلك حاول مرة اخري',
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login-page');
    }
    public function forgotPassword()
    {
        return view('front_office.auth.forgot-password');
    }

    public function register(Request $request)
    {

        try {
            DB::beginTransaction();

            $request->validate([
                'first_name' => "required",
                'last_name' => "required",
                'country' => "required",
                'governement' => "required",
                // 'email' => "email",
                'password' => "required|min:6",
                'phone' => 'required|digits_between:6,20|unique:users|numeric',
            ], [
                'first_name.required' => __("auth.required"),
                'last_name.required' => __("auth.required"),
                // 'email.email' =>  __('auth.typy_email'),
                // 'password.confirmed' =>  __('auth.confirmed'),
                'password.min' =>  __('auth.min'),
                'password.required' =>  __('auth.required'),
                'phone.required' =>  __('auth.required'),
                'phone.unique' =>  'تم حجز رقم الهاتف مسبقا',
            ]);
            if ($request->image) {

                $new_image = uploadImage($request, "users", "image");
            }
            $role = Role::where('id', $request->role_id)->first();
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email ?? null,
                'phone' => $request->phone,
                'country' => $request->country,
                'governement' => $request->governement,
                'role_name' => $role->name ?? 'user',
                'role_id' => $role->id ?? 1,
                'image' => $new_image ?? null,
                'status'    => 'active',
                'password' => Hash::make($request->password),

            ]);


            // foreach ($request->departments as $item) {
            //     [$name, $id] = explode('-', $item);

            //     $modelParts = explode(' ', $name);
            //     $modelName = implode('', array_map('ucfirst', $modelParts));
            //     // dd($modelName);

            //     $modelClass = "App\\Models\\$modelName";
            //     $main_department = new UserDepartment([
            //         'user_id' => $user->id,
            //         'commentable_id' => $id,
            //     ]);
            //     if (class_exists($modelClass)) {
            //         $modelClass::find($id)->departments()->save($main_department);
            //     } else {
            //         Department::find($id)->departments()->save($main_department);
            //     }
            // }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        auth()->login($user);



        return redirect()->route('home');
    }
}
