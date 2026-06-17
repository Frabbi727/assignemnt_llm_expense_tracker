<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithFileUploads;

    public $amount;
    public $expense_date;
    public $category_name;
    public $description;
    public $receipt;

    protected $rules = [
        'amount' => 'required|numeric|min:0',
        'expense_date' => 'required|date',
        'category_name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'receipt' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function mount()
    {
        $this->expense_date = now()->format('Y-m-d');
    }

    public function updatedReceipt()
    {
        $this->validateOnly('receipt');

        // Simulate AI/OCR processing delay
        sleep(1); 

        // Mock data extraction
        $this->amount = 42.50;
        $this->expense_date = now()->format('Y-m-d');
        $this->description = 'Mock Merchant from Receipt';
        $this->category_name = 'Food & Drinks';

        session()->flash('ocr_success', 'Receipt processed successfully via AI!');
    }

    public function save()
    {
        $this->validate();

        // Dynamic category creation
        $category = Category::firstOrCreate([
            'name' => trim($this->category_name)
        ]);

        $receiptPath = null;
        if ($this->receipt) {
            $receiptPath = $this->receipt->store('receipts', 'public');
        }

        Expense::create([
            'category_id' => $category->id,
            'amount' => $this->amount,
            'expense_date' => $this->expense_date,
            'description' => $this->description,
            'receipt_path' => $receiptPath,
        ]);

        $this->reset(['amount', 'description', 'receipt', 'category_name']);
        $this->expense_date = now()->format('Y-m-d');

        $this->dispatch('expense-saved');
        session()->flash('message', 'Expense saved successfully.');
    }
};
?>

<div class="p-6 bg-white dark:bg-[#161615] shadow-sm rounded-lg border border-gray-200 dark:border-[#3E3E3A]">
    <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-[#EDEDEC]">Add New Expense</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-2 bg-green-100 text-green-800 rounded text-sm">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('ocr_success'))
        <div class="mb-4 p-2 bg-blue-100 text-blue-800 rounded text-sm">
            {{ session('ocr_success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-[#A1A09A]">Amount</label>
            <input type="number" step="0.01" wire:model="amount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-[#0a0a0a] dark:border-[#3E3E3A] dark:text-white" required>
            @error('amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-[#A1A09A]">Date</label>
            <input type="date" wire:model="expense_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-[#0a0a0a] dark:border-[#3E3E3A] dark:text-white" required>
            @error('expense_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-[#A1A09A]">Category</label>
            <input list="categories" wire:model="category_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-[#0a0a0a] dark:border-[#3E3E3A] dark:text-white" placeholder="Type or select a category" required>
            <datalist id="categories">
                @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->name }}">
                @endforeach
            </datalist>
            @error('category_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-[#A1A09A]">Description/Merchant</label>
            <input type="text" wire:model="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-[#0a0a0a] dark:border-[#3E3E3A] dark:text-white">
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-[#A1A09A]">Receipt (Image)</label>
            <input type="file" wire:model="receipt" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            <div wire:loading wire:target="receipt" class="text-xs text-blue-500 mt-1">Processing receipt...</div>
            @error('receipt') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Save Expense
        </button>
    </form>
</div>
