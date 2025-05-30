<?php

namespace App\Http\Controllers\departments\VanTruck;

use App\Http\Controllers\Controller;
use App\Models\GeneralImage;
use App\Models\Governements;
use App\Models\VanTruck;
use App\Models\VanTruckService;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class VanTruckController extends Controller
{
    public function index(){
        $van_truck = VanTruck::where('vantruck_id',0)->first();
        return view('admin.main_department.van_truck.index' , compact('van_truck'));
    }
    public function edit($id){
        $main = VanTruck::find($id);
        return view('admin.main_department.van_truck.edit' , compact('main'));
    }

    public function update(Request $request , $id){
        $main = VanTruck::find($id);
        $old_image = $main->image;

        $path = uploadImage( $request , 'van_truck' , 'image');
        $main->update([
            'name_ar'               => $request->name_ar,
            'name_en'               => $request->name_en,
            'image'                 => $path,
        ]);
        if ($old_image && $path) {
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('admin.van_truck')->with('success' , 'تم التحديث بنجاح');
    }
    public function add_sub_department(){
        $van_truck = VanTruck::where('vantruck_id' , 0)->first();
        return view('admin.main_department.van_truck.create');
    }
    public function store_sub_department(Request $request  ){
        $van_truck = VanTruck::where('vantruck_id' , 0)->first();

        $path = uploadImage( $request , 'van_truck' , 'image');
        VanTruck::create([
            'name_ar'               => $request->name_ar,
            'name_en'               => $request->name_en,
            'image'                 => $path,
            'vantruck_id'        => $van_truck->id,
        ]);

        return redirect()->route('admin.van_truck')->with('success' , 'تم الاضافة بنجاح');
    }
    public function show_sub_departments_list(){
        $departments = VanTruck::where('vantruck_id', '!=' , 0)->paginate();

        return view('admin.main_department.van_truck.departments_list' , compact('departments'));
    }
    public function show_sub_department($id){
        $van_truck = VanTruck::find($id);
        return view('admin.main_department.van_truck.index' , compact('van_truck'));
    }
    public function delete($id)
    {
        $van_truck = VanTruck::where('vantruck_id', '!=', 0)->find($id);

        if ($van_truck) {
            $van_truck->delete();
            return to_route('admin.van_truck.show_sub_departments_list')->with('success', 'van_truck deleted successfully.');
        }

        return to_route('admin.van_truck.show_sub_departments_list')->with('error', 'van_truck not found.');
    }

    public function show(){
        $user = auth()->user();
        $main = VanTruck::where('vantruck_id',0)->first();
        $van_truck = Cache::remember('van_truck', 60, function () {
            return VanTruck::where('vantruck_id', '!=',0)->paginate();
        });
        return view('admin.main_department.van_truck.front_show' , compact( 'main' , 'van_truck'));
    }

    public function van_truck_sub_show($id){
        $user = auth()->user();
        $main = VanTruck::find($id);
        $services = VanTruckService::where('vantruck_id' ,$id)->paginate();
           if (auth()->check()) {
             $user = auth()->user();
            $cities = Governements::where('country_id', $user->country)->get();
            // dd($user->country);
        }else{
             $cities = Governements::where('country_id', 178)->get();
        }

        return view('admin.main_department.van_truck.show_sub_van_truck' , compact( 'cities','main','services'  ));
    }

    public function store_service(Request $request)
    {
        // Validate incoming data
        $data = $request->validate([
            'user_id'            => 'required|exists:users,id',
            'vantruck_id'        => 'required|exists:van_trucks,id',
            'from_city'          => 'required|string|max:255',
            'from_neighborhood'  => 'required|string|max:255',
            'to_city'            => 'required|string|max:255',
            'to_neighborhood'    => 'required|string|max:255',
            'notes'              => 'nullable|string|max:500',
            'location'           => 'nullable|string|max:255',
            'time'               => 'required|date_format:H:i',
        ]);

        // dd($data);
        try {
            $service = VanTruckService::create($data);
            if($service->comments == true)
            {
            $comments = $service->comments;

            foreach ($comments as $comment) {
                $provider = $comment->user;
                $customer = $comment->customer;

                $provider->notify(new CommentNotification([
                    'id' => $comment->id,
                    'title' => "قام $customer->fullname بتعديل أو حذف الخدمة",
                    'body' => "قدم عرض جديد",
                    'url' => route('notifications.index'),
                ]));

                $comment->delete(); // حذف التعليق هنا أيضاً
            }
        }

            // Handle images
            if ($request->hasFile('images')) {
                foreach ((array) $request->file('images') as $file) {
                    $path = $file->store('van_truck/' . $service->id, 'public');

                    $image = new GeneralImage([
                        'path' => $path,
                    ]);

                    $service->images()->save($image);
                }
            }

            return redirect()->route('home')->with('success', 'تم اضافة الطلب بنجاح');

        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء الإضافة: ' . $e->getMessage());
        }
    }

    public function show_my_service($id){
        $user = auth()->user();
    $service = VanTruckService::find($id);

    if (!$service) {
        return redirect()->back()->with('error', 'الخدمة غير موجودة');
    }

    $main = VanTruck::find($service->vantruck_id);
        // dd($main);
        return view('admin.main_department.van_truck.show_myservice' , compact( 'main' , 'user','service'));
    }

    public function edit_service($id){

        $service=VanTruckService::findOrFail($id);
        $cars = VanTruck::where('vantruck_id',!0)->get();
        if (auth()->id() !== $service->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $user = auth()->user();


        return view('admin.main_department.van_truck.edit_service',compact('service','user','cars'));
    }
    public function update_service(Request $request,$id){
        $data = $request->validate([

            'user_id'            => 'required|exists:users,id',
            'vantruck_id'        => 'required|exists:van_trucks,id',

            'from_city'          => 'required|string|max:255',
            'from_neighborhood'  => 'required|string|max:255',
            'to_city'            => 'required|string|max:255',
            'to_neighborhood'    => 'required|string|max:255',
            'notes'              => 'nullable|string|max:500',
            'location'           => 'nullable|string|max:255',
            'time'               => 'required|date_format:H:i',
        ]);

        try {
            $service = VanTruckService::findOrFail($id);
            // dd($service);

            $service->update($data);

            // تحديث الصور (اختياري)
            if ($request->hasFile('images')) {
                // احذف الصور القديمة لو تحب
                $service->images()->delete();

                foreach ((array) $request->file('images') as $file) {
                    $path = $file->store('van_truck/' . $service->id, 'public');

                    $image = new GeneralImage([
                        'path' => $path,
                    ]);

                    $service->images()->save($image);
                }
            }

            return redirect()->route('home')->with('success', 'تم تحديث الطلب بنجاح');

        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء التحديث: ' . $e->getMessage());
        }
    }
    public function destroy_service($id)
{

    try {
        $service = VanTruckService::findOrFail($id);

        if (auth()->id() !== $service->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $service->delete();

        return redirect()->route('home')->with('success', 'تم حذف الطلب بنجاح');
    } catch (\Exception $e) {
        return redirect()->route('home')->with('error', 'حدث خطأ أثناء الحذف: ' . $e->getMessage());
    }
}


}
