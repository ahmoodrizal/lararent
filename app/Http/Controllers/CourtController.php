<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourtController extends Controller
{
    public function index()
    {
        $courts = Court::latest()->get();

        return view('admin.court.index', compact('courts'));
    }

    public function show(Court $court)
    {
        return view('admin.court.show', compact('court'));
    }

    public function create()
    {
        return view('admin.court.create');
    }

    public function store(Request $request)
    {
        $request['slug'] = Str::slug($request['name']);

        $data = $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'unique:courts,slug'],
            'type' => ['required', 'in:futsal,badminton'],
            'description' => ['required'],
            'banner' => ['required'],
            'weekday_price' => ['required', 'integer'],
            'weekend_price' => ['required', 'integer']
        ], [
            'slug' => [
                'unique' => 'This court has already registered'
            ]
        ]);

        $data['slug'] = Str::slug($request['name']);

        //  Save image to public
        $image = $request->file('banner');
        $image->storeAs('public/banners', $image->hashName());
        $data['banner'] = $image->hashName();

        Court::create($data);

        return redirect(route('admin.courts.index'));
    }

    public function edit(Court $court)
    {
        return view('admin.court.edit', compact('court'));
    }

    public function update(Request $request, Court $court)
    {
        $request['slug'] = Str::slug($request['name']);

        $data = $request->validate([
            'name' => ['required'],
            'slug' => ['required', 'unique:courts,slug,' . $court->id . ',id'],
            'type' => ['required', 'in:futsal,badminton'],
            'description' => ['required'],
            'weekday_price' => ['required', 'integer'],
            'weekend_price' => ['required', 'integer'],
            'banner' => ['nullable']
        ], [
            'slug' => [
                'unique' => 'This court has already registered'
            ]
        ]);
        $data['slug'] = Str::slug($request['name']);

        // if image updated
        if ($request->hasFile('banner')) {
            // delete old image
            Storage::delete('public/banners/' . $court->banner);
            $image = $request->file('banner');
            $image->storeAs('public/banners', $image->hashName());
            $data['banner'] = $image->hashName();
        }

        $court->update($data);

        return redirect(route('admin.courts.show', $court));
    }

    public function toggleStatus(Court $court)
    {
        $court->is_active = !$court->is_active;
        $court->save();

        return redirect()->back();
    }
}
