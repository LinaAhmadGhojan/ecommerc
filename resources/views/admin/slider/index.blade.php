@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4>
                    Slider List
                    <a href="{{ url('admin/slider/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Slider</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->description }}</td>
                                <td>
                                    <img src="{{ asset("$slider->image") }}" style="width:80px; height:80px;" alt="image">
                                </td>
                                <td>{{ $slider->status == '1' ? 'Hidden':'Visible' }}</td>
                                <td>
                                    <a href="{{ url('admin/slider/edit/'.$slider->id) }}" class="btn btn-success btn-sm">
                                        Edit
                                    </a>
                                    <a onclick="return confirm('Are you sure to Delete?');"  href="{{ url('admin/slider/delete/'.$slider->id) }}" class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                 </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div>
                    {{ $sliders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
