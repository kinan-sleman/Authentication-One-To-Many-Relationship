<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Auth;

class PostController extends Controller
{
    // من خلال هذا الـ construct يمكننا منع الزائر للموقع من إنشاء الـ post في حال لم يتم تسجيل الدخول
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $posts = Post::latest()->paginate(4);
        return view('posts.index', compact('posts'));
    }
    public function postsTrashed()
    {
        // $post = Post::onlyTrashed()->get();
        $posts = Post::onlyTrashed()->paginate(4);
        return view('posts.trashed')->with('posts', $posts);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'photo' => 'required|image',
        ]);
        // حيث أن هذا المتغير يدل على أن الـ Request لا بد أن يحمل في طياته على Photo 
        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        // حيث أن هذه الـ Syntax تقوم بفصل الصورة عن امتدادها .. ويجمعها مع الوقت الحالي  .. وبالتالي هذا يضمن لنا أنه الاسم لن يتكرر
        // بعد ذلك أقوم بنقل الصورة إلى مسار قمنا بإنشائه ضمن الـ Public Folder 
        $photo->move('uploads/posts' , $newPhoto);

        // بعد ذلك نقوم بعملية الحفظ ضمن الـ Database على الشكل التالي :
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'photo' => 'uploads/posts/' . $newPhoto,
            'slug' => str_slug($request->title)
        ]);
        return redirect()->back();  
    }
    public function show($slug)
    {
        // نحن هنا لا نريد كامل الـ posts وإنما فقط التي لها نفس الـ slug وبالتالي نضع على الشكل التالي :
        $post = Post::where('slug', $slug)->first();
        return view('posts.show', compact('post'));
    }
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }
    public function update($id, Request $request)
    {
        $post = Post::find($id);
        // لا نريد أن نجبر الـ User ضمن الـ Update إدخال الـ Photo 
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            // 'photo' => 'required|image',
        ]);

        // يمكننا استخدام الـ dd Function من أجل اختبار الـ Data التي يتم إرسالها عند التعامل مع أي Request حيث يتم من خللاها فقط طباعة الـ Data التي يتم إرسالها عند عمل أي Update
        // dd($request->all());
        $post->title = $request->title;
        $post->content = $request->content;
        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();
            $photo->move('uploads/posts/' , $newPhoto);
            $post->photo = 'uploads/posts/' . $newPhoto;
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect()->back();  
    }
    public function destroy($id)    
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back(); 
    }
    public function hdelete($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        return redirect()->back();
    }
    public function restore($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        $post->restore();
        return redirect()->back();
    }
}
