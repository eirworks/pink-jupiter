<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryUploadController extends Controller
{
    public function index()
    {
        return view('admin.categories.upload.index');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('csv'))
        {
            $file = $request->file('csv');

            if ($file->isValid())
            {
                $filename = $file->storeAs('csv', 'category.csv');

                $this->storeFile(config('filesystems.disks.local.root').'/'.$filename);

                return redirect()->route('admin.categories.upload')
                    ->with('success', "Berkas telah diupload!");
            }
        }

        return redirect()->route('admin.categories.upload')
            ->with('error', "File tidak valid!");
    }

    private function storeFile($filename)
    {
        \Log::debug("Storing file", [
            'filename' => $filename,
        ]);

        $file = fopen($filename, 'r');

        $items = [];

        while(!feof($file))
        {
            $line = fgetcsv($file);

            \Log::debug("Parsed", ['line' => $line]);

            // skip if it is empty
            if (!$line[0])
            {
                \Log::debug("Line 0 is not valid", ['line[0]' => $line[0]]);
                continue;
            }

            $items[] = [
                'id' => intval($line[0]),
                'parent_id' => intval($line[1]),
                'name' => $line[2],
                'slug' => Str::slug($line[2]),
                'image' => "",
                'description' => "",
                'price' => $line[5],
                'ordering' => $line[3],
                'group_order' => $line[4],
            ];
        }

        fclose($file);

        if (count($items) > 0)
        {
            DB::table('categories')->truncate();
            DB::table('categories')->insert($items);
        }
    }
}
