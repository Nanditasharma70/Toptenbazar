<?php

namespace App\Http\Controllers\Admin\ImageConfig;

use App\Http\Controllers\Controller;
use App\Models\ImageConfig;
use App\Models\UploadedFile;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ImageConfigController extends Controller
{
       #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "ImageConfigController";

    #Bind File Upload 
    protected $fileUpload;

    #Bind image config Model
    protected $imageConfig;


    public function __construct(LogServices $logServices,UploadedFile $fileUpload,ImageConfig $imageConfig)
    {
        $this->logServices = $logServices;
        $this->imageConfig = $imageConfig;
        $this->fileUpload = $fileUpload;
    }
    public function imageConfig(Request $request)
    {
        try{
           $imageConfig =  $this->imageConfig->query()->orderBy('id','desc');
           if($request->ajax())
           {
                return DataTables::of($imageConfig)
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
                ->rawColumns(['action'])
                ->make(true);
           }
            return view('admin.pages.imageConfig.index');
        }catch(\Throwable $e)
        {
             $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' index() function', 'top_ten_bazar');
                return response()->json([
                    'message' => 'An error occurred. Please try again later.',
                    'alert-type' => 'error',
                ], 500);
        }
    }

    public function delete($imgSlug)
    {
        try {
            if(!$imgSlug)
            {
                return response()->json([
                    'message' => 'Invalid image config.',
                    'alert-type' => 'error',
                ], 400);
            }
            $imageConfig = $this->imageConfig->where('slug', $imgSlug)->firstOrFail();
            $imageConfig->delete();
            return response()->json([
                'message' => 'Image config deleted successfully.',
                'alert-type' => 'success',
            ]);
        } catch (\Throwable $e) {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' delete() function', 'top_ten_bazar');
            return response()->json([
                'message' => 'An error occurred. Please try again later.',
                'alert-type' => 'error',
            ], 500);
        }
    }
}
