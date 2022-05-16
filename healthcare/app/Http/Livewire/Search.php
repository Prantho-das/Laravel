<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Search extends Component
{
    public $query;
    public $sResult = [];

    public function hydrateQuery()
    {
        $this->sResult = User::with(['userlog' => function ($query) {
            $query->latest();
        }])->where(function ($query) {
            $query->orWhere('f_name', 'LIKE', '%' . $this->query . '%')
                ->orWhere('l_name', 'LIKE', '%' . $this->query . '%')
                ->orWhere('email', 'LIKE', '%' . $this->query . '%')
                ->orWhere('u_id', 'LIKE', '%' . $this->query . '%');

        })
            ->where('role', "!=", "ADMIN")
            ->latest()
            ->get();
    }
    public function result()
    {
        $this->validate([
            'query' => 'required'
        ]);
        $this->sResult = User::with(['userlog' => function ($query) {
            $query->latest();
        }])->where(function ($query) {
            $query->orWhere('f_name', 'LIKE', '%' . $this->query . '%')
                ->orWhere('l_name', 'LIKE', '%' . $this->query . '%')
                ->orWhere('email', 'LIKE', '%' . $this->query . '%')
                ->orWhere('u_id', 'LIKE', '%' . $this->query . '%');
        })
            ->where('role', "!=", "ADMIN")
            ->get();
    }

    public function render()
    {
        return view('livewire.search');
    }
}
