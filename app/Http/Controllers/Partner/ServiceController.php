<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Ad;
use App\Http\Middleware\AdOwnership;
use App\Http\Requests\AdRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(AdOwnership::class)->only(['edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $services = auth()->user()->ads()
            ->orderBy('id', 'desc')
            ->withCount(['clicks'])
            ->paginate();

        return view('partner.services.index', [
            'services' => $services,
        ]);
    }

    public function create(Request $request)
    {
        $services = auth()->user()->ads()->count();

        if($services > setting('ads_per_user', 10))
        {
            return redirect()->route('partner.services.index')
                ->with('error', "Slot iklan anda sudah penuh!");
        }


        $service = new Ad();

        return view('partner.services.form', [
            'service' => $service,
        ]);
    }

    public function edit(Request $request, Ad $service)
    {
        $service->load(['category', 'city']);

        $service->loadCount([
            'clicks'
        ]);

        return view('partner.services.form', [
            'service' => $service,
        ]);
    }

    public function store(AdRequest $request)
    {
        $service = new Ad();

        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->city_id = $request->input('city_id');
        $service->district_id = 0;
        $service->category_id = $request->input('category_id');
        $service->price = $request->input('price');
        $service->activated = $request->input('activated');
        $service->data = [];
        $service->user_id = auth()->id();
        $service->image = '';

        $service->save();

        $this->saveImage($request, $service);

        return redirect()->route('partner.services.index')->with('success', "Iklan telah disimpan");
    }

    public function update(AdRequest $request, Ad $service)
    {
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->city_id = $request->input('city_id');
        $service->district_id = 0;
        $service->category_id = $request->input('category_id');
        $service->price = $request->input('price');
        $service->activated = $request->input('activated', false);
        $service->data = [];
        $service->image = '';

        $service->save();

        $this->saveImage($request, $service);

        return redirect()->route('partner.services.index')->with('success', "Iklan telah disimpan");
    }

    private function saveImage(Request $request, Ad $service)
    {
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');

            if ($image->isValid())
            {
                \Log::debug("Image is valid");
                $filename = $image->store('store/'.$service->id.'/', ['disk' => 'public']);
                \Log::debug("Image saved", ['filename' => $filename]);

                $path = config('filesystems.disks.public.root')."/".$filename;
                \Image::make( $path )->fit(400, 400, function($constraint) {
                    $constraint->aspectRatio();
                })
                    ->save($path);

                $service->image = $filename;
                $service->save();
            }
        }
    }

    public function destroy(Ad $service)
    {
        $service->delete();

        return redirect()->route('partner.services.index')->with('danger', "Iklan telah dihapus!");
    }
}
