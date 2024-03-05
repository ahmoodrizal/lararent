<x-app-layout>
    <!-- Page Section -->
    <div class="container p-4 mx-auto lg:p-8 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-8">
            <!-- Tickets -->
            <div class="flex flex-col bg-white border rounded-lg sm:col-span-2 lg:col-span-4">
                <div class="p-5">
                    <!-- Responsive Table Container -->
                    <div class="min-w-full overflow-x-auto rounded">
                        <div class="flex items-center justify-between mb-6">
                            <h1 class="mb-1 text-xl font-bold">{{ $court->name }} Detail</h1>
                            <form action="{{ route('admin.courts.toggle', $court) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit"
                                    class="inline-block px-3 py-2 text-xs font-semibold leading-4 {{ !$court->is_active ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-md whitespace-nowrap uppercase mb-4">
                                    {{ $court->is_active ? 'Set to Maintenance' : 'Set to Active' }}
                                </button>
                            </form>
                        </div>
                        <div class="grid grid-cols-2">
                            <img src="{{ Storage::url('banners/' . $court->banner) }}" alt="banner"
                                class="rounded-md h-80">
                            <div class="flex flex-col div gap-y-2">
                                <div class="flex items-center justify-between text-sm">
                                    <h1 class="font-medium">Name</h1>
                                    <h1 class="text-left capitalize">{{ $court->name }}</h1>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <h1 class="font-medium">Type</h1>
                                    <h1 class="text-left capitalize">Lapangan {{ $court->type }}</h1>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <h1 class="font-medium">Weekday Price</h1>
                                    <h1 class="text-left"> {{ Number::currency($court->weekday_price, 'IDR', 'id_ID') }}
                                    </h1>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <h1 class="font-medium">Weekend Price</h1>
                                    <h1 class="text-left"> {{ Number::currency($court->weekend_price, 'IDR', 'id_ID') }}
                                    </h1>
                                </div>
                                <div class="flex items-center justify-between mt-2 text-sm">
                                    <h1 class="font-medium">Status</h1>
                                    <h1
                                        class="inline-block px-2 py-1 text-xs font-semibold leading-4 {{ $court->is_active ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-full whitespace-nowrap uppercase"">
                                        {{ $court->is_active ? 'Active' : 'Maintenance' }}
                                    </h1>
                                </div>
                                <div class="flex flex-col items-start justify-between mt-4 text-sm gap-y-2">
                                    <h1 class="font-medium">Description</h1>
                                    <h1 class="leading-relaxed capitalize ">{{ $court->description }}</h1>
                                </div>
                                <div class="flex justify-end">
                                    <a href="{{ route('admin.courts.edit', $court) }}"
                                        class="px-3 py-2 mt-6 text-xs font-medium text-center text-indigo-600 border-2 border-indigo-600 rounded-md max-w-fit">
                                        Update Court Data
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Responsive Table Container -->
                </div>
            </div>
            <!-- END Tickets -->
        </div>
    </div>
    <!-- END Page Section -->
</x-app-layout>
