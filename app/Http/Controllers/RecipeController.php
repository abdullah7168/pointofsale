<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use App\Recipe;
use Illuminate\Support\Facades\Input;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Filters\Transformer as Transformer;
use App\Policy;
class RecipeController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth',['except' => ['getImage']]);
    }
    public function index(){
        $recipes = Recipe::all();
        return view('backend.pages.recipe.index',compact('recipes'));
    }

    public function getAdd(){
        $categories = Category::all();
        return view('backend.pages.recipe.add',compact('categories'));
    }
    
    public function postRecipe(Request $request){
        $validator = $this->validate($request, [
                    'rcp_name' => 'required|unique:recipes|min:3|regex:/^[(a-zA-Z\s)(0-9\s)]+$/u',
                    'rscp_ingts' => 'required',
                    'rcp_cp'=>'required|numeric',
                    'recipeThumb' => 'nullable|image|mimes:jpeg|max:2048'
                    
                    ]);
        if($validator){
            return redirect::back()
                            ->withError($validator)
                            ->withInput();
        } else{
                //adding a new recipe
                $recipe             = new Recipe;
                $recipe->rcp_name   = $request->rcp_name;
                $recipe->rcp_dscp   = $request->rcp_dscp;
                $recipe->qty_in_stock = $request->qty_in_stock; 
                $recipe->rscp_ingts = $request->rscp_ingts;
                $recipe->rcp_cp     = $request->rcp_cp;
                $policy             = Policy::all();
                $recipe->rcp_sp     = ($request->rcp_cp) / $policy[0]->menu_price;
                $recipe->rcp_cat_id = $request->rcp_cat_id;
                $file               = $request->file('recipeThumb');
                $extension = Input::file('recipeThumb')->getClientOriginalExtension();
                //sniff the spaces in recipe name. 
                $spaces_to_dashes   = new Transformer();
                $filename = $spaces_to_dashes->sniffSpaces($request->rcp_name,$extension);
                $recipe->recipeThumb = $filename;
                if($file){

                    Storage::disk('local')->put($filename, File::get($file));

                }

                $recipe->save();
                return redirect('/recipes')->with('message','Successfully added new recipe.');
                echo $filename;
        }
    }
    
    public function showRecipe($id){

        $recipe = Recipe::findOrFail($id);
        //$space_to_dashes = new Transformer();
        $fname = $recipe->recipeThumb;
        return view('backend.pages.recipe.show',compact('recipe','fname'));
    }
    public function getImage($filename){

        $file = Storage::disk('local')->get($filename);
        return new response($file,200);
    }
    public function deleteRecipe($id){

        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return redirect('/recipes')->with('message','Successfully deleted recipe.');
    }

    public function getEdit($id){

        $recipe     = Recipe::findOrFail($id);
        $category   = Category::Where('id',$recipe['rcp_cat_id'])->first();
        $categories = Category::all();

        return view('backend.pages.recipe.edit',compact('recipe','category','categories'));
    }

    public function postEdit(Request $request,$id){
        $validator = $this->validate($request, [
                    'rscp_ingts' => 'required',
                    'rcp_cp'=>'required|numeric'
                    ]);
        if($validator){
            return redirect::back()
                            ->withError($validator)
                            ->withInput();
        } else {
        
                $recipe             = Recipe::findOrFail($id);
                $recipe->rcp_dscp   = $request->rcp_dscp;
                $recipe->rscp_ingts = $request->rscp_ingts;
                $recipe->qty_in_stock = $request->qty_in_stock;
                $recipe->rcp_cp     = $request->rcp_cp;
                $policy             = Policy::all();
                $recipe->rcp_sp     = ($request->rcp_cp) / $policy[0]->menu_price;
                $recipe->rcp_cat_id = $request->rcp_cat_id;
                $recipe->update();
        }
        return redirect('/recipes')->with('message','Successfuly updated the recipe');
    }

    
}
