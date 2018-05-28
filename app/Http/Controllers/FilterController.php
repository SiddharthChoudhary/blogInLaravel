<?php
/**
 * Created by PhpStorm.
 * User: siddharth
 * Date: 28/5/18
 * Time: 12:37 AM
 */

namespace App\Http\Controllers;

use App\Blog_Category_Mapping;
use App\Blogmodel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    protected $Blogmodalobject;

    public function __construct()
    {
        $this->Blogmodalobject = new Blogmodel();
    }

    //functions to filter blogs by category, date, and Author
    public function filterTheBlogsByCategory(Request $request)
    {
        $query=Blogmodel::query();
        $category_ids  = [];
        if(count($request->category_ids)){
            for($i=0;$i<count($request->category_ids);$i++){
                array_push($category_ids,$request->category_ids[$i]);
            }
            $blog_id=Blog_Category_Mapping::select('blog_id')->whereIn('category_id',$category_ids)->get();
            $query->whereIn('id',$blog_id)->distinct();
        }
        if($request->date){

            $query->whereDate('date_created','>',Carbon::parse($request->date))->orderBy('date_created');
        }
        if($request->author_name){
            $query->where('author','like',$request->author_name.'%')->distinct();
        }
        return response()->json(['status'=>$query->get()]);
    }
}