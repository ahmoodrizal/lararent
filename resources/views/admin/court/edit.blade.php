<x-app-layout>
    <!-- Page Heading -->
    <div class="container px-4 pt-6 mx-auto lg:px-8 lg:pt-8 xl:max-w-7xl">
        <div class="flex flex-col gap-2 text-center sm:flex-row sm:items-center sm:justify-between sm:text-start">
            <div class="grow">
                <h1 class="mb-1 text-xl font-bold">Update Court Data</h1>
            </div>
        </div>
    </div>
    <!-- END Page Heading -->

    <!-- Page Section -->
    <div class="container p-4 mx-auto lg:p-8 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-8">
            <!-- Tickets -->
            <div class="flex flex-col bg-white border rounded-lg sm:col-span-2 lg:col-span-4">
                <div class="p-5">
                    <!-- Responsive Table Container -->
                    <div class="min-w-full overflow-x-auto rounded">
                        <form action="{{ route('admin.courts.update', $court) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="grid grid-cols-3 mb-6 gap-x-3 gap-y-4">
                                <div>
                                    <x-input-label for="name" :value="__('Court Name')" />
                                    <x-text-input id="name" value="{{ old('name', $court->name) }}" name="name"
                                        type="text" class="block w-full mt-1" />
                                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                </div>
                                <div class="">
                                    <label for="countries"
                                        class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                                    <select id="countries" name="type"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option selected>Pilih Tipe Lapangan</option>
                                        <option value="futsal" @selected($court->type == 'futsal')>Lapangan Futsal</option>
                                        <option value="badminton" @selected($court->type == 'badminton')>Lapangan Badminton
                                        </option>
                                    </select>
                                </div>
                                <div class="">
                                    <label class="block mb-1 text-sm font-medium text-gray-900" for="file_input">Upload
                                        Court Banner</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                                        id="file_input" name="banner" type="file">
                                    <x-input-error class="mt-2" :messages="$errors->get('banner')" />
                                </div>
                                <div>
                                    <x-input-label for="weekday_price" :value="__('Weekday Price')" />
                                    <x-text-input id="weekday_price"
                                        value="{{ old('weekday_price', $court->weekday_price) }}" name="weekday_price"
                                        type="number" class="block w-full mt-1" />
                                    <x-input-error :messages="$errors->get('weekday_price')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="weekend_price" :value="__('Weekend Price')" />
                                    <x-text-input id="weekend_price"
                                        value="{{ old('weekend_price', $court->weekend_price) }}" name="weekend_price"
                                        type="number" class="block w-full mt-1" />
                                    <x-input-error :messages="$errors->get('weekend_price')" class="mt-2" />
                                </div>
                                <div class="col-span-2">
                                    <label for="description" class="block mb-1 text-sm font-medium text-gray-900">Event
                                        Description
                                    </label>
                                    <textarea id="description" name="description" rows="4"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Write your thoughts here...">{{ old('description', $court->description) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>
                            </div>
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                        </form>
                    </div>
                    <!-- END Responsive Table Container -->
                </div>
            </div>
            <!-- END Tickets -->
        </div>
    </div>
    <!-- END Page Section -->
</x-app-layout>
