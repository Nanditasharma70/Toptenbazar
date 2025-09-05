<?php

namespace App\Http\Controllers\Admin\Unit;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddUnitRequest;
use App\Models\Unit;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "UnitController";

    #Bind Unit Model
    protected $unit;

    public function __construct(LogServices $logServices,Unit $unit)
    {
        $this->logServices = $logServices;
        $this->unit        = $unit;
    }
    public function index(Request $request)
    {
        try{
                if(isset($request->statusVal))
                {
                    $unit = $this->unit->where('status',$request->statusVal);
                }else{
                    $unit = $this->unit->query();
                }
                if ($request->ajax()) {
                    return DataTables::of($unit)
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
                        ->rawColumns(['status','action'])
                        ->make(true);
            }
            return view('admin.pages.units.index');
        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' index() function', 'top_ten_bazar');
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
                return view('admin.pages.units.add');
            } catch (\Throwable $e) {
                $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' create() function','top_ten_bazar');
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
    public function store(AddUnitRequest $request)
    {
       try{
            $data = [
                'slug'   => str()->random(14),
                'name'   => $request->unit_name ?? '',
                'status' => 1
            ];
           $unitCreated =  $this->unit->create($data);
           $notification = [
                'message'    => $unitCreated ? 'Unit created successfully' : 'Something went wrong',
                'alert-type' => $unitCreated ? 'success' : 'error'
            ];
            return redirect()->back()->with($notification, $unitCreated ? 200 : 400);
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
    /**
     * @method helps to change status
     * @param
     * @return jsonResponse
     */
    public function changeUnitStatus(Request $request)
    {
         try{
            $slug = $request->unitSlug;
            if(isset($slug))
            {
                $unit = $this->unit->where('slug', $slug)->first();
                if ($unit) {
                                $status = $unit->status == 0 ? 1 : 0;
                                $unit->update(['status' => $status]);
                                return response()->json(['success' => 'Status updated successfully','status' => true],200);
                                } else {
                                    return response()->json(['error' => 'Unit not found'],404);
                                }
            }
        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' changeUnitStatus() function','top_ten_bazar');
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
    public function deleteUnit($unitSlug)
    {
        try{
            if(!$unitSlug)
            {
                return redirect()->back()->with([
                    'message'    => 'Unit slug not found',
                    'alert-type' => 'error'
                ], 404);
            }
          $unitDeleted =  $this->unit->whereSlug($unitSlug)->delete();
             $notification = [
                'message'    => $unitDeleted ? 'Unit deleted successfully' : 'Something went wrong',
                'alert-type' => $unitDeleted ? 'success' : 'error'
            ];
            return response()->json($notification,200);
        }catch(\Throwable $e)
        {
             $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' deleteUnit() function','top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
}
