<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategorySubCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use App\Services\LogServices;
use App\Trait\StatusTrait;
use Illuminate\Http\Request;

class ProductHierarchyController extends Controller
{
    use StatusTrait;

    #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "ProductHierarchyController";

    #Bind User Model
    protected $user;

    #Bind Category Model
    protected $category;

    #Bind SubCategory Model
    protected $subCategory;

    #Bind CategorySubCategory Model
    protected $categorySubCategory;

    #Bind Products Model
    protected $product;

     public function __construct(LogServices $logServices,User $user,Category $category,SubCategory $subCategory,CategorySubCategory $categorySubCategory,Product $product)
     {
        $this->logServices         = $logServices;
        $this->user                = $user;
        $this->category            = $category;
        $this->subCategory         = $subCategory;
        $this->categorySubCategory = $categorySubCategory;
        $this->product             = $product;
    }

    /**
     * @method helps to give Categories
     * @param Request
     * @return responseJson
     */

    public function getCategories(Request $request)
    {
        try{
             $categories = $this->category->select('id','slug','name','sorting_priority_number','description','status')
                                          ->with('image:id,cat_id,path')
                                          ->get()
                                            ->map(function ($category) {
                                                return [
                                                    'id'                      => $category->id,
                                                    'slug'                    => $category->slug,
                                                    'name'                    => $category->name,
                                                    'sorting_priority_number' => $category->sorting_priority_number,
                                                    'description'             => $category->description,
                                                    'status'                  => $category->status,
                                                    'image_url'               => $category->image 
                                                                                ? asset($category->image->path) 
                                                                                : null,
                                                ];
                                            });

                return response()->json([
                    'status_code' => $this->success_code,
                    'status'      => $this->success,
                    'message'     => 'Categories fetched Successfully !!', 
                    'data'        => $categories,
                ], $this->success_code);

        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog("getCategories Function".$e->getMessage());
            return response()->json([
                'status_code' => $this->error_code,
                'status'      => $this->error,
                'message'     => 'Something went wrong',
            ], $this->error_code);
        }
    }
    /**
     * @method helps to get subcategories of category
     * @param categorySlug
     * @return responseJson
     */
    public function getSubCategoriesOfCategory(Request $request,$categorySlug)
    {
        try{
              $category     =  $this->category->firstWhere('slug',$categorySlug);
              $subCateArray =  $this->categorySubCategory->where('category_id',$category->id)->pluck('sub_category_id')->toArray();
              if(!$subCateArray)
              {
                    return response()->json([
                        'status_code' => $this->success_code,
                        'status'      => $this->success,
                        'message'     => 'No Sub Categories found for this category!!', 
                        'data'        => [],
                    ], $this->success_code);
              }
              $subCategories =  $this->subCategory->select('name','id','description','slug')->whereIn('id',$subCateArray)->get();
             return response()->json([
                        'status_code' => $this->success_code,
                        'status'      => $this->success,
                        'message'     => 'Sub Categories fetched Successfully !!', 
                        'data'        => $subCategories,
                    ], $this->success_code);
        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog("getSubCategoriesOfCategory Function".$e->getMessage());
            return response()->json([
                'status_code' => $this->error_code,
                'status'      => $this->error,
                'message'     => 'Something went wrong',
            ], $this->error_code);
        }
    }

    /**
     * @method helps to get products related to sub categories
     * @param slug sub category 
     * @return responseJson
     */
    public function getSubCategoryProducts($subCateSlug,Request $request)
    {
        try{
              $subCategory       =  $this->subCategory->firstWhere('slug',$subCateSlug);
              $products          =  $this->product->where('subcat_id',$subCategory->id)->get();
              if(!$products)
              {
                    return response()->json([
                        'status_code' => $this->success_code,
                        'status'      => $this->success,
                        'message'     => 'No Product found for this subcategory!!', 
                        'data'        => [],
                    ], $this->success_code);
              }
              foreach($products as $prod)
              {
                    $data = [
                        ''

                    ];
              }
             
             return response()->json([
                        'status_code' => $this->success_code,
                        'status'      => $this->success,
                        'message'     => 'products fetched Successfully !!', 
                        'data'        => $products,
                    ], $this->success_code);
        }catch(\Throwable $e)
        {
             $this->logServices->createErrorLog("getProducts Function".$e->getMessage());
            return response()->json([
                'status_code' => $this->error_code,
                'status'      => $this->error,
                'message'     => 'Something went wrong',
            ], $this->error_code);
        }
    }
}
