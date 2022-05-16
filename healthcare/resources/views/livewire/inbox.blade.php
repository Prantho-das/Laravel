<div class="block rounded">
    <div class="block-content block-content-full">
        <div class="case_details_area">
            <div class="row">
                <div class="col-12">
                    <div class="col-12">
                        <h5>Message to : <span class="text-right">
                                @if ($caseDet->patientInfo->id===Auth::user()->id)
                                {{$caseDet->assignCase->f_name}}
                                {{$caseDet->assignCase->l_name}}
                                @else
                                {{$caseDet->patientInfo->f_name}}
                                {{$caseDet->patientInfo->l_name}}
                            </span></h5>
                        @endif
                        <hr>
                    </div>
                    <div wire:poll.6000ms.keep-alive class='overflow-auto' id='messageInner' style='height:25rem'>
                        @forelse ($allMessage as $item)
                        <div class="mb-2 p-3 rounded
                                @if ($item->sender_id===Auth::user()->id)
                                text-right bg-light
                                @else
                                text-left
                                @endif
                                    ">
                            <img src="
                                @if ($item->sender_id===Auth::user()->id)
                                    @if (Auth::user()->avatar)
                                    {{asset('storage/image/'.Auth::user()->avatar)}}
                                    @else
                                    https://s.gravatar.com/avatar/{{md5( strtolower( trim(Auth::user()->email)))}}
                                    @endif
                                @else
                                     @if ($item->senderInfo->avatar)
                                    {{asset('storage/image/'.$item->senderInfo->avatar)}}
                                    @else
                                    https://s.gravatar.com/avatar/{{md5( strtolower( trim($item->senderInfo->email)))}}
                                    @endif
                                @endif
                                    " class="rounded-circle m-r-15 mb-2" alt="profile-image"
                                style='width:2rem;height:2rem'>
                            <div class='d-flex flex-column inbox'>
                                <span class='fs-4 fw-bold'>{!!$item->message!!}</span>
                                <span class='text-sm d-block
                                        @if ($item->seen===0)
                                            text-danger
                                        @else
                                            text-primary
                                        @endif
                                        '>
                                    {{\Carbon\Carbon::parse($item->sent_time)->diffForHumans()}}
                                </span>
                            </div>
                        </div>
                        @empty
                        <h4 class='text-center'>Send Message</h4>
                        @endforelse
                    </div>
                    @if ($caseDet->assignCase->case_status!=1)
                    <div wire:ignore class="form-group">
                        <form wire:submit.prevent="send">
                            <textarea id='mytextarea' class="form-control
       @error('message') is-invalid @enderror
        " wire:model.debounce='textMessage' rows="4" name="text" placeholder="Aaaa.."></textarea>
                            <br>
                            <h5>@error('textMessage'){{$message}}@enderror</h5>
                            <button type="submit" class="add_btn_style">Send Message</button>
                        </form>
                    </div>
                    @endif

                    <h5 class='text-danger'>@error('textMessage'){{$message}}@enderror</h5>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#mytextarea').summernote({
            height: 150,
            toolbar: [
            ['font', ['bold']],
            ['color', ['color']],
            ['insert', ['picture']],
        ],
        callbacks: {
        onChange: function(e) {
            @this.set('textMessage', e);
        }},
        });
    </script>
    <script>
        Livewire.on('MessageScroll',function() {
            var message= document.getElementById('messageInner');
            message.scrollTo(0,message.scrollHeight);
        })
        Livewire.on('frontInputClear',function() {
             $("#mytextarea").summernote('code', '');
        })
        var message= document.getElementById('messageInner');
        message.scrollTo(0,message.scrollHeight);
    </script>
</div>