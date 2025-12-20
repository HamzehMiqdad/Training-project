<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertisementRequest;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function index()
    {
        $ads = Advertisement::latest()->paginate(10);
        return view('admin.advertisements.index', compact('ads'));
    }
    public function create()
    {
        return view('admin.advertisements.create');
    }

    public function store(StoreAdvertisementRequest $request){
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('ads', 'public');

        Advertisement::create($data);

        return redirect()
            ->route('admin.advertisements.index')
            ->with('success', 'Advertisement created successfully');
    
    }

    public function edit(Advertisement $advertisement){
        return view('admin.advertisements.edit',['advertisement' => $advertisement]);

    }

    public function show(Advertisement $advertisement){
        $advertisement->increment('hits');
        return redirect($advertisement->link);
    }
    public function update(Advertisement $advertisement,StoreAdvertisementRequest $request){
        $advertisement->update($request->validated());
        return redirect()->route('admin.advertisements.index')
            ->with('success', 'Advertisement updated successfully');;
    }

    public function destroy(Advertisement $advertisement)
    {
        Storage::disk('public')->delete($advertisement->image);
        $advertisement->delete();

        return back()->with('success', 'Advertisement deleted');
    }
}
