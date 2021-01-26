<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Intervention\Image\Facades\Image;

class BackendBlogController extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = public_path('img');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->with('user', 'category')->paginate(5);
        $postCount = Post::count();
        return view('backend.blog.index', compact('posts', 'postCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.blog.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'bail|required',
            'slug' => 'bail|required|unique:posts',
            'body' => 'bail|required',
            'category_id' => 'bail|required',
            'excerpt' => 'bail|required',
            'image' => 'mimes:jpg,bmp,png,jpeg'
            // 'published_at' => 'bail|date_format:Y-m-d H:i:s',
        ]);

        $data = $this->handleRequest($request);
        $request->user()->posts()->create($data);

        return redirect(route('backend.index'))->with('success', 'Your post was created successfully :)');
    }

    private function handleRequest($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = hexdec(uniqid());
            $imageExt = strtolower($image->getClientOriginalExtension());
            $fileName = $imageName. '.' .$imageExt;
            $destination = $this->uploadPath;

            $successUploaded = $image->move($destination, $fileName);

            if ($successUploaded) {
                $thumbnail = str_replace(".{$imageExt}", "_thumb.{$imageExt}", $fileName);

                Image::make($destination . '/' . $fileName)->resize(250, 170)->save($destination . '/' . $thumbnail);
            }

            $data['image'] = $fileName;
        }

        // $fileName = hexdec(uniqid());
        //     $image_ext = strtolower($image->getClientOriginalExtension());
        //     $imageName = $fileName. '.' .$image_ext;
        //     $uploadPath = 'img/posts-image/';
        //     $saveImageToServer = $uploadPath.$imageName;
        //     $image->move($uploadPath, $imageName);

        //     $data['image'] = $saveImageToServer;

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}