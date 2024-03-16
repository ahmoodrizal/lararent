<x-app-layout>
    <!-- Page Heading -->
    <!-- END Page Heading -->

    <!-- Page Section -->
    <div class="container p-4 mx-auto lg:p-8 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 lg:gap-8">
            <!-- Tickets -->
            <div class="flex flex-col bg-white border rounded-lg sm:col-span-2 lg:col-span-4">
                <div
                    class="flex flex-col items-center justify-between gap-4 p-5 text-center border-b border-neutral-100 sm:flex-row sm:text-start">
                    <div>
                        <h2 class="mb-0.5 font-semibold">Courts Data</h2>
                    </div>
                    <div>
                        <a href="{{ route('admin.courts.create') }}"
                            class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold leading-5 bg-white border rounded-lg border-neutral-200 text-neutral-800 hover:border-neutral-300 hover:text-neutral-950 active:border-neutral-200">
                            Create New Court
                        </a>
                    </div>
                </div>
                <div class="p-5">
                    <!-- Responsive Table Container -->
                    <div class="min-w-full overflow-x-auto rounded">
                        <!-- Alternate Responsive Table -->
                        <table class="min-w-full text-sm align-middle">
                            <!-- Table Header -->
                            <thead>
                                <tr class="border-b-2 border-neutral-100">
                                    <th
                                        class="min-w-[140px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Court Name
                                    </th>
                                    <th
                                        class="px-3 py-2 text-sm font-semibold tracking-wider uppercase text-start text-neutral-700">
                                        Court Type
                                    </th>
                                    <th
                                        class="min-w-[180px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Weekday Price / Hour
                                    </th>
                                    <th
                                        class="min-w-[180px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Weekend Price / Hour
                                    </th>
                                    <th
                                        class="px-3 py-2 text-sm font-semibold tracking-wider uppercase text-start text-neutral-700">
                                        Status
                                    </th>
                                    <th
                                        class="min-w-[100px] p-3 py-2 text-end text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                    </th>
                                </tr>
                            </thead>
                            <!-- END Table Header -->

                            <!-- Table Body -->
                            <tbody>
                                @forelse ($courts as $court)
                                    <tr class="border-b border-neutral-100 hover:bg-neutral-50">
                                        <td class="p-3 font-semibold text-start text-neutral-600">
                                            {{ $court->name }}
                                        </td>
                                        <td class="p-3 font-medium">
                                            <div
                                                class="inline-block px-2 py-1 text-xs font-semibold leading-4 {{ $court->type == 'futsal' ? 'text-yellow-800 bg-yellow-100' : 'text-blue-800 bg-blue-100' }} rounded-full whitespace-nowrap uppercase">
                                                {{ $court->type }}
                                            </div>
                                        </td>
                                        <td class="p-3 text-start">
                                            {{ Number::currency($court->weekday_price, 'IDR', 'id_ID') }}
                                        </td>
                                        <td class="p-3 text-start">
                                            {{ Number::currency($court->weekend_price, 'IDR', 'id_ID') }}
                                        </td>
                                        <td class="p-3 font-medium">
                                            <div
                                                class="inline-block px-2 py-1 text-xs font-semibold leading-4 {{ $court->is_active ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} rounded-full whitespace-nowrap uppercase">
                                                {{ $court->is_active ? 'Active' : 'Under Maintenance' }}
                                            </div>
                                        </td>
                                        <td class="p-3 font-medium text-end">
                                            <a href="{{ route('admin.courts.show', $court) }}"
                                                class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold leading-5 bg-white border rounded-lg border-neutral-200 text-neutral-800 hover:border-neutral-300 hover:text-neutral-950 active:border-neutral-200">
                                                <span>View</span>
                                                <svg class="hi-mini hi-arrow-right inline-block h-5 w-5 text-neutral-400 group-hover:text-blue-600 group-active:translate-x-0.5"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd"
                                                        d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="border-b border-neutral-100 hover:bg-neutral-50">
                                        <td colspan="6" class="p-3 font-semibold text-center text-neutral-600">
                                            Courts Data Not Found
                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>
                            <!-- END Table Body -->
                        </table>
                        <!-- END Alternate Responsive Table -->
                    </div>
                    <!-- END Responsive Table Container -->
                </div>
            </div>
            <!-- END Tickets -->
        </div>
    </div>
    <!-- END Page Section -->
</x-app-layout>
