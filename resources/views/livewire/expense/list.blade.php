<?php

use Livewire\Volt\Component;

new class extends Component {
    public $categories;

    public function with(): array
    {
        return [
            'title'=>'Show Notes',
          //  'notes'=>Auth::user()->notes()->orderBy('id','asc')->get()
            'categories'=>\App\Models\Category::all()
        ];
    }
}; ?>

<div>

</div>
