<div style='position:relative'>
    <button type="button" class="btn btn-sm btn-dual" aria-hidden="true" id="page-header-notifications-dropdown"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope-open-text"></i>
        <span wire:poll.150000ms.keep-alive class="badge badge-primary badge-pill">{{$messageCount}}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm"
        aria-labelledby="page-header-notifications-dropdown">
        <div class="p-2 bg-primary text-center">
            <h5 class="dropdown-header text-uppercase text-white">Message</h5>
        </div>
        <ul class="nav-items mb-0">
            @forelse ($messageList as $item)
            @php
            if (Auth::user()->role==='DOCTOR') {
            if ($item[0]->assignInfo->case_status===0) {
            $location='case_details';
            } else {
            $location='case_evaluated';
            }
            }
            else{
            $location='case_details';
            }
            @endphp
            <li>
                <a class="media py-2"
                    href="{{url(Str::lower(auth()->user()->role)."/$location/".encrypt($item[0]->case_id))}}"
                    style='{{($item[0]->receiver_id===auth()->id()&&$item[0]->seen===0)?("background:yellow;color:black;"):"color:black"}}'>
                    @if ($item[0]->sender_id===auth()->id())
                    <img src="
                            @if ($item[0]->receiverInfo->avatar)
                            {{asset('storage/image/'.$item[0]->receiverInfo->avatar)}}
                            @else
                            https://ui-avatars.com/api/?name={{$item[0]->receiverInfo->f_name}}&background=random&size=200
                            @endif
                            " class="img-fluid px-2 rounded-circle h-25 w-25" alt="">
                    <div class="media-body">
                        <div class="font-w600">
                            {{$item[0]->receiverInfo->f_name}}
                        </div>
                        <small class="text-muted">{{\Carbon\Carbon::make($item[0]->sent_time)->diffForHumans()}}</small>
                        @else
                        <img src="
                            @if ($item[0]->senderInfo->avatar)
                            {{asset('storage/image/'.$item[0]->senderInfo->avatar)}}
                            @else
                            https://ui-avatars.com/api/?name={{$item[0]->senderInfo->f_name}}&background=random&size=200
                            @endif
                            " class="img-fluid px-2 rounded-circle h-25 w-25" alt="">
                        <div class="media-body">
                            <div class="font-w600">
                                {{$item[0]->senderInfo->f_name}}
                            </div>
                            <small
                                class="text-muted">{{\Carbon\Carbon::make($item[0]->sent_time)->diffForHumans()}}</small>

                            @endif
                        </div>
                </a>
            </li>
            @empty
            <li>
                <a class="text-dark media py-2" href="javascript:void(0)">
                    <div class="mr-2 ml-3">
                        <i class="fa fa-fw fa-check-circle text-success"></i>
                    </div>
                    <div class="media-body pr-2">
                        <div class="font-w600">Message Not Found!</div>
                    </div>
                </a>
            </li>
            @endforelse
        </ul>
    </div>
</div>
