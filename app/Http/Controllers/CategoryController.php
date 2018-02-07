<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Session;
class CategoryController extends Controller
{
       
    public function index(){
        $categories = Category::all();
        return view('backend.pages.category.index',compact('categories'));
    }
    public function postCategory(Request $request){
        $validator = $this->validate($request, [
                        'cat_name' => 'required|unique:categories|max:255',
                    ]);
        
        if ($validator) {
            return redirect('/categories')
                        ->withErrors($validator);
        } else {
                $category = new Category;
                $category->cat_name = $request->cat_name;
                $category->save();
                return redirect('/categories')->with('message','Successfully added a new category.');
              }
    }
    public function deleteCategory($id){
        $category = Category::findOrFail($id);
        //var_dump($category);
        $category->delete();
        //$category->update();
        return redirect('/categories')->with('message','Successfully deleted the category');
    }
}
