<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Department;
use App\Models\ProductItems;
use Illuminate\Http\Request;
use App\Services\PostServices;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;

class PostController extends Controller
{
    public $post_service;

    public function __construct(PostServices $post_service)
    {
        $this->post_service = $post_service;
    }

    public function index($id)
    {
        $posts = $this->post_service->getAllWith('department_id', $id);
        // dd($posts);
        return view('front_office.posts.all', compact('posts'));
    }
    public function create($id)
    {
        // dd($id);
        $department = Department::findOrFail($id);
        $products = $department->products;
        // dd($products);
        return view('front_office.posts.create', compact('department' , 'products'));
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     "department_id" => "required",
        //     "title" => "required",
        //     'price' => "required"
        // ]);
        $user = auth()->user()->id;
        $data = $request->except(['selected_products' , 'quantities']);
        $data['user_id'] = $user;
        $post = $this->post_service->store($data);
        if($request->selected_products){
            
        foreach ($request->input('selected_products') as $productId) {
            $quantity = $request->input("quantities.$productId");

            if ($quantity > 0) {
                ProductItems::create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'post_id' => $post->id,
                ]);
            }
        }
        }
        return redirect()->route('web.posts' , $request->department_id)->with('success','Add Seccessfully');
    }
    public function show($id)
    {
        $post = $this->post_service->show($id);        
        $userUnreadNotification = auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
        }  
        return view('front_office.posts.show', compact('post'));
    }

    public function my_posts($id){
        $posts = Post::where('user_id', $id)->paginate(6);
        
        return view('front_office.posts.my_posts' , compact('posts'));
    }




    public function uploadLargeFiles(Request $request)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name
            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('videos', $file, $fileName);
            $request->session()->put('sharedValue', $path);
            // delete chunked file
            unlink($file->getPathname());
            return $path;
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true];
    }
}
