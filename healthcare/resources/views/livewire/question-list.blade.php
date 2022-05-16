<div>
    <div class='col-6 mx-auto'>
        <div class="form-group">
            <label for=""></label>
            <select class="custom-select mb-2" wire:model='catId'>
                <option selected readonly>Please Select Category</option>
                @foreach ($category as $item)
                <option value='{{$item->id}}'>{{$item->category_name}}</option>
                @endforeach
            </select>
            @error('catId')
            <h6 class='text-danger'>
                {{$message}}
            </h6>
            @enderror
            <button class="btn btn-primary" wire:click='questionList'>Search <i class="fa fa-search"aria-hidden="true"></i></button>
        </div>
    </div>
    <table class="table m-b-0 table-bordered table-striped table-vcenter js-dataTable-full no-footer">
        @if ($question)
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Symptom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($question as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->question_name}}</td>
                <td class='text-center'>
                    {{-- <span class='mr-2'>
                        <a href="{{url('admin/symptom/'.encrypt($item->id).'/edit')}}">
                            <i class="fas fa-edit"></i>
                        </a>
                    </span> --}}
                    {{-- <span class=''>
                        <a href="{{url('admin/symptom/'.encrypt($item->id))}}">
                            <i class="fas fa-eye"></i>
                        </a>
                    </span> --}}
                    <span>
                        <button wire:click='questionListDelete({{$item->id}})'
                            class="d-inline btn fas fa-trash text-danger"></button>
                    </span>
                </td>
            </tr>
            @empty
            <h5 class='text-center'>Sorry, Symptom Not Found!</h5>
            @endforelse
        </tbody>
    </table>
    @endif
</div>
{{-- @if (Session::has('msg'))
<script>
    toastr["{{session('msg')['active']}}"]("{{session('msg')['msg']}}")
</script>
@endif --}}
