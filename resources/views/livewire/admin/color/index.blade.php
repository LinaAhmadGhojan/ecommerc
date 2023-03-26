<div>
    <div class="row">

        @include('livewire.admin.color.modal-form')

        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        Colors List
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addColorModal" class="btn btn-primary btn-sm text-white float-end">Add Colors</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Color Name</th>
                                <th>Color Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $color)
                                <tr>
                                    <td>{{ $color->id }}</td>
                                    <td>{{ $color->name }}</td>
                                    <td>
                                        <p style="height: 30px; width:30px; border-radius:25%; background:{{ $color->code }};" class="border border-secondary">
                                        </p>
                                        {{ $color->code }}
                                    </td>
                                    <td>{{ $color->status == '1' ? 'Hidden':'Visible' }}</td>
                                    <td>
                                        <a href="#" wire:click="editColor({{ $color->id }})" data-bs-toggle="modal" data-bs-target="#updateColorModal" class="btn btn-success btn-sm">
                                            Edit
                                        </a>
                                        <a href="#" wire:click="deleteColor({{ $color->id }})" data-bs-toggle="modal" data-bs-target="#deleteColorModal" class="btn btn-danger btn-sm">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $colors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addColorModal').modal('hide');
            $('#updateColorModal').modal('hide');
            $('#deleteColorModal').modal('hide');
        });
    </script>
@endpush
