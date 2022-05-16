<div>
@if($case->paymentInfo)

@if($case->paymentInfo->installment===0)
    <button type="submit" wire:click='safe({{$case->id}})' wire:loading.attr='disabled' class="btn add_btn_style">Safe</button>
    @if ($case->assignCase->case_status!=2)
    <button type="submit" wire:click='unClear({{$case->id}})' wire:loading.attr='disabled' class="btn unclear_btn-style">Unclear Picture</button>
    @endif
@else
    <button type="submit" disabled class="btn add_btn_style">Safe</button>
    @if ($case->assignCase->case_status!=2)
    <button type="submit" disabled class="btn unclear_btn-style">Unclear Picture</button><br> <br>
    <p class='text-center text-danger'>Inform to {{$case->patientInfo->f_name}} {{$case->patientInfo->l_name}}, he/she has due amount ({{$case->paymentInfo->due_amount}} Tk)</p>
@endif

@endif
@endif
</div>
