<div class="col-lg-12">
    <h5 class='text-capitalize'>Upload Profile Picture</h5>
    <form wire:submit.prevent="save" class='mt-1'>
        <div wire:loading wire:target="photo">
            <h5 class="text-success">
                Uploading...
            </h5>
        </div>
        @if ($photo)
        <div class="col-md-1">
            <img src="{{ $photo->temporaryUrl() }}" class='img-fluid'>
        </div>
        @endif
        <input type="file" class='form-control' wire:model="photo">
        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
        <button class='btn btn-sm btn-info mt-3' type="submit">Upload</button>
    </form>
</div>
