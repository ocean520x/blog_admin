<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryResource::collection(Category::orderBy('sort')->get());
        return $this->success(data: $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request, Category $category)
    {
        Gate::authorize('create', $category);
        $category->fill($request->input())->save();
        return $this->success('帖子大类新增成功!', new CategoryResource($category->refresh()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->success(data: new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Gate::authorize('update', $category);
        $category->fill($request->input())->save();
        return $this->success('帖子大类修改成功!', new CategoryResource($category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);
        $category->delete();
        return $this->success('帖子大类删除成功!');
    }

    public function changeSort(Request $request)
    {
        Gate::authorize('sort', Category::class);
        collect($request->categories)->map(function ($category_id, $sort) {
            $category = Category::find($category_id);
            $category->sort = $sort;
            $category->save();
        });
        return $this->success('帖子大类排序成功!');
    }
}
