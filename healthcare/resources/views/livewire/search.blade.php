<div x-data={isOpen:false}>
    <form class="d-sm-inline-block" wire:submit.prevent='result'>
        <div class="input-group input-group-sm">
            <input type="text" @click="isOpen=true" @click.away="isOpen=false" wire:model.debounce.1000ms='query'
                class="form-control @error('query') is-invalid @enderror" placeholder="Type to Search....."
                id="page-header-search-input2">
        </div>
    </form>
    <!-- Notifications Dropdown -->
    @if ($query)
    <ul class="mt-1" x-show="isOpen" style="padding-left: 0;list-style: none;background: rgb(255, 255, 255);position: absolute;width: 320px; height: 450px; overflow:scroll; border: 1px solid rgb(0, 60, 255);">
        @if (count($sResult)>0)
        @foreach ($sResult as $item)
        <li wire:loading.remove wire:target="query" class='pt-2'>
            <a class="text-dark media py-2" href="{{url('user_profile/'.$item->u_id)}}">
                <div class="ml-3 w-25">
                    <img src="
                            @if ($item->avatar)
                                {{asset('storage/image/'.$item->avatar)}}
                            @else
                                https://s.gravatar.com/avatar/{{md5(strtolower(trim($item->email)))}}
                            @endif
                    " alt="" class='rounded img-fluid' style="width: 50px; height:50px;">
                </div>
                <div class="media-body px-2">
                    <div class="font-w600">{{$item->f_name.' '.$item->l_name}}</div>
                    <small>User ID: {{$item->u_id}}</small><br>
                    <small
                        class="text-muted">{{$item->userlog?\Carbon\Carbon::parse($item->userlog->created_at)->diffForHumans():'Not Logged In'}}</small>
                </div>
            </a>
        </li>
        @endforeach
        @else
        <li wire:loading.remove wire:target="query" class='px-5 pt-2'>
            <h5 class='text-center text-danger'>
                Noting Found!
            </h5>
        </li>
        @endif
        <li wire:loading wire:target="query" class='px-5 pt-2'>
            <h5 class='text-center text-primary'>
                Loading...
            </h5>
        </li>
    </ul>
    @endif
    <!-- END Notifications Dropdown -->
</div>
