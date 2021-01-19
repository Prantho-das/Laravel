<div class='mt-5'>
    @if (session()->has('msg'))
    <div class='{{session('msg')['active']}} p-4 w-52 rounded-md'>
        <h1 class='text-xl text-white capitalize'>
            {{session('msg')['msg']}}
        </h1>
    </div>
    @endif
    <div class='grid grid-cols-1 lg:grid-cols-3 gap-5'>
        <div class='col-span-3 md:col-span-1'>
            <div class='flex flex-col'>
                <input wire:model.lazy='comments' type='text' placeholder='Please Comment'
                    class='my-3 py-2 border-2 border-teal-800 outline-none px-5 @error(' comments')border-red-500
                    @enderror' />
                @error('comments') <h1 class='text-md text-red-900'>{{$message}}</h1> @enderror
                <input type="file" wire:model="comment_img" class='my-4'>
                @error('comment_img') <h1 class='text-md text-red-900'>{{$message}}</h1> @enderror
                <button class="w-12 rounded-md pb-2 pt-3 bg-green-500 text-white capitalize" wire:click='comment'
                    wire:target='comment' wire:loading.class.remove='w-12' wire:loading.class='w-20'>
                    <i class="fas fa-plus" wire:loading.remove wire:target='comment'></i>
                    <h2 wire:loading wire:target='comment'>Adding...</h2>
                </button>
            </div>
            <hr class='my-4' />
            <div class='grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 gap-4'>
                @foreach ($post as $item)
                <div class="p-5 md:p-4 text-center md:text-left rounded-lg shadow-xl
                @if ($post_id===$item->id) border-2 border-blue-300 bg-gray-50 @endif"
                    wire:click='postSelect({{$item->id}})'>
                    <h1 class="card-title text-blue-500 text-xl uppercase">{{$item->post_title}}</h1>
                    <p class="card-text text-gray-600 text-md capitalize">{{$item->post_desc}}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div class='col-span-3 md:col-span-2 pt-4'>
            <div wire:loading wire:loading.class='grid place-items-center h-full' wire:target='postSelect'>
                <h1 class="text-4xl text-blue-600 text-center uppercase">Loading...</h1>
            </div>
            @php
                $arrL=count($comment);
            @endphp
            @if ($arrL!=0)
            <div class='grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4' wire:loading.remove
                wire:target='postSelect,comment'>
                @foreach ($comment as $item)
                <div class="h-80 shadow-xl rounded-md overflow-hidden flex flex-wrap"
                    wire:click='delete({{$item->id}})'>
                    @if ($item->comment_img)
                    @if (file_exists('storage/image/'. $item->comment_img))
                    <img src="{{asset('storage/image/'.$item->comment_img)}}" class='w-full h-1/2' />
                    @else
                    <img src="{{asset($item->comment_img)}}" class='w-full h-1/2' />
                    @endif
                    @endif
                    <div class='p-3'>
                        <h1 class="card-title text-blue-500 text-xl sm:text-base md:text-xl lg:text-base uppercase">
                            {{$item->comments}}</h1>
                        <p class="card-text text-gray-600 text-md capitalize">Lorem, ipsum dolor sit amet consectetur
                            adipisicing
                            elit. Aliquam, dolorum?</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class='h-full grid place-items-center'>
                <h1 class="text-4xl text-center text-red-300 uppercase">Nothing Found...</h1>
            </div>
            @endif
        </div>
    </div>
</div>