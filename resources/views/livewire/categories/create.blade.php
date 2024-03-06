<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use WireUi\Traits\Actions;
use App\Models\Category;

new #[Layout('layouts.app')] class extends Component {
    use Actions;
    public Category $category;
    public $name;

    public function mount(Category $category){
        $this->name=$category->name??'';
    }
public function saveCategory(){
    $validated=$this->validate([
        'name'=>['required','string','min:5'],
        ]);
    if(isset($this->category->id)){
        $this->category->update([
           'name'=>$this->name
        ]);
        $this->notification()->success(
            $title = 'Category Updated',
            $description = 'Your Category is successfully updated '
        );
    }else{
        Category::create([
            'name'=>$this->name
        ]);
        $this->notification()->success(
            $title = 'Category Added',
            $description = 'Your Category is successfully Added '
        );
    }

}
    //
}; ?>

<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
        <x-button primary href="{{route('categories.index')}}">Back To All Categories</x-button>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form wire:submit="saveCategory" class="space-y-4">
                    <x-input wire:model="name" label="Category Title" placeholder="Services, Food .etc."></x-input>
                    <div class="pt-4 flex justify-between">
                        <x-button type="submit"  secondary right-icon="save" spinner="saveCategory">Save Category</x-button>
                    </div>
                    <x-errors />
                </form>
            </div>
        </div>
    </div>
</div>
