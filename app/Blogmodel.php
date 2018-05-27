<?php

namespace App;


use function GuzzleHttp\Psr7\str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Mockery\Exception;

class Blogmodel extends Model
{

    protected $table = 'Blog';

    public function addBlogInDatabase($blog_data,$selected_categories)
    {
        $blog = new Blogmodel();
        try {
            foreach ($blog_data as $key => $value) {
                $blog->$key = $value;
            }
             $inserted_blog = $blog->save();
            if($blog->id&&count($selected_categories)){
                foreach ($selected_categories as $key=>$value){
                    $blog_category_mapping= new Blog_Category_Mapping();
                    $blog_category_mapping->category_id= $value;
                    $blog_category_mapping->blog_id = $blog->id;
                    $blog_category_mapping->save();
                }
            }
            return true;
        }catch(Exception $e){
return false;
}
    }


    //to show the list of all blogs
    public function toShowAllTheBlogs()
    {
        /*$result = DB::table('Blog')->get();*/
        $result = Blogmodel::all();
        return $result;

    }

    public function toShowBlogsbyCategory($request){
        $category_ids  = [];
        for($i=0;$i<count($request->category_ids);$i++){
            array_push($category_ids,$request->category_ids[$i]);
        }
        if(count($category_ids)){
            $blog_id=Blog_Category_Mapping::select('blog_id')->whereIn('category_id',$category_ids)->get();
            $blogs = Blogmodel::whereIn('id',$blog_id)->distinct()->get();
        }
        return $blogs;
    }

    public function toShowBlogsbyDate($request){
        $date_selected = $request->date;
        if($date_selected){
            $blogs = Blogmodel::where('date_created','<',$date_selected)->orderBy('date_created')->get();
        }
        return $blogs;

    }

    public function toShowBlogsbyAuthor($request){
        $author_name = $request->author_name;
        if($author_name){
            $blogs = Blogmodel::where('author','like',$author_name.'%')->distinct()->get();
        }
        return $blogs;

    }

}