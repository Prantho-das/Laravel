<div>
    <!-- Main Container -->
    <main id="main-container">

        <!-- Page Content -->
        <div class="content content-narrow">
            <div class="block-header">
                <h3 class="block-title">Doctors</h3>
                <button type="button" class="add_btn_style" wire:click='$emit("admin_doctor_modal_open")'>Add
                    Doctors</button>
            </div>
            <!-- Deynamic Table Full -->
            <div class="block">
                <div class="block-content block-content-full">
                    <table class="table m-b-0 responsive table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Doctor Name</th>
                                <th>Email</th>
                                <th>Phone No.</th>
                                <th>Last Logged In</th>
                                <th>Case Evaluated</th>
                                <th>Manage</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctor as $item)
                            <tr>
                                <td style="color:{{$item->status===0?"red":""}}">{{$loop->iteration}}</td>
                                <td><img src="@if ($item->avatar)
                                    {{ asset('storage/image/'.$item->avatar) }}
                            @else
                                https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->email)))}}
                            @endif" class="rounded-circle mr-15" style="width: 40px;height:40px;" alt="{{$item->f_name}}-profile-image">
                                    <span><a style="color:{{$item->status===0?"red":""}}" href='{{url('user_profile/'.$item->u_id)}}'>{{$item->f_name." ".$item->l_name}}</a></span>
                                </td>
                                <td style="color:{{$item->status===0?"red":""}}">{{$item->email}}</td>
                                <td style="color:{{$item->status===0?"red":""}}">{{$item->phone?"+88".$item->phone:"N/A"}}</td>
                                <td style="color:{{$item->status===0?"red":""}}">{{$item->userlog?$item->userlog->created_at->diffForHumans():('Never Loged In')}}
                                </td>
                                <td style="color:{{$item->status===0?"red":""}}">{{$item->doctorCase?count($item->doctorCase):0}}</td>
                                <td style="color:{{$item->status===0?"red":""}}">
                                    <button wire:click='status({{$item->id}})' class="btn
                                        @if ($item->status===0)
                                        delete_btn_style
                                        @else
                                        active_btn_style
                                        @endif
                                        ">
                                        @if ($item->status===0)
                                        Deactivate
                                        @else
                                        Activate
                                        @endif
                                    </button>
                                </td>
                                <td class="text-center d-flex">
                                    <button wire:click='$emit("admin_doctor_modal_show",{{$item->id}})' class='btn'
                                        data-toggle="tooltip" data-placement="left" title="Show">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                    <a class='mt-2' href='{{url('admin/doctor/edit/'.encrypt($item->id))}}' class='btn'
                                        data-toggle="tooltip" data-placement="top" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    {{-- <button wire:click='delete({{$item->id}})' class='btn' data-toggle="tooltip"
                                        data-placement="right" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Dynamic Table Full -->
        </div>
        <!-- END Page Content -->

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal_header_style">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Doctor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent='store'>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">First Name</label>
                                        <input wire:model.lazy='f_name' type="text"
                                            class="form-control input_form_style" placeholder="Please write here...">
                                        @error('f_name') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Last Name</label>
                                        <input wire:model.lazy='l_name' type="text"
                                            class="form-control input_form_style" placeholder="Please write here...">
                                        @error('l_name') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Phone No.</label>
                                        <input wire:model.lazy='phone' type="tel" class="form-control input_form_style"
                                            placeholder="+88">
                                        @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">NID No</label>
                                        <input wire:model.lazy='nid' type="text" class="form-control input_form_style"
                                            placeholder="Enter Your Valid NID">
                                        @error('nid') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Email</label>
                                        <input wire:model.lazy='email' type="email"
                                            class="form-control input_form_style" placeholder="Please write here...">
                                        @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Password</label>
                                        <input wire:model.lazy='password' type="password"
                                            class="form-control input_form_style" placeholder="password">
                                        @error('password') <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Confirm Password</label>
                                        <input wire:model.lazy='password_confirmation' type="password"
                                            class="form-control input_form_style" placeholder="confirm">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Upload Profile Picture</label>
                                        <input wire:model='avatar' type="file" id="myFile" name="filename"
                                            class="form-control choose_file_style">
                                        @error('avatar') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <h5>Choose Category:</h5>
                            @forelse ($category as $item)
                            <div class="form-check">
                                <input class="form-check-input" wire:model='categoryId' type="checkbox"
                                    value="{{$item->id}}" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    {{$item->category_name}}
                                </label>
                            </div>
                            @empty
                            Might Be Some Server Issue.
                            @endforelse
                            @error('categoryId') <span class="error text-danger">{{ $message }}</span>
                            @enderror

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="cancel_btn_style" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="form_add_btn_style">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--edit modal-->
        <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal_header_style">
                        <h5 class="modal-title" id="exampleModalLabel">Doctor Profile</h5>
                        <button type="button" wire:click='$emit("admin_doctor_modal_close")' class="close"
                            data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent='edit'>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">First Name</label>
                                        <input readonly wire:model.lazy='f_name' type="text"
                                            class="form-control input_form_style" placeholder="Please write here...">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Last Name</label>
                                        <input readonly wire:model.lazy='l_name' type="text"
                                            class="form-control input_form_style" placeholder="Please write here...">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Phone No</label>
                                        <input readonly wire:model.lazy='phone' type="tel"
                                            class="form-control input_form_style" placeholder="+88">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">NID No</label>
                                        <input readonly wire:model.lazy='nid' type="text"
                                            class="form-control input_form_style" placeholder="Enter Your Valid NID">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Email</label>
                                        <input readonly wire:model.lazy='email' type="email"
                                            class="form-control input_form_style" placeholder="Please write here..." readonly>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <img src="@if ($avatar_img)
                                            {{ asset('storage/image/'.$avatar_img) }}
                                            @else
                                                https://s.gravatar.com/avatar/{{md5( strtolower( trim($email)))}}
                                            @endif"
                                        class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                        alt="">
                                </div>
                            </div>
                            <h5>Category:</h5>
                            @forelse ($category as $item)
                            <div class="form-check">
                                <input readonly class="form-check-input" wire:model='categoryId' type="checkbox"
                                    value="{{$item->id}}" id="{{$item->category_name}}" />
                                <label class="form-check-label" for="{{$item->category_name}}">
                                    {{$item->category_name}}
                                </label>
                            </div>
                            @empty
                            Might Be Some Server Issue.
                            @endforelse
                            <br />
                            <br />
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">First Degree</label>
                                        <input disabled type="text" value="{{$specialization?($specialization->highest_degree_one?$specialization->highest_degree_one:''):''}}" class="form-control input_form_style"
                                            placeholder="Your Degree & Dates">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Seocond Degree</label>
                                        <input disabled type="text" value="{{$specialization?($specialization->highest_degree_two?$specialization->highest_degree_two:''):''}}" class="form-control input_form_style"
                                            placeholder="Your Degree & Dates">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Third Degree</label>
                                        <input disabled three' type="text" value="{{$specialization?($specialization->highest_degree_three?$specialization->highest_degree_three:''):''}}" class="form-control input_form_style"
                                            placeholder="Your Degree & Dates">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Fourth Degree</label>
                                        <input disabled type="text" value="{{$specialization?($specialization->highest_degree_four?$specialization->highest_degree_four:''):''}}" class="form-control input_form_style"
                                            placeholder="Your Degree & Dates">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="title_label_style">Specialization</label>
                                        <input disabled type="text" value="{{$specialization?($specialization->specilization?$specialization->specilization:''):''}}" class="form-control input_form_style"
                                            placeholder="Your Specialization & Dates">

                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" wire:click='$emit("admin_doctor_modal_close")' class="cancel_btn_style"
                            data-dismiss="modal">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- END Main Container -->
    @if (Session::has('msg'))
    <script>
        toastr["{{session('msg')['active']}}"]("{{session('msg')['msg']}}")
    </script>
    @endif
</div>
{{-- Hiding Modal from controller --}}
<script>
    window.addEventListener('admin_doctor_modal', (e) => {
        $(document).ready(function () {
            $('#exampleModal').modal('hide').data('bs.modal', null);
            $('.modal-backdrop').remove();
        });
    })
</script>
{{-- Hiding Modal from controller --}}
{{-- Hiding Modal from controller edit --}}
<script>
    window.addEventListener('admin_doctor_modal_show_close', (e) => {
        $(document).ready(function () {
            $('#editModal').modal('hide').data('bs.modal', null);
            $('.modal-backdrop').remove();
        });
    })
</script>
{{-- Hiding Modal from controller edit --}}

{{-- Showing Modal --}}
<script>
    Livewire.on('admin_doctor_modal_open', () => {
        $('#exampleModal').modal('show');
    })
</script>
{{-- Showing Modal --}}

{{-- Edit Modal --}}
<script>
    Livewire.on('admin_doctor_modal_show', (id) => {
        $('#editModal').modal('show');
    })
</script>
{{-- Edit Modal --}}

{{-- Edit Modal close --}}
<script>
    Livewire.on('admin_doctor_modal_close', (id) => {
        $('#editModal').modal('hide').data('bs.modal', null);
        $('.modal-backdrop').remove();
    })
</script>
{{-- Edit Modal close --}}
<script>
    $('#editModal').focusout(function(){
         $('#editModal').modal('hide').data('bs.modal', null);
        $('.modal-backdrop').remove();
    })
</script>
