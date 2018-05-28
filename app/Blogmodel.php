<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
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
}