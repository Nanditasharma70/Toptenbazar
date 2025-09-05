<?php

namespace App\Http\Controllers\Admin\ChargeConfig;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddChargeConfigRequest;
use App\Models\ChargeConfig;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ChargeConfigController extends Controller
{
    #Bind LogServices
    protected $logServices;

    #Bind Charge Config Model
    protected $chargeConfig;

    #controller name
    protected $controller = "ChargeConfigController";

    public function __construct(LogServices $logServices,ChargeConfig $chargeConfig)
    {
        $this->logServices  = $logServices;
        $this->chargeConfig = $chargeConfig;
    }
    public function index(Request $request)
    {
        try{
            $chargeConfig = $this->chargeConfig->query()->orderBy('id','DESC');
            if($request->ajax())
            {
             return DataTables::of($chargeConfig)
                                ->addColumn('is_default', function ($row) {
                                    return isset($row->is_default) && $row->is_default == 0 ? "No" : "Yes";
                                })
                                ->addColumn('status', function ($row) {
                                    return isset($row->status) && $row->status == 0 ? "Inactive" : "Active";
                                })
                                ->addColumn('action',function($row){
                                    return '<div class="flex flex-nowrap gap-2">
                                                <button
                                                    class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-1 rounded text-xs whitespace-nowrap">
                                                    View
                                                </button>
                                                <a href="'. route('charge.testconfig') .'"
                                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs whitespace-nowrap">
                                                    Set Charge
                                                </a>
                                                <button
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs whitespace-nowrap">
                                                    Copy
                                                </button>
                                                <button
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs whitespace-nowrap">
                                                    Delete
                                                </button>
                                            </div>';
                                })
                             ->filter(function ($query) use ($request) {
                                    if (!empty($request->search['value'])) {
                                        $searchValue = strtolower(trim($request->search['value']));
                                        $query->where(function ($q) use ($searchValue) {
                                            if (in_array($searchValue, ['no', 'n'])) {
                                                $q->where('is_default', 0);
                                            }
                                            elseif (in_array($searchValue, ['yes', 'ye', 'y'])) {
                                                $q->where('is_default', 1);
                                            }
                                            elseif (in_array($searchValue, ['in', 'inactive'])) {
                                                $q->where('status', 0);
                                            }
                                            elseif (in_array($searchValue, ['act', 'active'])) {
                                                $q->where('status', 1);
                                            }
                                            else {
                                                $q->where('name', 'like', "%{$searchValue}%")
                                                ->orWhere('slug', 'like', "%{$searchValue}%");
                                            }
                                        });
                                    }
                                })
                                ->rawColumns(['is_default', 'status','action'])
                                ->make(true);
            }
           return view('admin.pages.chargeConfig.index');
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
    public function create()
    {
        return view('admin.pages.chargeConfig.add');
    }
     public function store(AddChargeConfigRequest $request)
    {
        try{
            $data = [
                'slug' => str()->random(15),
                'name' => $request->name ??'',
                'is_default' => isset($request->is_default) ? 1 : 0,
                'status'    => $request->status ?? 1
            ];
            $chargeConfigCreated =   $this->chargeConfig->create($data);
             $notification = [
                'message'    => $chargeConfigCreated ? 'Charge Config created successfully' : 'Something went wrong',
                'alert-type' => $chargeConfigCreated ? 'success' : 'error'
            ];
             return response()->json($notification, ($chargeConfigCreated ? 200 : 400));
        }catch(\Throwable $e){
            $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' store() function','top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function testConfig()
    {
        return view('admin.pages.chargeConfig.testconfig');
    }
    public function setChargeConfig()
    {
        return view('admin.pages.chargeConfig.setChargeConfig');
    }
}
