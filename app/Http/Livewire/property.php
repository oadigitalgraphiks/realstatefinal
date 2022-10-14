<?php

namespace App\Http\Livewire;
use Livewire\Component;

class property extends Component
{

    public $name;

    public function mount(){

        $this->name = "owais1";   

    }


    public function render()
    {
        return <<<'blade'
            <div>
               
                {{$name}}


                      <p>  sdfsdf</p>
            
            </div>
        blade;
    }
}
