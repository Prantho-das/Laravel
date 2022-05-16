


<button type="button" wire:click='read_at' class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="si si-bell"></i>
        <span class="badge badge-primary badge-pill" wire:poll.keep-alive>{{$notification}}</span>
</button>
