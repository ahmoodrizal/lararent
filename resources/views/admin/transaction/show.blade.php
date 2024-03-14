<x-modal name="transaction-detail-{{ $transaction->id }}" :show="$errors->isNotEmpty()" focusable>
    <div class="p-8">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Transaction Detail') }}
        </h2>

        <div class="grid grid-cols-1 gap-3 mt-8">
            <div class="flex items-center justify-between">
                <h1 class="font-medium">Transaction Code</h1>
                <h1>{{ $transaction->unique_code }}</h1>
            </div>
            <div class="flex items-center justify-between">
                <h1 class="font-medium">Total Price</h1>
                <h1>{{ Number::currency($transaction->total_price, 'IDR', 'id_ID') }}</h1>
            </div>
            <div class="flex items-center justify-between">
                <h1 class="font-medium">Payment Method</h1>
                <h1 class="capitalize">{{ $transaction->payment_method }}</h1>
            </div>
            <div class="flex items-center justify-between">
                <h1 class="font-medium">Payment Service</h1>
                <h1 class="capitalize">{{ $transaction->payment_service }}</h1>
            </div>
            <div class="flex items-center justify-between">
                <h1 class="font-medium">Payment Code</h1>
                <h1 class="">{{ $transaction->payment_code ?? 'xxxxxxxxxx' }}</h1>
            </div>
            <div class="flex items-center justify-between">
                <h1 class="font-medium">QR Code</h1>
                <h1 class="">{{ $transaction->payment_link ?? 'xxxxxxxxxx' }}</h1>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Close') }}
            </x-secondary-button>
        </div>
    </div>
</x-modal>
