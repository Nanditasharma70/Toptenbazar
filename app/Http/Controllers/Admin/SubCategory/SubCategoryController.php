<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSubCategoryRequest;
use App\Models\Category;
use App\Models\CategorySubCategory;
use App\Models\SubCategory;
use App\Models\UploadedFile;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Str;

class SubCategoryController extends Controller
{
    #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "SubCategoryController";

    #Bind ProductTags Model
    protected $subCat;

    #Bind File Upload 
    protected $fileUpload;

    #Bind Category Model
    protected $category;

    #Bind CategorySubCategory Model
    protected $catSubMod;

    public function __construct(LogServices $logServices, SubCategory $subCat,UploadedFile $fileUpload,Category $category,CategorySubCategory $catSubMod)
    {
        $this->logServices = $logServices;
        $this->subCat      = $subCat;
        $this->fileUpload  = $fileUpload;
        $this->category    = $category;
        $this->catSubMod   = $catSubMod;
    }
    public function index(Request $request)
    {
        try {
            $subCateg = $this->subCat->query()->orderBy('id','DESC');
                if ($request->ajax()) {
                    return DataTables::of($subCateg)
                    ->addColumn('image',function($row){
                      $fileUploadData = UploadedFile::where('subcat_id', $row->id)->first();
                        return ' <td class="px-4 py-3">
                                <a href="javascript:void(0);" onclick="openImageModal(\'' . asset($fileUploadData->path) . '\')" class="text-blue-600 hover:underline">View</a>
                                    </td>';
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
                        ->rawColumns(['action','image'])
                        ->make(true);
            }
            return view('admin.pages.subCategory.index');
        } catch (\Throwable $e) {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' index() function', 'top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
    /** 
     * @method 
     * @param
     * @return jsonResponse
     */
    public function store(AddSubCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'slug'   => str()->random(14),
                'name'   => $request->sub_cat_name ?? '',
                'description' => $request->description ?? '',
            ];
            $subCatCreated =  $this->subCat->create($data);
            // $data = [
            //             'category_id'     => $request->category_id,
            //             'sub_category_id' => $subCatCreated->id
            //         ];
            // $this->catSubMod->create($data);
             if ($request->has('images')) {
                foreach ($request->file('images') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $mimeType     = $file->getMimeType();
                    $filename     = str()->uuid() . '.' . $file->getClientOriginalExtension();
                    $path         = $file->storeAs('assets/subcat_file', $filename, 'customupload');

                    $fileUploadData = [
                        'path'          => $path,
                        'mime_type'     => $mimeType,
                        'original_name' => $originalName,
                        'file_name'     => $filename,
                        'subcat_id'     => $subCatCreated->id,
                        'user_id'       => Auth::user()->id
                    ];
                   $this->fileUpload->create($fileUploadData);
                }
            }
            $notification = [
                'message'    => $subCatCreated ? 'Sub Category created successfully' : 'Something went wrong',
                'alert-type' => $subCatCreated ? 'success' : 'error'
            ];
            DB::commit();
             return response()->json($notification, ($subCatCreated ? 200 : 400));
        } catch (\Throwable $e) {
            DB::rollBack();
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' store() function', 'top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
    

    /**
     * @method helps to delete unit
     * @param unitSlugS
     * @return jsonResposnse
     */
    public function deleteSubCat($subCatSlug)
    {
        DB::beginTransaction();
        try {
            if (!$subCatSlug) {
                return redirect()->back()->with([
                    'message'    => 'Sub Category slug not found',
                    'alert-type' => 'error'
                ], 404);
            }
            $subCat = $this->subCat->firstWhere('slug',$subCatSlug); 
            // $this->fileUpload->where('id',$subCat->id)->delete();
            $subCatDeleted =  $this->subCat->whereSlug($subCatSlug)->delete();


            $notification = [
                'message'    => $subCatDeleted ? 'Sub Category deleted successfully' : 'Something went wrong',
                'alert-type' => $subCatDeleted ? 'success' : 'error'
            ];
            DB::commit();
            return response()->json($notification, 200);
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
    public function create()
    {
        try {
            $category = $this->category->get();
            return view('admin.pages.subCategory.add')->with(['categories' => $category]);
        } catch (\Throwable $e) {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' create() function', 'top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
}
