<?php


namespace App\Http\Controllers;

use App\Blog_Category_Mapping;
use App\Blogmodel;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    protected $Blogmodalobject;

    public function __construct()
    {
        $this->middleware('auth');
        $this->Blogmodalobject = new Blogmodel();
    }

    public function toShowTheBlog()
    {
        $blogs      = $this->Blogmodalobject->toShowAllTheBlogs();
        $category   = Category::get();

        return view('blogs', [
            'blogs'         =>  $blogs,
            'categories'    =>  $category
        ]);
    }

    //to handle the request
    public function addTheBlog(Request $request)
    {
        if($request->isMethod('post')){
            $category  = [];

            for($i = 0; $i<count($request->category); $i++){
                array_push($category,$request->category[$i]);
            }

            $blog       =   $this->_prepareData($request);

            $result     =   $this->Blogmodalobject->addBlogInDatabase($blog,$category);

            if($result) {
                return view('successfullyupload');
            }
        }

        $categories =   Category::get();
        return view('base')->with('categories',$categories);

    }

    public function _prepareData($request)
    {
        $addBlog = new \stdClass();

        $addBlog->blogtext      = $request->get('blog');
        $addBlog->title         = $request->get('blog_title');
        $addBlog->author        = Auth::user()->name;
        $addBlog->date_created  = Carbon::now();
        $addBlog->author_id     = Auth::id();

        return $addBlog;
    }

}