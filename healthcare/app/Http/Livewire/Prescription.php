<?php

namespace App\Http\Livewire;

use App\Models\prescription as ModelsPrescription;
use Illuminate\Http\Request;
use Livewire\Component;

class Prescription extends Component
{
    public $disease;
    public $medicineInput;
    public $medicine;
    protected $input = [];

    public $caseId;
    public $caseDet;

    protected $listeners = ['refresh' => '$refresh'];

    public function prescribe(Request $req)
    {
        $this->validate([
            'medicine' => 'required',
            'disease' => 'required',
            'medicineInput' => 'required'
        ]);

        $prescription = ModelsPrescription::where('case_id', $this->caseId)->first();
        if ($prescription) {
            $prescription->disease = $this->disease;
            $prescription->medicine = $this->medicineInput;
            $prescription->prescription = $this->medicine;
            $prescription->save();
        } else {
            ModelsPrescription::create([
                'case_id' => $this->caseId,
                'disease' => $this->disease,
                'medicine' => $this->medicineInput,
                'prescription' => $this->medicine
            ]);
        }

        session()->flash('msg', [
            'active' => 'success', 'msg' => 'Prescription Added',
        ]);
        // $this->reset('medicine');
        $this->emitSelf('refresh');
    }


    public function clearPrescription()
    {
        $prescription = ModelsPrescription::where('case_id', $this->caseId)->firstOrFail();
        $prescription->delete();
        session()->flash('msg', [
            'active' => 'success', 'msg' => "Prescription Cleared",
        ]);
        $this->reset('medicine');
        $this->emitSelf('refresh');
    }



    public function mount($caseDet)
    {
        $this->caseId = $caseDet->id;
        $this->caseDet = $caseDet;
    }
    public function render(Request $req)
    {
        $prescription = ModelsPrescription::where('case_id', $this->caseId)->first();

        if ($prescription) {
            $this->disease = $prescription->disease ? $prescription->disease : '';
            $this->medicineInput = $prescription->medicine ? $prescription->medicine : '';
            $this->medicine = $prescription->prescription ? $prescription->prescription : '';
        }

        return view('livewire.prescription', compact('prescription'));
    }
}
