<x-modal name="manual-booking" :show="$errors->isNotEmpty()" focusable>
    <form method="post" action="{{ route('admin.transactions.create') }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Create Manual Booking') }}
        </h2>

        <div class="grid grid-cols-2 gap-4 mt-6">
            <div class="">
                <select id="Lapangan" name="court_id"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option selected>Pilih Lapangan</option>
                    @foreach ($courts as $court)
                        <option class="capitalize" value="{{ $court->id }}">{{ $court->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('court_id')" class="mt-2" />
            </div>
            <div class="">
                <x-input-label for="booking_time" value="{{ __('booking_time') }}" class="sr-only" />
                <input type="datetime-local"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:zborder-indigo-500 focus:ring-indigo-500"
                    id="booking_time" name="booking_time" min="<?= date('Y-m-d\Th:i') ?>"
                    max="<?= date('Y-m-d\Th:i', strtotime('now +1 week')) ?>">
                <x-input-error :messages="$errors->get('booking_time')" class="mt-2" />
            </div>
            <div class="">
                <x-input-label for="hours" value="{{ __('Hours') }}" class="sr-only" />
                <x-text-input id="hours" name="hours" type="number" class="block w-full mt-1"
                    placeholder="{{ __('total hours') }}" />
                <x-input-error :messages="$errors->get('hours')" class="mt-2" />
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Create') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
