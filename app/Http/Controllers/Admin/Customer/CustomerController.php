<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\UploadedFile;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CustomerController extends Controller
{
      #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "CustomerController";

    #Bind Coupon Model
    protected $customer;

    #Bind FileUpload Model
    protected $fileUpload;

    public function __construct(LogServices $logServices,UploadedFile $fileUpload,Customer $customer)
    {
        $this->logServices = $logServices;
        $this->fileUpload  = $fileUpload;
        $this->customer      = $customer;
    }
    public function index(Request $request)
    {
        try{
             $customer =  $this->customer->query();
            if($request->ajax())
            {
                return DataTables::of($customer)
                ->addColumn('action', function($row) {
                                    $checked = $row->status ? 'checked' : '';
                                        return '<div class="flex justify-center items-center w-full">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                   <input type="checkbox" '.$checked.' data-id="'.$row->slug.'" onchange="changeStatus(\''.$row->slug.'\')"
                                                class="sr-only peer">
                                                <div
                                                    class="w-10 h-5 bg-red-500 rounded-full peer-checked:bg-green-500 transition-colors duration-300">
                                                </div>
                                                <div
                                                    class="absolute left-[2px] top-[2px] h-4 w-4 bg-white border rounded-full 
                                                        transition-all duration-300 peer-checked:translate-x-5">
                                                </div>
                                            </label>
                                        </div>';
                                    })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('admin.pages.customers.index');
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

    public function changeCustomerStatus(Request $request)
    {
        try{
              $slug = $request->customerSlug;
            if(isset($slug))
            {
                $customer = $this->customer->where('slug', $slug)->first();
                if ($customer) {
                                $status = $customer->status == 0 ? 1 : 0;
                                $customer->update(['status' => $status]);
                                return response()->json(['success' => 'Customer status updated successfully','status' => true],200);
                                } else {
                                    return response()->json(['error' => 'Customer not found'],404);
                                }
            }
        }catch(\Throwable $e)
        {
           $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' changeCustomerStatus() function','top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return response()->json($notification,500);
        }
    }       
}
