<div class="block rounded">
    <div class="block-content block-content-full">
        <div class="case_details_area">
            <div class="row">
                <div class="col-12">
                    <div class="col-12">
                        <h5>Prescription: </h5>
                        <hr>
                    </div>
                    {{-- <div class='overflow-auto' style='height:10rem'>
                    </div> --}}
                    {{-- @if ($prescription->count()<=0) Please Prescribe your Patient! @else <h3>
                        {{$prescription[0]->disease}}</h3>
                    @forelse ($prescription as $item)
                    {!!$item->prescription!!}
                    @empty
                    @endforelse
                    @endif --}}
                    @if (Auth::user()->role==='DOCTOR')
                    @if ($caseDet->assignCase->case_status!=1)
                    <div class="form-group">
                        <form wire:submit.prevent='prescribe'>
                            {{-- <textarea class="form-control mb-3 @error('disease') is-invalid @enderror"
                                wire:model='disease' placeholder="Disease Names">
                            {{$prescription?Str::of($prescription->disease)->trim():''}}
                            </textarea> --}}
                            <h5>Please add here the Diseases</h5>
                            <div>
                                <textarea class="form-control mb-3 @error('disease') is-invalid @enderror"
                                    wire:model='disease' placeholder="Disease Names">
                                    {{$prescription?Str::of($prescription->disease)->trim():''}}
                                </textarea>
                            </div>
                            <br/>
                            <h5>Please add here the Medicine Name</h5>
                            <textarea class="form-control @error('medicineInput') is-invalid @enderror"
                                wire:model='medicineInput' rows="4" placeholder="Medicine..">
                            {{$prescription?Str::of($prescription->medicine)->trim():''}}
                            </textarea>
                            <br>
                            <h5>Note</h5>
                            <textarea class="form-control @error('medicine') is-invalid @enderror" wire:model='medicine'
                                rows="4" placeholder="Note..">
                                {{$prescription?Str::of($prescription->prescription)->trim():''}}
                            </textarea>
                            <br>
                            <button type="submit" class="add_btn_style">Prescribe</button>
                        </form>
                    </div>
                    @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
