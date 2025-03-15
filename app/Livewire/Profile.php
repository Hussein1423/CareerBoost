<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;

class Profile extends Component
{


    use WithFileUploads;

    public $cv;
    public $jobTitle;
    public $jobDescription;

    public function generateDescription()
    {

    }



    public function render()
    {
        return view('livewire.profile');
    }
}

