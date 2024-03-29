<x-app-layout>
    <!-- Page Heading -->
    <div class="container px-4 pt-6 mx-auto lg:px-8 lg:pt-8 xl:max-w-7xl">
        <div class="flex flex-col gap-2 text-center sm:flex-row sm:items-center sm:justify-between sm:text-start">
            <div class="grow">
                <h1 class="mb-1 text-xl font-bold">Users Data</h1>
            </div>
            <div class="flex items-center justify-center flex-none gap-2 rounded sm:justify-end">
                <div class="relative">
                    <div
                        class="absolute inset-y-0 flex items-center justify-center w-10 my-px rounded-l-lg pointer-events-none start-0 ms-px text-neutral-500">
                        <svg class="inline-block w-5 h-5 hi-mini hi-magnifying-glass" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="search" name="search" placeholder="Search users"
                        class="block w-full py-2 text-sm leading-6 border rounded-lg border-neutral-200 pe-3 ps-10 placeholder-neutral-500 focus:border-neutral-500 focus:ring focus:ring-neutral-500 focus:ring-opacity-25" />
                </div>
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
                        <!-- Alternate Responsive Table -->
                        <table class="min-w-full text-sm align-middle">
                            <!-- Table Header -->
                            <thead>
                                <tr class="border-b-2 border-neutral-100">
                                    <th
                                        class="min-w-[140px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        ID
                                    </th>
                                    <th
                                        class="min-w-[180px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Date Joined
                                    </th>
                                    <th
                                        class="min-w-[180px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Customer Name
                                    </th>
                                    <th
                                        class="min-w-[180px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Email
                                    </th>
                                    <th
                                        class="px-3 py-2 text-sm font-semibold tracking-wider uppercase text-start text-neutral-700">
                                        Role
                                    </th>
                                    <th
                                        class="min-w-[100px] p-3 py-2 text-end text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                    </th>
                                </tr>
                            </thead>
                            <!-- END Table Header -->

                            <!-- Table Body -->
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="border-b border-neutral-100 hover:bg-neutral-50">
                                        <td class="p-3 font-semibold text-start text-neutral-600">
                                            RN #{{ $user->id }}
                                        </td>
                                        <td class="p-3 text-start text-neutral-600">
                                            {{ $user->created_at->format('j F Y') }}
                                        </td>
                                        <td class="p-3 font-medium text-neutral-600">
                                            <a href="javascript:void(0)"
                                                class="underline decoration-neutral-200 decoration-2 underline-offset-4 hover:text-neutral-950 hover:decoration-neutral-300">{{ $user->name }}</a>
                                        </td>
                                        <td class="p-3 text-start">
                                            {{ $user->email }}
                                        </td>
                                        <td class="p-3 font-medium">
                                            <div
                                                class="inline-block px-2 py-1 text-xs font-semibold leading-4 rounded-full whitespace-nowrap uppercase {{ $user->role == 'admin' ? 'text-purple-800 bg-purple-100' : 'text-orange-800 bg-orange-100' }}">
                                                {{ $user->role }}
                                            </div>
                                        </td>
                                        <td class="p-3 font-medium text-end">
                                            <a href="{{ route('admin.users.show', $user) }}"
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
                                        <td class="p-3 font-semibold text-center text-neutral-600">
                                            Users Data Not Found
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
