<?php

namespace App\Http\Controllers\Admin\ProductTag;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTagRequest;
use App\Models\ProductTag;
use App\Services\LogServices;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductTagController extends Controller
{
    #Bind LogServices
    protected $logServices;

    #controller name
    protected $controller = "ProductTagController";

    #Bind ProductTags Model
    protected $productTag;

    public function __construct(LogServices $logServices, ProductTag $productTag)
    {
        $this->logServices = $logServices;
        $this->productTag  = $productTag;
    }
    public function index(Request $request)
    {
        try {
            $tags = $this->productTag->query();
            if ($request->ajax()) {
                return DataTables::of($tags)
                    ->editColumn('status', function ($row) {
                        $checked = $row->status ? 'checked' : '';
                        return '
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" ' . $checked . ' data-id="' . $row->slug . '" onchange="changeStatus(\'' . $row->slug . '\')"
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
                                    </td>
                                    ';
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            return view('admin.pages.productTag.index');
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
    public function store(AddTagRequest $request)
    {
        try {
            $data = [
                'slug'   => str()->random(14),
                'name'   => $request->tag_name ?? '',
                'status' => 1
            ];
            $tagCreated =  $this->productTag->create($data);
            $notification = [
                'message'    => $tagCreated ? 'Product Tag created successfully' : 'Something went wrong',
                'alert-type' => $tagCreated ? 'success' : 'error'
            ];
            return redirect()->back()->with($notification, $tagCreated ? 200 : 400);
        } catch (\Throwable $e) {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' store() function', 'top_ten_bazar');
            $notification = [
                'message'    => 'An error occurred. Please try again later.',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function changeTagStatus(Request $request)
    {
        try {
            $slug = $request->tagSlug;
            if (isset($slug)) {
                $tag = $this->productTag->whereSlug($slug)->first();
                if ($tag) {
                    $status = $tag->status == 0 ? 1 : 0;
                    $tag->update(['status' => $status]);
                    return response()->json(['success' => 'Status updated successfully', 'status' => true], 200);
                } else {
                    return response()->json(['error' => 'Product Tag not found'], 404);
                }
            }
        } catch (\Throwable $e) {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' changeTagStatus() function', 'top_ten_bazar');
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
    public function deleteTag($tagSlug)
    {
        try {
            if (!$tagSlug) {
                return redirect()->back()->with([
                    'message'    => 'Product Tag slug not found',
                    'alert-type' => 'error'
                ], 404);
            }
            $tagDeleted =  $this->productTag->whereSlug($tagSlug)->delete();
            $notification = [
                'message'    => $tagDeleted ? 'Product Tag deleted successfully' : 'Something went wrong',
                'alert-type' => $tagDeleted ? 'success' : 'error'
            ];
            return response()->json($notification, 200);
        } catch (\Throwable $e) {
            $this->logServices->createErrorLog('Error: ' . $e->getMessage() . 'At line:' . $e->getLine() . ' In. ' . $this->controller . ' deleteTag() function', 'top_ten_bazar');
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
            return view('admin.pages.productTag.create');
        } catch (\Throwable $e) {
            return redirect()->back();
        }
    }
}
