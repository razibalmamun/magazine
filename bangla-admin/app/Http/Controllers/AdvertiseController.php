<?php

namespace App\Http\Controllers;

use App\Http\Repositories\HelperRepositoryInterface;
use App\Models\Advertise;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    /**
     * @var HelperRepositoryInterface
     */
    private $_helepr;

    public function __construct(HelperRepositoryInterface $helper)
    {
        $this->_helepr = $helper;
    }

    public function index()
    {
        $advertise = Advertise::orderBy('id', 'DESC')->get();
        return view('admin.advertise.index', compact('advertise'));
    }

    public function create()
    {
        return view('admin.advertise.create');
    }

    public function storeData(Request $request)
    {
        $request->id ? $advertise = Advertise::find($request->id) : $advertise = new Advertise();
        $advertise->content = $request->content;
        if ($request->hasFile('image')) {
            $imagePath = $this->_helepr->imageUpload($request->file('image'), Date('Y-m-d'));
            $advertise->image = $imagePath;
        }
        if ($advertise->id) {
            if ($advertise->type != $request->type) {
                $advertise->status = null;
            }
        }
        $advertise->type = $request->type;
        $advertise->image_link = $request->image_link;
        $advertise->save();
        $id = $advertise->id;
        if ($request->active) {
            $this->active($id);
        }
    }

    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'image' => 'sometimes|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'type' => 'required|max:255',
        ]);
        
        $has = Advertise::where('type', $request->type)->count();
        if($has > 0){
            return redirect()->back()->withErrors([$request->type, 'this advertise already exist']);
        }

        $this->storeData($request);
        return redirect('admin/advertise/index');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'sometimes|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'type' => 'required|max:255',
        ]);

        $this->storeData($request);
        return redirect('admin/advertise/index');
    }

    public function active($id)
    {
        $advertise = Advertise::find($id);
        if ($advertise->status) {
            return 1;
        } else {
            $activeData = Advertise::where('status', 1)->where('type', $advertise->type)->first();
            if ($activeData) {
                $activeData->status = 0;
                $activeData->save();
            }
            $advertise->status = 1;
            $advertise->save();

            return 1;
        }
    }

    public function makeActive($id)
    {
        $this->active($id);
        return back();
    }

    public function edit($id)
    {
        $advertise = Advertise::find($id);
        return view('admin.advertise.edit', compact('advertise'));
    }

    public function delete($id)
    {
        $advertise = Advertise::find($id);
        $advertise->delete();

        return back();
    }
}
