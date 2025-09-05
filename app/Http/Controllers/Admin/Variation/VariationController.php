<?php

namespace App\Http\Controllers\Admin\Variation;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariationAddRequest;
use App\Models\Variation;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VariationController extends Controller
{
     #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "VariationController";

    #Bind Variation Model
    protected $variation;

    public function __construct(LogServices $logServices,Variation $variation)
    {
        $this->logServices = $logServices;
        $this->variation   = $variation;
    }
    public function index(Request $request)
    {
          try{
                $variation = $this->variation->query();
                if ($request->ajax()) {
                    return DataTables::of($variation)
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
            return view('admin.pages.variations.index');
        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' index () function', 'top_ten_bazar');
                $notification = [
                    'message'    => 'An error occurred. Please try again later.',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification);
        }
    }
    public function changeVariationStatus(Request $request)
    {
         try{
            $slug = $request->variationSlug;
            if(isset($slug))
            {
                $vart = $this->variation->whereSlug($slug)->first();
                if ($vart) {
                                $status = $vart->status == 0 ? 1 : 0;
                                $vart->update(['status' => $status]);
                                return response()->json(['success' => 'Status updated successfully','status' => true],200);
                                } else {
                                    return response()->json(['error' => 'Variation not found'],404);
                                }
            }
        }catch(\Throwable $e)
        {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' changeVariationStatus() function','top_ten_bazar');
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
    public function store(VariationAddRequest $request)
    {
       try{
            $data = [
                'slug'   => str()->random(14),
                'name'   => $request->var_name ?? '',
                'status' => 1
            ];
           $variationCreated =  $this->variation->create($data);
           $notification = [
                'message'    => $variationCreated ? 'Variation created successfully' : 'Something went wrong',
                'alert-type' => $variationCreated ? 'success' : 'error'
            ];
            return redirect()->back()->with($notification, $variationCreated ? 200 : 400);
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
    * @method helps to delete unit
    * @param unitSlugS
    * @return jsonResposnse
    */
    public function deleteVariation($variationSlug)
    {
        try{
            if(!$variationSlug)
            {
                return redirect()->back()->with([
                    'message'    => 'Variation slug not found',
                    'alert-type' => 'error'
                ], 404);
            }
            $variationDeleted =  $this->variation->whereSlug($variationSlug)->delete();
             $notification = [
                'message'    => $variationDeleted ? 'Variation deleted successfully' : 'Something went wrong',
                'alert-type' => $variationDeleted ? 'success' : 'error'
            ];
            return response()->json($notification,200);
        }catch(\Throwable $e)
        {
             $this->logServices->createErrorLog('Error: ' . $e->getMessage().'At line:'. $e->getLine() . ' In. '. $this->controller .' deleteVariation() function','top_ten_bazar');
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
            return view('admin.pages.variations.add');
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }
     public function edit($categorySlug)
    {
        try{
            return view('admin.pages.variations.edit');
        }catch(\Throwable $e)
        {
            return redirect()->back();
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
}
