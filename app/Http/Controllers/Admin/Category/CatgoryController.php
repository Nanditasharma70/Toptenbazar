<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use App\Models\CategorySubCategory;
use App\Models\SubCategory;
use App\Models\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CatgoryController extends Controller
{
    #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "CatgoryController";

    #Bind Sub Category Model
    protected $subCat;

    #Bind Category Controller
    protected $category;

    #Bind FileUpload Model
    protected $fileUpload;

    #Bind CategorySubCategory Model
    protected $catSubMod;

    public function __construct(LogServices $logServices,SubCategory $subCat,Category $category,UploadedFile $fileUpload,CategorySubCategory $catSubMod)
    {
        $this->logServices = $logServices;
        $this->subCat      = $subCat;
        $this->category    = $category;
        $this->fileUpload  = $fileUpload;
        $this->catSubMod   = $catSubMod;
    }
    /**
     * @method index
     * @param 
     * @return
     */
    public function index(Request $request)
    {
        try{
              $categories = $this->category->query()->orderBy('id', 'DESC');

if ($request->ajax()) {
    return DataTables::of($categories)
                ->addColumn('name', function($row) {
                    $fileUploadData = $this->fileUpload->where('cat_id', $row->id)->first();
                    $imagePath = $fileUploadData ? asset($fileUploadData->path) : asset('assets/images/default.png'); // fallback

                    $name = $row->name ?? 'NA';

                    return '<div class="flex items-center gap-3">
                                <img src="' . $imagePath . '" alt="Avatar" class="w-10 h-10 rounded-full object-cover" />
                                <span>' . htmlspecialchars($name) . '</span>
                            </div>';
                })

                ->addColumn('sub_cat', function($row) {
                    $subCatMo = $this->catSubMod->where('category_id', $row->id)->with('subCategory')->get();
                    $firstTwoSubCatArray = [];
                    $restSubCatArray = [];
                    $count = 1;
                    $i = 1;

                    foreach ($subCatMo as $item) {
                        if ($i <= $count) {
                            $firstTwoSubCatArray[] = $item->subCategory->name ?? '';
                        } else {
                            $restSubCatArray[] = $item->subCategory->name ?? '';
                        }
                        $i++;
                    }

                    $html = '<div class="flex items-center gap-2 flex-wrap">';
                    foreach ($firstTwoSubCatArray as $item) {
                        $html .= '<button class="bg-gray-200 text-black rounded-full px-4 py-1 text-sm hover:bg-gray-300 transition">'
                            . htmlspecialchars($item) .
                            '</button>';
                    }

                    if (count($restSubCatArray) >= $count) {
                        $html .= '<a href="javascript:void(0);" onclick=\'openModal(' . json_encode($restSubCatArray) . ')\' class="text-blue-500 hover:underline text-sm">View More</a>';
                    }

                    $html .= '</div>';

                    return $html;
                })
                ->editColumn('status', function($row) {
                                    $checked = $row->status ? 'checked' : '';
                                    return '
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" '.$checked.' data-id="'.$row->slug.'" onchange="changeStatus(\''.$row->slug.'\')"
                                                class="sr-only peer status">
                                            <div class="w-10 h-5 bg-gray-200 rounded-full peer-checked:bg-green-500 relative 
                                                after:content-[\'\'] after:absolute after:top-[2px] after:left-[2px] after:bg-white 
                                                after:border after:rounded-full after:h-4 after:w-4 after:transition-all 
                                                peer-checked:after:translate-x-5">
                                            </div>
                                        </label>';
                                    })
                ->addColumn('action', function($row) {
                    return '
                        <td class="px-4 py-3 text-center ">
                                        <div class="inline-flex gap-2 bg-red rounded-md  w-fit justify-center">
                                            <button type="button" class=" cursor-pointer  transition duration-200" onclick="openDeleteModal(\'' . $row->slug . '\')">
                                            
                                                <i class="fa-solid fa-trash-can text-white px-2 py-[7px]"></i>
                                            </button>
                                        </div>
                                    </td>';
                })

                ->rawColumns(['action', 'name', 'sub_cat','status'])
                ->make(true);
            }
            return view('admin.pages.categories.index');
        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' index() function','top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
     public function store(AddCategoryRequest $request)
    {
        DB::beginTransaction();
        try{
               $data = [
                'slug'                    => str()->random(14),
                'name'                    => $request->name ?? '',
                'description'             => $request->description ?? '',
                'sorting_priority_number' => $request->sorting_p_num ?? '',
            ];
            $catCreated =  $this->category->create($data);
            $subCategoryIds = $request->sub_cat ?? [];
            if(isset($subCategoryIds) && sizeof($subCategoryIds) > 0)
            {
                foreach($subCategoryIds as $item)
                {
                   $subCats =  $this->subCat->firstWhere('slug',$item);
                    $data = [
                        'category_id'     => $catCreated->id,
                        'sub_category_id' => $subCats->id
                    ];
                    $this->catSubMod->create($data);
                }
            }
             if ($request->has('images')) {
                foreach ($request->file('images') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $mimeType     = $file->getMimeType();
                    $filename     = str()->uuid() . '.' . $file->getClientOriginalExtension();
                    $path         = $file->storeAs('assets/cat_file', $filename, 'customupload');

                    $fileUploadData = [
                        'path'          => $path,
                        'mime_type'     => $mimeType,
                        'original_name' => $originalName,
                        'file_name'     => $filename,
                        'cat_id'        => $catCreated->id,
                        'user_id'       => Auth::user()->id
                    ];
                   $this->fileUpload->create($fileUploadData);
                }
            }
            $notification = [
                'message'    => $catCreated ? 'Category created successfully' : 'Something went wrong',
                'alert-type' => $catCreated ? 'success' : 'error'
            ];
            DB::commit();
             return response()->json($notification, ($catCreated ? 200 : 400));
           
        }catch(\Throwable $e)
        {
            DB::rollback();
              $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' store() function','top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
      public function create()
    {
        try{
            $subCats = $this->subCat->get();
            return view('admin.pages.categories.add')->with(['subCats' => $subCats]);;
        }catch(\Throwable $e)
        {
              $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' create() function','top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
     public function edit($categorySlug)
    {
        try{
            return view('admin.pages.categories.edit');
        }catch(\Throwable $e)
        {
              $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' edit() function','top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
     public function update($categorySlug)
    {
        try{
            dd("update");
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }

     /**
     * @method helps to delete unit
     * @param unitSlugS
     * @return jsonResposnse
     */
    public function deleteCategory($catSlug)
    {
        DB::beginTransaction();
        try {
              if (!$catSlug) {
                    return response()->json([
                        'message'    => 'Category slug not provided',
                        'alert-type' => 'error'
                    ], 400);
                }
                $cate = $this->category->where('slug', $catSlug)->first();
                if (!$cate) {
                    return response()->json([
                        'message'    => 'Category not found',
                        'alert-type' => 'error'
                    ], 404);
                }
                $this->catSubMod->where('category_id', $cate->id)->delete();
                $uploadedFiles = $this->fileUpload->where('cat_id', $cate->id)->get();
                foreach ($uploadedFiles as $file) {
                    if (Storage::disk('customupload')->exists($file->path)) {
                        Storage::disk('customupload')->delete($file->path);
                    }
                }
                $this->fileUpload->where('cat_id', $cate->id)->delete();
                $categoryDeleted = $cate->delete();
                DB::commit();
                return response()->json([
                    'message'    => $categoryDeleted ? 'Category deleted successfully' : 'Failed to delete category',
                    'alert-type' => $categoryDeleted ? 'success' : 'error'
                ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' deleteSubCat() function', 'top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function makeFaourite(Request $request)
    {
        try{
             $slug = $request->categorySlug;
            if(isset($slug))
            {
                $category = $this->category->where('slug', $slug)->first();
                if ($category) {
                                $status = $category->status == 0 ? 1 : 0;
                                $category->update(['status' => $status]);
                                return response()->json(['success' => 'Favourite status updated successfully','status' => true],200);
                                } else {
                                    return response()->json(['error' => 'Category not found'],404);
                                }
            }

        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' makeFaourite() function', 'top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
}
