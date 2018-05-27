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
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $blogs=$this->Blogmodalobject->toShowBlogsbyCategory($request);
        return response()->json(['status'=>$blogs]);
    }
    public function filterTheBlogsByDate(Request $request)
    {
        $blogs=$this->Blogmodalobject->toShowBlogsbyDate($request);
        return response()->json(['status'=>$blogs]);
    }
    public function filterTheBlogsByAuthor(Request $request)
    {
        $blogs=$this->Blogmodalobject->toShowBlogsbyAuthor($request);
        return response()->json(['status'=>$blogs]);
    }

}