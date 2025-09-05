<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBannerConfigRquest;
use App\Models\BannerConfig;
use App\Models\UploadedFile;
use App\Services\FileService;
use App\Services\LogServices;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Auth;

class BannerConfigController extends Controller
{
     #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "BannerConfigController";

    #Bind FileUpload Model
    protected $fileUpload;

    #Bind Banner Config Model
    protected $bannerConfig;

    #Bind FileService
    protected $fileServices;

    public function __construct(LogServices $logServices,UploadedFile $fileUpload,BannerConfig $bannerConfig,FileService $fileServices)
    {
        $this->logServices = $logServices;
        $this->fileUpload  = $fileUpload;
        $this->bannerConfig = $bannerConfig;
        $this->fileServices = $fileServices;
    }
    //
    public function index(Request $request)
    {
        $bannerConfig = $this->bannerConfig->query();
        if($request->ajax())
        {   
           return DataTables::of($bannerConfig)
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
              ->addColumn('image', function($row) {
                    $fileUploadData = $this->fileUpload->where('banner_config_id', $row->id)->first();
                    $imagePath = $fileUploadData ? asset($fileUploadData->path) : asset('assets/images/default.png'); // fallback
                   return ' <td class="px-4 py-3">
                                <a href="javascript:void(0);" onclick="openImageModal(\'' . asset($imagePath) . '\')" class="text-blue-600 hover:underline">View</a>
                                    </td>';
                            })
           
                ->rawColumns(['action','image'])
               ->make(true);
        }
        return view('admin.pages.bannerConfig.index');
    }
    public function create()
    {
        return view('admin.pages.bannerConfig.add');
    }

    public function store(AddBannerConfigRquest $request)
    {
        try{
            $data = [
                'slug' => str()->random(15),
                'name' => $request->name,
            ];

            $banner = $this->bannerConfig->create($data);

              if ($request->has('images')) {
                foreach ($request->file('images') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $mimeType     = $file->getMimeType();
                    $filename     = str()->uuid() . '.' . $file->getClientOriginalExtension();
                    $path         = $file->storeAs('assets/banner_config', $filename, 'customupload');

                    $fileUploadData = [
                        'path'          => $path,
                        'mime_type'     => $mimeType,
                        'original_name' => $originalName,
                        'file_name'     => $filename,
                        'banner_config_id'  => $banner->id,
                        'user_id'       => Auth::user()->id
                    ];
                   $this->fileUpload->create($fileUploadData);
                }
            }
             $notification = [
                'message'    => $banner ? 'Banner created successfully' : 'Something went wrong',
                'alert-type' => $banner ? 'success' : 'error'
            ];
    
             return response()->json($notification, ($banner ? 200 : 400));

        }catch(\Exception $e)
        {
                  $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' deleteSubCat() function', 'top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function delete($bSlug)
    {
         try{
            $banner = $this->bannerConfig->firstWhere('slug', $bSlug);
            if (!$banner) {
                return response()->json([
                    'message' => 'Delivery Man not found.',
                    'alert-type' => 'error',
                ], 404);
            }
             $existingFile =  $this->fileUpload->where('banner_config_id', $banner->id)->get();
               $imageDeleted = $this->fileServices->deleteExistingImage($existingFile);
               if($imageDeleted)
               {
                    $this->fileUpload->where('banner_config_id', $banner->id)->delete();
               }else{
                    return response()->json([
                        'message' => 'Image not deleted.',
                        'alert-type' => 'error',
                    ], 500);
               }
            $deleted = $banner->delete();
            $notification = [
                'message' => $deleted ? 'Banner deleted successfully' : 'Something went wrong',
                'alert-type' => $deleted ? 'success' : 'error'
            ];
            return response()->json($notification, ($deleted ? 200 : 400));
        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' delete() function', 'top_ten_bazar');
            return response()->json([
                'message' => 'An error occurred. Please try again later.',
                'alert-type' => 'error',
            ], 500);
        }
    }
}