<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Models\Advertisement;
use App\Services\AdvertisementService;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function __construct(
        private AdvertisementService $advertisementService
    ) {}

    public function index()
    {
        $ads = $this->advertisementService->getAdvertisements(10);
        return view('admin.advertisements.index', compact('ads'));
    }

    public function create()
    {
        return view('admin.advertisements.create');
    }

    public function store(StoreAdvertisementRequest $request)
    {
        $data = $request->validated();
        $this->advertisementService->createAdvertisement($data);

        return redirect()
            ->route('admin.advertisements.index')
            ->with('success', 'Advertisement created successfully');
    }

    public function edit(Advertisement $advertisement)
    {
        return view('admin.advertisements.edit', ['advertisement' => $advertisement]);
    }

    public function show(Advertisement $advertisement)
    {
        $advertisement = $this->advertisementService->getAdvertisement($advertisement->id);
        return redirect($advertisement->link);
    }

    public function update(Advertisement $advertisement, StoreAdvertisementRequest $request)
    {
        $data = $request->validated();
        $this->advertisementService->updateAdvertisement($advertisement, $data);
        
        return redirect()->route('admin.advertisements.index')
            ->with('success', 'Advertisement updated successfully');
    }

    public function destroy(Advertisement $advertisement)
    {
        $this->advertisementService->deleteAdvertisement($advertisement);

        return back()->with('success', 'Advertisement deleted');
    }
}
