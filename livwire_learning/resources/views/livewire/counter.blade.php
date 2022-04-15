<div class='text-center grid cols-2 rounded border-2 border-teal-500 px-3 py-8 mt-6 md:w-5/12 mx-auto'>
    <div>
        @foreach ($data as $item)
        <div class="card text-left">
            <div class="card-body">
                <h1 class="card-title text-blue-500 text-2xl uppercase">{{$item['title']}}</h1>
                <p class="card-text text-gray-600 text-lg capitalize">{{$item['description']}}</p>
            </div>
            <button class='block px-5 rounded py-1.5 bg-red-500 text-white' wire:click='delete({{$i++}})'>-</button>
        </div>
        @endforeach
    </div>
    <div></div>
    {{-- <h1 class='text-5xl'>{{$number}}</h1>
    <div class='d-flex flex-space-between mt-4'>
        <button class='px-5 rounded py-1.5 bg-green-500 text-white' wire:click='increment'>+</button>
        <button class='px-5 rounded py-1.5 bg-red-500 text-white' wire:click='decrement'>-</button>
    </div>
    {{-- input --}}
    {{-- <input wire:model.lazy='comment' type='text' placeholder='Please Comment'
        class='my-3 py-1 border-2 border-teal-800 outline-none px-5 @error('comment')border-red-500 @enderror' />
    <button class="px-5 rounded-md py-1.5 bg-green-500 text-white capitalize" wire:click='comment'>Add</button>
    @error('comment') <h5 class="text-red-500">{{ $message }}</h5> @enderror --}}
    {{-- input --}}
    {{-- comments --}}
    {{-- <div class='grid grid-cols-2 gap-3 mt-6'>
        @php
            $i=1;
        @endphp
        @foreach ($data as $item)
        <div class="card text-left">
            <div class="card-body">
                <h1 class="card-title text-blue-500 text-2xl uppercase">{{$item['title']}}</h1>
                <p class="card-text text-gray-600 text-lg capitalize">{{$item['description']}}</p>
            </div>
            <button class='block px-5 rounded py-1.5 bg-red-500 text-white' wire:click='delete({{$i++}})'>-</button>
        </div>
        @endforeach
    </div> --}}
    {{-- comments --}}
    {{--<div class='flex flex-col items-center justify-between py-6'>
        @if ($photo)
        <img src="{{ $photo->temporaryUrl() }}" class='w-32 rounded-full'>
        @endif
        <input type="file" wire:model="photo" class='my-4'>
    </div>
    <button class="w-14 py-3 bg-black text-white rounded-sm outline-none border-none" wire:click="$emitUp('emitEvent',2222)">
        +
    </button> --}}
</div>