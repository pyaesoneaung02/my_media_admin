<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct post page
    public function index(){
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.index',compact('category','post'));
    }

    //create post
    public function createPost(Request $request){
        // dd($request->all());
        $validator = $this->checkPostValidation($request);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        if(!empty($request->file('postImage'))){
            $file     = $request->file('postImage');
            $fileName = uniqid() . '_pyaesoneaung_' . $file->getClientOriginalName();
            $file->move(public_path() . '/postImage', $fileName);
            $data = $this->getPostData($request, $fileName);
        }else{
            $data = $this->getPostData($request, NULL);
        }
        Post::create($data);

        return back();
    }

    //delete post
    public function deletePost($id){
        $postData = Post::where('post_id',$id)->first();
        $dbImageName = $postData['image'];

        Post::where('post_id', $id)->delete();

        if(File::exists(public_path().'/postImage/'.$dbImageName)){
            File::delete(public_path().'/postImage/'.$dbImageName);
        }

        return back();
        // dd($id);
    }

    //update post
    public function updatePost($id, Request $request){
        $validator = $this->checkPostValidation($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $this->requestUpdatePostData($request);

        if(isset($request->postImage)){
            $this->storeNewUpdateImage($id,$request,$data);
        }else{
            Post::where('post_id', $id)->update($data);
        }

        return back();
    }

    //direct update post page
    public function updatePostPage($id){
        $postDetails = Post::where('post_id',$id)->first();
        $category = Category::get();
        $post = Post::get();
        return view('admin.post.update',compact('postDetails','category','post'));
    }

    //store new update image
    private function storeNewUpdateImage($id,$request,$data){
        //get from client
        $file     = $request->file('postImage');
        $fileName = uniqid() . '_pyaesoneaung_' . $file->getClientOriginalName();

        //put new image name into data array
        $data['image'] = $fileName;

        //get image name from database
        $postData    = Post::where('post_id', $id)->first();
        $dbImageName = $postData['image'];

        //delete image from public folder
        if (File::exists(public_path() . '/postImage/' . $dbImageName)) {
            File::delete(public_path() . '/postImage/' . $dbImageName);
        }

        //store new image under public folder
        $file->move(public_path() . '/postImage', $fileName);

        //update new data with new image
        Post::where('post_id',$id)->update($data);
    }

    //request update post data
    private function requestUpdatePostData($request){
        return [
            'title' =>$request->postTitle,
            'description' =>$request->postDescription,
            'category_id' =>$request->postCategory,
            'updated_at' => Carbon::now()
        ];
    }

    private function getPostData($request,$fileName){
        return [
            'title' =>$request->postTitle,
            'description' =>$request->postDescription,
            'image' =>$fileName,
            'category_id' =>$request->postCategory,
            'created_at' =>Carbon::now(),
            'updated_at' =>Carbon::now()
        ];
    }

    //post validation check
    private function checkPostValidation($request){
        return Validator::make($request->all(),[
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postCategory' => 'required'
        ]);
    }
}
