<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use App\Models\UploadedFile;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class CouponController extends Controller
{
     #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "CouponController";

    #Bind Coupon Model
    protected $coupon;

    #Bind FileUpload Model
    protected $fileUpload;

    public function __construct(LogServices $logServices,UploadedFile $fileUpload,Coupon $coupon)
    {
        $this->logServices = $logServices;
        $this->fileUpload  = $fileUpload;
        $this->coupon      = $coupon;
    }
    //
    public function index(Request $request)
    {
        try{
            $coupons = $this->coupon->query();
            if($request->ajax())
            {
                   return DataTables::of($coupons)
                        ->addColumn('action', function ($row) {
                                    return '<div class="border border-gray-400 rounded-md  flex justify-center w-[80px]" style="cursor:pointer">
                                        <a href="'. route('coupon.edit',$row->slug) .'"
                                            class="text-blue-500 border-r border-gray-400 hover:text-blue-700  hover:border-blue-700  p-1 ">
                                            <img src="'. asset('assets/images/edit.png') .'" alt="Edit"
                                                class="object-contain pr-2">
                                        </a>

                                       
                                        <button onclick="openDeleteModal(\'' . $row->slug . '\')"
                                            class="text-red-500 hover:text-red-700  hover:border-red-700 rounded p-1 pl-2">
                                            <img src="'. asset('assets/images/delete.png') .'" alt="Delete"
                                                class="object-contain">
                                        </button>
                                    </div>';
                        })  
                        ->addColumn('product_id',function($row){
                            return isset($row->product_id) ? $row->product_id : "---";
                        })
                         ->addColumn('status',function($row){
                            return isset($row->status) && $row->status == 0 ? "In-Active" : "Active";
                        })
                         ->addColumn('coupon_type',function($row){
                            return isset($row->coupon_type) && $row->coupon_type == 0 ? "Discount" : "Free Piece";
                        })

                        ->rawColumns(['action','product_id','status','coupon_type'])
                        ->make(true);
            }
            return view('admin.pages.coupons.index');
        }catch(\Throwable $e)
        {
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
        return view('admin.pages.coupons.add');
    }
    public function edit($cSlug)
    {
        try{
            $coupon = $this->coupon->firstWhere('slug',$cSlug);
            if(!$coupon)
            {
                $notification = [
                    'message'    => 'Coupon not found.',
                    'alert-type' => 'error'
                ];
                return response()->json($notification,500);
            }
            return view('admin.pages.coupons.edit')->with(['coupon' => $coupon]);
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

    public function store(AddCouponRequest $request)
    {
        try{
               $data = [
                'slug'            => str()->random(14),
                'coupon_name'     => $request->name ?? '',
                'coupon_code'     => $request->code ?? '',
                'coupon_type'      => $request->coupon_type ?? '',
                'min_order_amount' => $request->min_order_amount ?? '',
                'capping'          => $request->capping ?? '',
                'status'           => $request->status ?? '',
                'created_by'       => Auth::user()->id
            ];
            $couponCreated =  $this->coupon->create($data);
            if(!$couponCreated)
            {
                $notification = [
                    'message' => 'Coupon not Created',
                    'alert-type' => "error",
                ];
                return response()->json([$notification],500);
            }
            $notification = [
                'message'    => $couponCreated ? 'Coupon created successfully' : 'Something went wrong',
                'alert-type' => $couponCreated ? 'success' : 'error'
            ];
             return response()->json($notification, ($couponCreated ? 200 : 400));
        }catch(\Throwable $e)
        {
              $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' store() function', 'top_ten_bazar');
            return response()->json([
                'message' => 'An error occurred. Please try again later.',
                'alert-type' => 'error',
            ], 500);
        }
    }

    public function update($cSlug,UpdateCouponRequest $request)
    {
        try{
            $coupon = $this->coupon->firstWhere('slug',$cSlug);
            if(!$coupon)
            {
                $notification = [
                    'message'    => 'Coupon not found.',
                    'alert-type' => 'error'
                ];
                return response()->json($notification,500);
            }
            $updateData = [
                'coupon_name'     => $request->name ?? $coupon->coupon_name,
                'coupon_code'     => $request->code ?? $coupon->coupon_code,
                'coupon_type'      => $request->coupon_type ?? $coupon->coupon_type,
                'min_order_amount' => $request->min_order_amount ?? $coupon->min_order_amount,
                'capping'          => $request->capping ?? $coupon->capping,
                'status'           => $request->status ?? $coupon->status,
                'updated_by'       => Auth::user()->id
            ];
            $couponUpdated = $coupon->update($updateData);
            if(!$couponUpdated)
            {
                $notification = [
                    'message'    => 'Coupon not updated.',
                    'alert-type' => 'error'
                ];
                return response()->json($notification,500);
            }
            $notification = [
                'message'    => $couponUpdated ? 'Coupon updated successfully' : 'Something went wrong',
                'alert-type' => $couponUpdated ? 'success' : 'error'
            ];
             return response()->json($notification, ($couponUpdated ? 200 : 400));
        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' update() function', 'top_ten_bazar');
            return response()->json([
                'message' => 'An error occurred. Please try again later.',
                'alert-type' => 'error',
            ], 500);
        }
    }
     public function delete($cSlug)
    {
         try{
            $coupon = $this->coupon->firstWhere('slug', $cSlug);
            if (!$coupon) {
                return response()->json([
                    'message' => 'Coupon not found.',
                    'alert-type' => 'error',
                ], 404);
            }
            $deleted = $coupon->delete();
            $notification = [
                'message' => $deleted ? 'Coupon deleted successfully' : 'Something went wrong',
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
