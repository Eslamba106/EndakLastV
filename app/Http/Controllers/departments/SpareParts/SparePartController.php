<?php

namespace App\Http\Controllers\departments\SpareParts;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\GeneralImage;
use App\Models\Governements;
use App\Models\SpareParts;
use App\Models\SparePartServices;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SparePartController extends Controller
{
    public function index(){
        $spare_part = SpareParts::where('spare_part_id',0)->first();
        return view('admin.main_department.spare_part.index' , compact('spare_part'));
    }
    public function edit($id){
        $main = SpareParts::find($id);
        return view('admin.main_department.spare_part.edit' , compact('main'));
    }

    public function update(Request $request , $id){
        $main = SpareParts::find($id);
        $old_image = $main->image;

        $path = uploadImage( $request , 'spare_part' , 'image');
        $main->update([
            'name_ar'               => $request->name_ar,
            'name_en'               => $request->name_en,
            'image'                 => $path,
        ]);
        if ($old_image && $path) {
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('admin.spare_part')->with('success' , 'تم التحديث بنجاح');
    }
    public function add_sub_department(){
        $spare_part = SpareParts::where('spare_part_id' , 0)->first();
        return view('admin.main_department.spare_part.create');
    }
    public function store_sub_department(Request $request  ){
        $spare_part = SpareParts::where('spare_part_id' , 0)->first();
            // dd($spare_part);

        $path = uploadImage( $request , 'spare_part' , 'image');
       $data= SpareParts::create([
            'name_ar'               => $request->name_ar,
            'name_en'               => $request->name_en,
            'image'                 => $path,
            'spare_part_id'        => $spare_part->id,
        ]);
            // dd($data);

        return redirect()->route('admin.spare_part')->with('success' , 'تم الاضافة بنجاح');
    }
    public function show_sub_departments_list(){
        $departments = SpareParts::where('spare_part_id', '!=' , 0)->paginate();

        return view('admin.main_department.spare_part.departments_list' , compact('departments'));
    }
    public function show_sub_department($id){
        $spare_part = SpareParts::find($id);

        return view('admin.main_department.spare_part.index' , compact('spare_part'));
    }
    public function delete($id)
    {
        $spare_part = SpareParts::where('spare_part_id', '!=', 0)->find($id);

        if ($spare_part) {
            $spare_part->delete();
            return to_route('admin.spare_part.show_sub_departments_list')->with('success', 'spare_part deleted successfully.');
        }

        return to_route('admin.spare_part.show_sub_departments_list')->with('error', 'spare_part not found.');
    }

    public function show(){
        $user = auth()->user();
        $main = SpareParts::where('spare_part_id',0)->first();
        $spare_parts = Cache::remember('spare_part', 60, function () {
            return SpareParts::where('spare_part_id', '!=',0)->paginate();
        });
        return view('admin.main_department.spare_part.front_show' , compact( 'main' , 'spare_parts'));
    }

    public function spare_part_sub_show($id){
        $user = auth()->user();
        $main = SpareParts::find($id);
        $departments = Department::where('name_en', 'spare parts')->first();
        $services = SparePartServices::where('spare_part_id' ,$id)->paginate();

          if (auth()->check()) {
             $user = auth()->user();
            $cities = Governements::where('country_id', $user->country)->get();
            // dd($user->country);
        }else{
             $cities = Governements::where('country_id', 178)->get();
        }

        return view('admin.main_department.spare_part.show_sub_sparepart' , compact( 'departments','cities','main','services'  ));
    }

    public function store_service(Request $request)
    {
        // Validate the data
        $data = $request->validate([
            'spare_part_id'      => 'required|integer|exists:spare_parts,id',
            'brand'              => 'required|string|max:255',
            'year_made'          => 'required|string|max:10',
            'part_number'        => 'required|string|max:255',
            'name'               => 'required|string|max:255',
            'from_city'          => 'required|string|max:255',
            'from_neighborhood'  => 'required|string|max:255',
            'to_city'            => 'required|string|max:255',
            'to_neighborhood'    => 'required|string|max:255',
            'notes'              => 'nullable|string',
            'user_id'            => 'required|exists:users,id',
        ]);
        // dd($data);
        // Create the service
        try {
            $is_created = SparePartServices::create($data);

            // Handle image uploads
            if ($is_created && $request->hasFile('images')) {
                $files = $request->file('images');

                // Ensure files is always an array
                if (!is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $file) {
                    // Store image in a subdirectory with service ID for better organization
                    $path = $file->store('spare_parts/' . $is_created->id, [
                        'disk' => 'public',
                    ]);

                    // Create and save image to the service
                    $image = new GeneralImage([
                        'path' => $path,
                    ]);

                    $is_created->images()->save($image);
                }
            }

            return redirect()->route('home')->with('success', 'تم اضافة الطلب بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء إضافة الطلب: ' . $e->getMessage());
        }
    }


    public function show_my_service($id){
        $user = auth()->user();
        $service = SparePartServices::find($id);

        if (!$service) {
            return redirect()->back()->with('error', 'الخدمة غير موجودة');
        }
        $main = SpareParts::where('id',$service->spare_part_id)->first();
        // dd($main);
        return view('admin.main_department.spare_part.show_myservice' , compact( 'main' , 'service'));
    }
    public function edit_service($id){

        $service=SparePartServices::findOrFail($id);
        $mains = SpareParts::get();
        if (auth()->id() !== $service->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $user = auth()->user();


        return view('admin.main_department.spare_part.edit_service',compact('service','user','mains'));
    }
    public function update_service(Request $request,$id){
        $data = $request->validate([

            'user_id'            => 'required|exists:users,id',
            'spare_part_id'      => 'required|integer|exists:spare_parts,id',
            'brand'              => 'required|string|max:255',
            'year_made'          => 'required|string|max:10',
            'part_number'        => 'required|string|max:255',
            'name'               => 'required|string|max:255',
            'from_city'          => 'required|string|max:255',
            'from_neighborhood'  => 'required|string|max:255',
            'to_city'            => 'required|string|max:255',
            'to_neighborhood'    => 'required|string|max:255',
            'notes'              => 'nullable|string',

        ]);

        try {
            $service = SparePartServices::findOrFail($id);
            // dd($service);
            $service->update($data);

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
            // تحديث الصور (اختياري)
            if ($request->hasFile('images')) {
                // احذف الصور القديمة لو تحب
                $service->images()->delete();

                foreach ((array) $request->file('images') as $file) {
                    $path = $file->store('spare_part/' . $service->id, 'public');

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
        $service = SparePartServices::findOrFail($id);

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
