<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Expense;
use Carbon\Carbon;

new class extends Component
{
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
    }

    #[On('expense-saved')]
    public function refresh()
    {
        // This will trigger a re-render
    }

    public function getExpensesProperty()
    {
        return Expense::with('category')
            ->whereBetween('expense_date', [$this->startDate, $this->endDate])
            ->orderBy('expense_date', 'desc')
            ->get();
    }

    public function getMonthlySummariesProperty()
    {
        return Expense::selectRaw("DATE_FORMAT(expense_date, '%Y-%m') as month, SUM(amount) as total")
            ->whereBetween('expense_date', [$this->startDate, $this->endDate])
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();
    }

    public function getCategorySummariesProperty()
    {
        return Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category, SUM(amount) as total')
            ->whereBetween('expense_date', [$this->startDate, $this->endDate])
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();
    }
};
?>

<div class="space-y-6">
    <div class="p-6 bg-white dark:bg-[#161615] shadow-sm rounded-lg border border-gray-200 dark:border-[#3E3E3A]">
        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-[#EDEDEC]">Filters</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-[#A1A09A]">Start Date</label>
                <input type="date" wire:model.live="startDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm dark:bg-[#0a0a0a] dark:border-[#3E3E3A] dark:text-white">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-[#A1A09A]">End Date</label>
                <input type="date" wire:model.live="endDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm dark:bg-[#0a0a0a] dark:border-[#3E3E3A] dark:text-white">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Monthly Summary -->
        <div class="p-6 bg-white dark:bg-[#161615] shadow-sm rounded-lg border border-gray-200 dark:border-[#3E3E3A]">
            <h3 class="text-md font-medium mb-3 text-gray-900 dark:text-[#EDEDEC]">Monthly Summary</h3>
            <div class="space-y-2">
                @foreach($this->monthlySummaries as $summary)
                    <div class="flex justify-between items-center border-b border-gray-100 dark:border-[#3E3E3A] pb-2">
                        <span class="text-gray-600 dark:text-[#A1A09A]">{{ \Carbon\Carbon::parse($summary->month . '-01')->format('F Y') }}</span>
                        <span class="font-bold text-gray-900 dark:text-white">${{ number_format($summary->total, 2) }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Category Summary -->
        <div class="p-6 bg-white dark:bg-[#161615] shadow-sm rounded-lg border border-gray-200 dark:border-[#3E3E3A]">
            <h3 class="text-md font-medium mb-3 text-gray-900 dark:text-[#EDEDEC]">Category Breakdown</h3>
            <div class="space-y-2">
                @foreach($this->categorySummaries as $summary)
                    <div class="flex justify-between items-center border-b border-gray-100 dark:border-[#3E3E3A] pb-2">
                        <span class="text-gray-600 dark:text-[#A1A09A]">{{ $summary->category }}</span>
                        <span class="font-bold text-gray-900 dark:text-white">${{ number_format($summary->total, 2) }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Expense List -->
    <div class="p-6 bg-white dark:bg-[#161615] shadow-sm rounded-lg border border-gray-200 dark:border-[#3E3E3A]">
        <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-[#EDEDEC]">Expense List</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-[#3E3E3A]">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-[#A1A09A]">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-[#A1A09A]">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-[#A1A09A]">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-[#A1A09A]">Description</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-[#3E3E3A]">
                    @foreach($this->expenses as $expense)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-[#EDEDEC]">{{ $expense->expense_date->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-[#EDEDEC]">{{ $expense->category->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 dark:text-[#EDEDEC]">${{ number_format($expense->amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-[#A1A09A]">{{ $expense->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
