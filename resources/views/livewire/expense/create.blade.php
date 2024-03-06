<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use WireUi\Traits\Actions;
use App\Models\Expense;
use App\Models\Category;
new #[Layout('layouts.app')] class extends Component {
    use Actions;
    public Expense $expense;
    public $categories,$category_id,$category,$amount,$date,$description,$payment_method;

    public function mount(Expense $expense){
        $this->categories=Category::all();
        $this->category_id=$expense->category_id??'';
        $this->amount=$expense->amount??'';
        $this->date=$expense->date??'';
        $this->description=$expense->description??'';
        $this->payment_method=$expense->payment_method??'';
    }
public function saveExpense(){
    $validated=$this->validate([
        'category_id'=>['required'],
        'amount'=>['required','integer'],
        'date'=>['required','date'],
        'description'=>['nullable','string'],
        'payment_method'=>['nullable','string'],
        ]);
    if(isset($this->expense->id)){
        $this->expense->update($validated);
        $this->notification()->success(
            $title = 'Expense Updated',
            $description = 'Your Expense is successfully updated '
        );
    }else{
        auth()->user()->expense()->create($validated);
        $this->notification()->success(
            $title = 'Expense Added',
            $description = 'Your Expense is successfully Added '
        );
    }

}
    //
}; ?>

<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add new Expense') }}
        </h2>
        <x-button primary href="{{route('expense.index')}}">All Expenses</x-button>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form wire:submit="saveExpense" class="space-y-4">
                    <x-select
                        label="Category"
                        placeholder="Select Category"

                        :options="$categories"
                        option-label="name"
                        option-value="id"
                        wire:model.defer="category_id"
                    />
                    <x-input wire:model="amount" type="number" label="Expense Amount" placeholder="100"></x-input>
                    <x-textarea wire:model="description"  label="Expense Details" placeholder="Spent on Food, etc."></x-textarea>
                    <x-input wire:model="date" type="date" label="Spent Date" placeholder=""></x-input>

                    <x-select
                        label="Payment Method"
                        placeholder="Select Payment Method"
                        :options="['Credit/Debit Card', 'Bank Transfer', 'Cash', 'Other']"
                        wire:model.defer="payment_method"
                    />
                    <div class="pt-4 flex justify-between">
                        <x-button type="submit"  secondary right-icon="save" spinner="saveExpense">Save Expense</x-button>
                    </div>
                    <x-errors />
                </form>
            </div>
        </div>
    </div>
</div>
