<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDepartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('Admin_Departments');
        $this->authorize('Show_All_Departments');
        $data['title'] = __('department');
        $data['departments'] = Department::with('sub_Departments', 'sub_Departments.sub_Departments')->orderBy('id', 'desc')->paginate(2);
        // dd($data);

        return view('admin.departments.departments', $data);
    }

    public function create(){
        $this->authorize('Create_Department');
        $data['title'] = __('departments');
        $data['sub_title'] = __('department_create');
        $data['departments'] = Department::with('sub_Departments')->orderBy('id', 'asc')->get();

        return view('admin.departments.department_add', $data);
    }
    public function store(Request $request)
    {
        $this->authorize('Create_Department');

        $user_id = Auth::user()->id;


        $slug = unique_slug(clean_html($request->name_en), 'Models\Department');
        $path = uploadImage( $request , 'department' , 'image');

        $data = [
            'name_ar'                  => clean_html($request->name_ar),
            'name_en'                  => clean_html($request->name_en),
            'slug'                  => $slug,
            'department_id'           => clean_html($request->parent),
            'icon_class'            => clean_html($request->icon_class),
            'image'                 => $path,
            'description_ar'           => clean_html($request->description_ar),
            'description_en'           => clean_html($request->description_en),
            'status'                => clean_html($request->status),
            'step'                  => 0,
            'is_top'                => 0,
        ];

        if ($request->parent){
            $data['step'] = 1;
            $parent = Department::find($request->parent);
            if ($parent && $parent->category_id){
                $data['step'] = 2;
            }
        }

        $is_create = Department::create($data);
        $modelName = $request->model_name; // لازم تجيب اسم الموديل من الفورم مثلاً
if ($modelName) {
    $modelClass = "App\\Models\\" . $modelName;
    if (class_exists($modelClass)) {
        $modelInstance = $modelClass::latest()->first(); // أو أي طريقة تحدد بيها الـinstance
        if ($modelInstance) {
            $modelInstance->departments()->save(new UserDepartment([
                'user_id' => Auth::id(),
                'commentable_id' => $is_create->id,
            ]));
        }
    }
}
        // if ($request->has('topics')) {
        //     $is_create->topics()->sync($request->topics);
        // }
        if ($request->has('inputs')) {
            $is_create->inputs()->sync($request->inputs);
        }
        if ($request->has('products')) {
            $is_create->products()->sync($request->products);
        }

        return redirect()->route('admin.departments')->with('success', __('department_created'));
    }

    public function edit($id){
        // $this->authorize('Update_Department');

        // $department = Department::find($id);

        // $data['title'] = __('category_edit');
        // $data['department'] = $department;
        // $data['departments'] = Department::whereStep(0)->with('sub_Departments')->orderBy('id', 'asc')->where('id', '!=', $id)->get();

        // if ( ! $department){
        //     abort(404);
        // }

        // return view('admin.departments.department_edit', $data);
        $department = Department::find($id);
        return view('admin.departments.edit', compact('department'));
    }
    // public function show($slug){
    //     $this->authorize('Show_Department');

    //     $department = Department::whereSlug($slug)->first();

    //     // $data['department'] = $department;
    //     $departments = Department::whereStep(0)->with('sub_Departments')->orderBy('id', 'asc')->where('slug', '!=', $slug)->get();
    //     // dd($departments[1]->posts);
    //     if ( ! $department){
    //         abort(404);
    //     }

    //     return view('admin.departments.department_show', compact('department' , 'departments'));
    // }
    public function show($id)
    {
        $department = Department::find($id);
        return view('admin.departments.show',compact('department'));
    }

    public function update(Request $request, $id){
        $this->authorize('Update_Department');
        $department = Department::find($id);
        if ( ! $department){
            return back()->with('error', trans('admin.category_not_found'));
        }

        $old_image = $department->image;
        $path = uploadImage( $request , 'department' , 'image');


        $data = [
            'name_ar'                  => clean_html($request->name_ar),
            'name_en'                  => clean_html($request->name_en),
            'department_id'           => $request->parent,
            'icon_class'            => $request->icon_class,
            'step'                  => 0,
            'status'                => $request->status,
            'image'                 => ($path != 0) ? $path : $old_image,
            'description_ar'           => clean_html($request->description_ar),
            'description_en'           => clean_html($request->description_en),
            'updated_at'            => date('Y-m-d H:i:s')
        ];

        if ($request->parent){
            $data['step'] = 1;
            $parent = Department::find($request->parent);
            if ($parent && $parent->department_id){
                $data['step'] = 2;
            }
        }
        $department->update($data);
        // if ($request->has('topics')) {
            // $department->topics()->sync($request->topics);
        // }
        // if ($request->has('inputs')) {
            $department->inputs()->sync($request->inputs);
            $department->products()->sync($request->products);
        // }
        if ($old_image && $path) {
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('admin.departments')->with('success' , "Updated Successfully");

    }
    public function destroy($id)
    {

        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('admin.departments')->with('success' , "Deleted Successfully");
    }
}
