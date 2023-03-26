<?php

namespace App\Http\Livewire\Admin\Color;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $code, $status, $color_id;

    public function render()
    {
        $colors = Color::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.color.index', ['colors' => $colors])
                    ->extends('layouts.admin')
                    ->section('content');
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'code' => 'required',
            'status' => 'nullable'
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->code = NULL;
        $this->status = NULL;
        $this->color_id = NULL;
    }

    public function storeColor()
    {
        $validatedData = $this->validate();
        Color::create([
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status == true ? '1':'0'
        ]);
        session()->flash('message', 'Color Added Successfully!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editColor(int $color_id)
    {
        $this->color_id = $color_id;
        $color = Color::findOrFail($color_id);
        $this->name = $color->name;
        $this->code = $color->code;
        $this->status = $color->status;
    }

    public function updateColor()
    {
        $validatedData = $this->validate();
        Color::find($this->color_id)->update([
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status == true ? '1':'0'
        ]);
        session()->flash('message', 'Color Updated Successfully!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteColor($color_id)
    {
        $this->color_id = $color_id;
    }

    public function destroyColor()
    {
        Color::findOrFail($this->color_id)->delete();
        session()->flash('message', 'Color Deleted Successfully!');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
}
