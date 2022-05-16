<div wire:poll.15000ms.keep-alive>
    <div class="p-2 bg-primary text-center">
        <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>
    </div>
    <ul class="nav-items mb-0" style="width:100%;height: 450px; overflow:scroll; display: block; overflow-x: hidden;">
        @forelse ($notification as $item)
        <li class='{{($item->read_at===null) ? "bg-warning text-white" :''}}'>
            <a class="text-dark media py-2" href="{{url($item->data['link'])}}">
                <div class="mr-2 ml-3">
                    <i class="fa fa-fw fa-check-circle text-success"></i>
                </div>
                <div class="media-body pr-2">
                    <div class="font-w600">{{$item->data['msg']}}</div>
                    <small class="text-muted">{{\Carbon\Carbon::make($item->created_at)->diffForHumans()}}</small>
                </div>
            </a>
        </li>
        @empty
        <li>
            <a class="text-dark media py-2" href="javascript:void(0)">
                <div class="mr-2 ml-3">
                    <i class="fa fa-fw fa-plus-circle text-danger"></i>
                </div>
                <div class="media-body pr-2">
                    <div class="font-w600">No Notification Found</div>
                    <small class="text-muted"></small>
                </div>
            </a>
        </li>
        @endforelse
    </ul>
    <div class="p-2 border-top">
        <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
            <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More..
        </a>
    </div>
</div>
