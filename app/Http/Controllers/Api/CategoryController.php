<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function addCategory(Request $request)
    {

        $this->validate(
            $request,
            [
                'name' => 'required'
            ]
        );
        Category::create(['name' => $request->name]);
        return response()->json(
            [
                'message' => 'category Added successfully'
            ],
            200
        );
    }
    public function updateCategory(Request $request,$id)
    {
        $category = Category::find($id);
        if($category)
        {
            $this->validate(
                $request,
                [
                    'name' => 'required'
                ]
            );
            $category->update(['name' => $request->name]);
            return response()->json(
                [
                    'message' => 'category Updated successfully'
                ],
                200
            );
        }
        return response()->json(['message'=>'category NotFound'],404);
        
    }
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        if($category)
        {
            $category->delete();
            return response()->json(['message'=>'category Deleted successfully']);
        }
        return response()->json(['message'=>'category NotFound'],404);
    }
}
