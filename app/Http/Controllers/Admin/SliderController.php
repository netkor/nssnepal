<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->paginate(15);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request, ImageService $images)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'button_text' => 'nullable|string|max:255',
            'button_url'  => 'nullable|string|max:255',
            'order'       => 'integer',
            'is_active'   => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $validated['image'] = $images->upload(
            $request->file('image'),
            'uploads/sliders',
            1920, 1080, 85
        );

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Hero slide created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider, ImageService $images)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'button_text' => 'nullable|string|max:255',
            'button_url'  => 'nullable|string|max:255',
            'order'       => 'integer',
            'is_active'   => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $images->upload(
                $request->file('image'),
                'uploads/sliders',
                1920, 1080, 85,
                $slider->image
            );
        } else {
            unset($validated['image']);
        }

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(Slider $slider, ImageService $images)
    {
        $images->delete($slider->image);
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Hero slide deleted successfully.');
    }
}
