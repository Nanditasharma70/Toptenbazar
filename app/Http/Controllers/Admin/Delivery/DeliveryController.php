<?php

namespace App\Http\Controllers\Admin\Delivery;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddDeliveryManRequest;
use App\Http\Requests\UpdateDeliveryMenRequest;
use App\Models\DeliveryMan;
use App\Models\UploadedFile;
use App\Models\User;
use App\Services\FileService;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class DeliveryController extends Controller
{
      #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "DeliveryController";

    #Bind File Upload 
    protected $fileUpload;

    #Bind DElivery Model
    protected $delivery;

    #Bind File Services
    protected $fileServices;

    #Bind User Model
    protected $user;

    public function __construct(LogServices $logServices,UploadedFile $fileUpload,DeliveryMan $delivery,FileService $fileServices,User $user)
    {
        $this->logServices = $logServices;
        $this->delivery    = $delivery;
        $this->fileUpload  = $fileUpload;
        $this->fileServices = $fileServices;
        $this->user         = $user;
    }
    public function index(Request $request)
    {
         try{
              $deliv = $this->delivery->orderBy('id','DESC');
                if ($request->ajax()) {
                    return DataTables::of($deliv)
                    ->addColumn('name', function($row) {
                        $fileUploadData = $this->fileUpload->where('delivery_man_id', $row->id)->first();
                        $imagePath = $fileUploadData ? asset($fileUploadData->path) : asset('assets/images/default.png'); 
                        $name = $row->name ?? 'NA';
                        return '<div class="flex items-center gap-3">
                                    <img src="' . $imagePath . '" alt="Avatar" class="w-10 h-10 rounded-full object-cover" />
                                    <span>' . htmlspecialchars($name) . '</span>
                                </div>';
                        })
                        ->addColumn('action', function ($row) {
                                    
                                     return '<div class="border border-gray-400 rounded-md  flex justify-center w-[80px]" style="cursor:pointer">
                                        <a href="'. route('delivery-man.edit',$row->slug) .'"
                                            class="text-blue-500 border-r border-gray-400 hover:text-blue-700  hover:border-blue-700  p-1 ">
                                            <img src="'. asset('assets/images/edit.png') .'" alt="Edit"
                                                class="object-contain pr-2">
                                        </a>

                                       
                                        <button onclick="openDeleteModal(\'' . $row->slug . '\')"
                                            class="text-red-500 hover:text-red-700  hover:border-red-700 rounded p-1 pl-2 cursor-pointer">
                                            <img src="'. asset('assets/images/delete.png') .'" alt="Delete"
                                                class="object-contain">
                                        </button>
                                    </div>';
                        })  
                        ->rawColumns(['action','name'])
                        ->make(true);
            }

             return view('admin.pages.deliveryman.index');
        }catch(\Throwable $e)
        {
             $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' index() function', 'top_ten_bazar');
                return response()->json([
                    'message' => 'An error occurred. Please try again later.',
                    'alert-type' => 'error',
                ], 500);
        }
    }
    /**
     * @method helps to store deloveryman
     * @param request
     * @return jsonResponse
     */
       public function store(AddDeliveryManRequest $request)
    {
        DB::beginTransaction();
        try{
            $data = [
                'slug'     => str()->random(15),
                'name'     => $request->name ?? "",
                'email'    => $request->email ?? "",
                'role_id'  => 2 ?? "",
                'password' => Hash::make($request->password) ?? Hash::make('123456'),
                'mobile'   => $request->mobile ?? '',
            ];
            $asUserData = [
                'slug'    => $data['slug'],
                'status'   => 1,
                'password' => $data['password'],
                'email'    => $data['email'],
                'name'     => $data['name'],
                'role_id'  => $data['role_id']
            ];
           $deliveryManCreated =  $this->delivery->create($data);
           $asUserCreated      = $this->user->create($asUserData);
              if(!$deliveryManCreated || !$asUserCreated)
            {
                  return response()->json([
                    'message' => 'Delvery Man not created.',
                    'alert-type' => 'error',
                ], 500);
            }

             if ($request->has('images')) {
                foreach ($request->file('images') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $mimeType     = $file->getMimeType();
                    $filename     = str()->uuid() . '.' . $file->getClientOriginalExtension();
                    $path         = $file->storeAs('assets/deliveryMan', $filename, 'customupload');

                    $fileUploadData = [
                        'path'          => $path,
                        'mime_type'     => $mimeType,
                        'original_name' => $originalName,
                        'file_name'     => $filename,
                        'delivery_man_id' => $deliveryManCreated->id,
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
                'message'    => $deliveryManCreated ? 'Delivery Man created successfully' : 'Something went wrong',
                'alert-type' => $deliveryManCreated ? 'success' : 'error'
            ];
            DB::commit();
            return response()->json($notification, ($deliveryManCreated ? 200 : 400));      
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
      public function create()
    {
        try{
            return view('admin.pages.deliveryman.add');
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }
     public function edit($deliveryManSlug)
    {
        try{
            if(!$deliveryManSlug)
            {
                   return response()->json([
                    'message' => 'Slug not found.',
                    'alert-type' => 'error',
                ], 500);
            }
            $deliveryMan = $this->delivery->firstWhere('slug',$deliveryManSlug);
             if(!$deliveryMan)
            {
                   return response()->json([
                    'message' => 'Delivery Man not found.',
                    'alert-type' => 'error',
                ], 500);
            }
           $image =  $this->fileUpload->firstWhere('delivery_man_id',$deliveryMan->id);
           $avtar = isset($image) ? $image->path : "";
            return view('admin.pages.deliveryman.edit')->with(['deliveryMan' => $deliveryMan,'avtar' => $avtar]);
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }
     public function update(UpdateDeliveryMenRequest $request,$deliveryManSlug)
    {
         DB::beginTransaction();
        try{
            $deliveryMen = $this->delivery->firstWhere('slug',$deliveryManSlug);
                if(!$deliveryMen)
                {
                    $notification = [
                            'message' => 'Delivery Man not found.',
                            'alert-type' => 'error',
                    ];
                    return response()->json($notification, 404);
                }
              $data = [
                'name'     => $request->name ?? $deliveryMen->name,
                'email'    => $request->email ?? $deliveryMen->email,
                'role_id'  => 2 ?? $deliveryMen->role_id,
                'password' => Hash::make($request->password) ?? $deliveryMen->password,
                'mobile'   => $request->mobile ?? $deliveryMen->mobile,
            ];
            $deliveryMenUpdated = $deliveryMen->update($data);
            if ($request->has('images')) {
               $existingFile =  $this->fileUpload->where('delivery_man_id', $deliveryMen->id)->get();
          
               $imageDeleted = $this->fileServices->deleteExistingImage($existingFile);
               if($imageDeleted)
               {
                    $this->fileUpload->where('delivery_man_id', $deliveryMen->id)->delete();
               }else{
                    return response()->json([
                        'message' => 'Image not deleted.',
                        'alert-type' => 'error',
                    ], 500);
               }
                   foreach ($request->file('images') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $mimeType     = $file->getMimeType();
                    $filename     = str()->uuid() . '.' . $file->getClientOriginalExtension();
                    $path         = $file->storeAs('assets/deliveryMan', $filename, 'customupload');

                    $fileUploadData = [
                        'path'          => $path,
                        'mime_type'     => $mimeType,
                        'original_name' => $originalName,
                        'file_name'     => $filename,
                        'delivery_man_id' => $deliveryMen->id,
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
                'message'    => $deliveryMenUpdated ? 'Delivery Man updated successfully' : 'Something went wrong',
                'alert-type' => $deliveryMenUpdated ? 'success' : 'error'
            ];
            DB::commit();
            return response()->json($notification, ($deliveryMenUpdated ? 200 : 400));
        }catch(\Throwable $e)
        {
            DB::rollBack();
              $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' update() function', 'top_ten_bazar');
                return response()->json([
                    'message' => 'An error occurred. Please try again later.',
                    'alert-type' => 'error',
                ], 500);
        }
    }

    public function delete($deliveryManSlug)
    {
        try{
            $deliveryMan = $this->delivery->firstWhere('slug', $deliveryManSlug);
            if (!$deliveryMan) {
                return response()->json([
                    'message' => 'Delivery Man not found.',
                    'alert-type' => 'error',
                ], 404);
            }
             $existingFile =  $this->fileUpload->where('delivery_man_id', $deliveryMan->id)->get();
               $imageDeleted = $this->fileServices->deleteExistingImage($existingFile);
               if($imageDeleted)
               {
                    $this->fileUpload->where('delivery_man_id', $deliveryMan->id)->delete();
               }else{
                    return response()->json([
                        'message' => 'Image not deleted.',
                        'alert-type' => 'error',
                    ], 500);
               }
            $deleted = $deliveryMan->delete();
            $notification = [
                'message' => $deleted ? 'Delivery Man deleted successfully' : 'Something went wrong',
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

