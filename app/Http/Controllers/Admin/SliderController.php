<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        Paginator::useBootstrapFive();
        $sliders = Slider::orderBy('id', 'DESC')->paginate(10);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $validatedData['image'] = 'uploads/slider/'.$filename;
        }

        $validatedData['status'] = $request->status == true ? '1':'0';

        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status']
        ]);

        return redirect('admin/slider')->with('message', 'Slider Added Successfully!');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, $id)
    {
        $validatedData = $request->validated();
        $slider = Slider::findOrFail($id);

        if($request->hasFile('image')){

            $destination = $slider->image;

            if(File::exists($destination)){
                File::delete($destination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $validatedData['image'] = 'uploads/slider/'.$filename;
        }

        $validatedData['status'] = $request->status == true ? '1':'0';

        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'] ?? $slider->image,
            'status' => $validatedData['status']
        ]);

        return redirect('admin/slider')->with('message', 'Slider Updated Successfully!');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);

        if($slider->count() > 0){
            $destination = $slider->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }

            $slider->delete();
            return redirect('admin/slider')->with('message', 'Slider Deleted Successfully!');
        }
        return redirect('admin/slider')->with('message', 'Something went wrong!');
    }
}
