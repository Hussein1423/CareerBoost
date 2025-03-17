<?php

namespace App\Livewire\CareerAI;

use Livewire\Component;
use Livewire\WithFileUploads;

class UplaodJobProfile extends Component
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
        return view('livewire.careerAI.uplaod-job-profile');
    }
}
