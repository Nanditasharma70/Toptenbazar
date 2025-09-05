<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\CategorySubCategory;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;
use App\Models\UploadedFile;
use App\Models\Variation;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "ProductsController";

    #Bind ProductTags Model
    protected $subCat;

    #Bind File Upload 
    protected $fileUpload;

    #Bind Category Model
    protected $category;

    #Bind CategorySubCategory Model
    protected $catSubMod;

    #Bind Variation Model
    protected $variation;

    #Bind Products Tags model
    protected $productTag;

    #Bind Unit Model
    protected $unit;

    #Bind Product Model
    protected $product;

    public function __construct(LogServices $logServices, SubCategory $subCat,UploadedFile $fileUpload,
                                   Category $category,CategorySubCategory $catSubMod,
                                   Variation $variation,ProductTag $productTag,Unit $unit,Product $product)
    {
        $this->logServices = $logServices;
        $this->subCat      = $subCat;
        $this->fileUpload  = $fileUpload;
        $this->category    = $category;
        $this->catSubMod   = $catSubMod;
        $this->variation   = $variation;
        $this->productTag  = $productTag;
        $this->unit        = $unit;
        $this->product     = $product;
    }
    /**
     * @method helps to show index page of product
     * @param 
     * @return
     */
    public function index(Request $request)
    {
        try{
              $prod = $this->product->with('unit','category','subCat')->orderBy('id','DESC');
                if ($request->ajax()) {
                    return DataTables::of($prod)
                    ->addColumn('name', function($row) {
                        $fileUploadData = $this->fileUpload->where('product_id', $row->id)->first();
                        $imagePath = $fileUploadData ? asset($fileUploadData->path) : asset('assets/images/default.png'); // fallback
                        $name = $row->name ?? 'NA';
                        return '<div class="flex items-center gap-3">
                                    <img src="' . $imagePath . '" alt="Avatar" class="w-10 h-10 rounded-full object-cover" />
                                    <span>' . htmlspecialchars($name) . '</span>
                                </div>';
                        })
                        ->addColumn('action', function ($row) {
                                    return '
                                       <td class="px-4 py-3 text-center ">
                                        <div class="inline-flex gap-2 bg-red rounded-md  w-fit justify-center">
                                            <button type="button" class=" cursor-pointer  transition duration-200" onclick="openDeleteModal(\'' . $row->slug . '\')">
                                            
                                                <i class="fa-solid fa-trash-can text-white px-2 py-[7px]"></i>
                                            </button>
                                        </div>
                                    </td>';
                        })  
                        ->addColumn('unit',function($row){
                            return isset($row->unit->name) ? $row->unit->name : "NA";
                        })
                         ->addColumn('categ_id',function($row){
                           return '<td class="px-4 py-3">
                                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">'.(isset($row->category->name) ? $row->category->name : "NA").'</span>
                            </td>';
                        })
                         ->addColumn('subcat_id',function($row){
                              return '<td class="px-4 py-3">
                                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">'.(isset($row->subCat->name) ? $row->subCat->name : "NA").'</span>
                            </td>';
                        })
                        ->addColumn('code',function($row)
                        {
                            return isset($row->code) ? $row->code : "CODE";
                        })
                        ->editColumn('price',function($row)
                        {
                            return "₹ ". $row->price;
                        })
                        ->rawColumns(['unit','subcat_id','categ_id','action','code','name'])
                        ->make(true);
            }
            return view('admin.pages.products.index');
        }catch(\Throwable $e)
        {
             DB::rollBack();
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' index() function', 'top_ten_bazar');
           return response()->json([
                    'message' => 'An error occurred. Please try again later.',
                    'alert-type' => 'error',
                ], 500);
        }
    }
    /**
     * @method helps to store product 
     * @param 
     * @return view
     */
     public function store(AddProductRequest $request)
    {
        DB::beginTransaction();
        try{
            $productData = [
                'slug'            => str()->random(15),
                'code'            => $request->name . str()->random(3),
                'unit_id'         => $request->unit_id ?? '',
                'variation_id'    => $request->variation_id ?? '',
                'discount_amount' => $request->discount_amount ?? '',
                'discount_type'   => $request->discount_type ?? '',
                'tag_id'          => $request->product_tag_id ?? '',
                'price'           => $request->product_price ?? '',
                'subcat_id'       => $request->sub_category_id ?? '',
                'categ_id'        => $request->category_id ?? '',
                'name'            => $request->name ?? '',
                'description'     => $request->description ?? ''
            ];
            $productCreated = $this->product->create($productData);
            if(!$productCreated)
            {
                  return response()->json([
                    'message' => 'Product not created.',
                    'alert-type' => 'error',
                ], 500);
            }

             if ($request->has('images')) {
                foreach ($request->file('images') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $mimeType     = $file->getMimeType();
                    $filename     = str()->uuid() . '.' . $file->getClientOriginalExtension();
                    $path         = $file->storeAs('assets/product_file', $filename, 'customupload');

                    $fileUploadData = [
                        'path'          => $path,
                        'mime_type'     => $mimeType,
                        'original_name' => $originalName,
                        'file_name'     => $filename,
                        'product_id'     => $productCreated->id,
                        'user_id'       => Auth::user()->id
                    ];
                  $fileUploaded =  $this->fileUpload->create($fileUploadData);
                    if(!$fileUploaded)
                    {
                        return response()->json([
                            'message' => 'Image Not Uploaded.',
                            'alert-type' => 'error',
                        ], 500);
                    }
                }
            }
              $notification = [
                'message'    => $productCreated ? 'Product created successfully' : 'Something went wrong',
                'alert-type' => $productCreated ? 'success' : 'error'
            ];
            DB::commit();
            return response()->json($notification, ($productCreated ? 200 : 400));
        }catch(\Throwable $e)
        {
            DB::rollBack();
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' store() function', 'top_ten_bazar');
           return response()->json([
                    'message' => 'An error occurred. Please try again later.',
                    'alert-type' => 'error',
                ], 500);
        }
    }
    
    /**
     * @method helps to show create product view
     * @param 
     * @return view
     */
       public function create()
        {
            try{
                $categories  = $this->category->get();
                $subCats     = $this->subCat->get();
                $variations  = $this->variation->get();
                $productTags = $this->productTag->get();
                $units       = $this->unit->get();
                return view('admin.pages.products.add')->with([
                                                                'categories' => $categories,
                                                                'subCats'    => $subCats,
                                                                'variations' => $variations,
                                                                'units'      => $units,
                                                                'productTags'=> $productTags
                                                            ]);
            }catch(\Throwable $e)
            {
                 $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' create() function', 'top_ten_bazar');
                return response()->json([
                    'message' => 'An error occurred. Please try again later.',
                    'alert-type' => 'error',
                ], 500);
            }
        }
     public function edit($productSlug)
    {
        try{
            return view('admin.pages.products.edit');
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }
     public function update($productSlug)
    {
        try{
            dd("update");
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }

    /**
     * @method helps to delete product
     * @param productSlug
     * @return jsonResponse
     */
    public function deleteProduct($productSlug)
    {
        try{
             if (!$productSlug) {
                    return response()->json([
                        'message'    => 'Category slug not provided',
                        'alert-type' => 'error'
                    ], 400);
                }
                $prod = $this->product->where('slug', $productSlug)->first();
                if (!$prod) {
                    return response()->json([
                        'message'    => 'Product not found',
                        'alert-type' => 'error'
                    ], 404);
                }
                $uploadedFiles = $this->fileUpload->where('product_id', $prod->id)->get();
                foreach ($uploadedFiles as $file) {
                    if (Storage::disk('customupload')->exists($file->path)) {
                        Storage::disk('customupload')->delete($file->path);
                    }
                }
                $this->fileUpload->where('product_id', $prod->id)->delete();
                $productDeleted = $prod->delete();
                DB::commit();
                return response()->json([
                    'message'    => $productDeleted ? 'Product deleted successfully' : 'Failed to delete product',
                    'alert-type' => $productDeleted ? 'success' : 'error'
                ], 200);
                DB::commit();
        }catch(\Throwable $e)
        {
            DB::rollBack();
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' deleteProduct() function', 'top_ten_bazar');
                return response()->json([
                    'message' => 'An error occurred. Please try again later.',
                    'alert-type' => 'error',
                ], 500);
        }
    }
}
