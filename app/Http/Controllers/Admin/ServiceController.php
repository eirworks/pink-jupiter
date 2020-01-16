<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::orderBy('id', 'desc')
            ->paginate();

        return view('admin.services.index', [
            'services' => $services,
        ]);
    }

    public function edit(Request $request, Service $service)
    {
        $service->load(['category']);
        $service->loadCount(['clicks']);

        return view('admin.services.form', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->district_id = $request->input('district_id', 1);
        $service->category_id = $request->input('category_id');
        $service->price = $request->input('price');
        $service->activated = $request->input('activated', false);
        $service->data = [];
        $service->image = '';

        $service->save();

        $this->saveImage($request, $service);

        return redirect()->route('admin.services.index')->with('success', "Iklan telah disimpan");
    }

    private function saveImage(Request $request, Service $service)
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

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('danger', "Iklan telah dihapus!");
    }
}
