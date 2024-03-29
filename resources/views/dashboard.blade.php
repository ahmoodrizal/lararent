<x-app-layout>
    <!-- Page Heading -->
    <div class="container px-4 pt-6 mx-auto lg:px-8 lg:pt-8 xl:max-w-7xl">
        @if (session('success'))
            <x-alert :type="__('success')">{{ session('success') }}</x-alert>
        @endif
        @if (session('warning'))
            <x-alert :type="__('warning')">{{ session('warning') }}</x-alert>
        @endif
        <div class="flex flex-col gap-2 text-center sm:flex-row sm:items-center sm:justify-between sm:text-start">
            <div class="grow">
                <h1 class="mb-1 text-xl font-bold">Latest Transactions</h1>
                {{-- <h2 class="text-sm font-medium text-neutral-500">
                    Welcome, you have <strong>5 open tickets</strong> and
                    <strong>3 notifications</strong>.
                </h2> --}}
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
                    <input type="text" id="search" name="search" placeholder="Search transactions"
                        class="block w-full py-2 text-sm leading-6 border rounded-lg border-neutral-200 pe-3 ps-10 placeholder-neutral-500 focus:border-neutral-500 focus:ring focus:ring-neutral-500 focus:ring-opacity-25" />
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Heading -->

    <!-- Page Section -->
    <div class="container p-4 mx-auto lg:p-8 xl:max-w-7xl">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
            <!-- Quick Statistics -->
            <a href="javascript:void(0)"
                class="flex flex-col bg-white border rounded-lg border-neutral-200 hover:border-neutral-300 active:border-neutral-200">
                <div class="flex items-center justify-between p-5 grow">
                    <dl>
                        <dt class="text-2xl font-bold">{{ $today['count'] }}</dt>
                        <dd class="text-sm font-medium text-neutral-500">
                            Active Schedules
                        </dd>
                    </dl>
                </div>
                <div class="px-5 py-3 text-xs font-medium text-orange-500 border-t border-neutral-100">
                    Today's Schedules
                </div>
            </a>
            <a href="javascript:void(0)"
                class="flex flex-col bg-white border rounded-lg border-neutral-200 hover:border-neutral-300 active:border-neutral-200">
                <div class="flex items-center justify-between p-5 grow">
                    <dl>
                        <dt class="text-2xl font-bold">{{ $revenueData['count'] }}</dt>
                        <dd class="text-sm font-medium text-neutral-500">
                            Transactions
                        </dd>
                    </dl>
                </div>
                <div class="px-5 py-3 text-xs font-medium border-t border-neutral-100 text-neutral-500">
                    This Month
                </div>
            </a>
            <a href="javascript:void(0)"
                class="flex flex-col bg-white border rounded-lg border-neutral-200 hover:border-neutral-300 active:border-neutral-200">
                <div class="flex items-center justify-between p-5 grow">
                    <dl>
                        <dt class="text-2xl font-bold"> {{ Number::currency($revenueData['sum'] ?? 0, 'IDR', 'id_ID') }}
                        </dt>
                        <dd class="text-sm font-medium text-neutral-500">
                            Total Income
                        </dd>
                    </dl>
                </div>
                <div class="px-5 py-3 text-xs font-medium border-t border-neutral-100 text-neutral-500">
                    This Month
                </div>
            </a>
            <!-- END Quick Statistics -->

            {{-- Manual Booking Modal Start --}}
            @include('admin.court.manual_booking')
            {{-- Manual Booking Modal End --}}


            <!-- Tickets -->
            <div class="flex flex-col bg-white border rounded-lg sm:col-span-2 lg:col-span-4">
                <div
                    class="flex flex-col items-center justify-between gap-4 p-5 text-center border-b border-neutral-100 sm:flex-row sm:text-start">
                    <div>
                        <h2 class="mb-0.5 font-semibold">Recent transactions</h2>
                    </div>
                    <div class="flex items-center gap-x-5">
                        <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'manual-booking')"
                            class="inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-semibold leading-5 text-white bg-orange-400 border rounded-lg border-neutral-200 hover:border-neutral-300 active:border-neutral-200"
                            href="javascript:void(0)">Create Manual Booking</a>
                        {{-- <a href="javascript:void(0)"
                            class="inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-semibold leading-5 bg-white border rounded-lg border-neutral-200 text-neutral-800 hover:border-neutral-300 hover:text-neutral-950 active:border-neutral-200">
                            View all transactions
                        </a> --}}
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
                                        TRX-ID
                                    </th>
                                    <th
                                        class="min-w-[180px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Customer Name
                                    </th>
                                    <th
                                        class="min-w-[180px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Court
                                    </th>
                                    <th
                                        class="min-w-[180px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Booking Time
                                    </th>
                                    <th
                                        class="min-w-[180px] px-3 py-2 text-start text-sm font-semibold uppercase tracking-wider text-neutral-700">
                                        Total
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
                                @forelse ($transactions as $transaction)
                                    @include('admin.transaction.show')
                                    <tr class="border-b border-neutral-100 hover:bg-neutral-50">
                                        <td class="p-3 font-semibold text-start text-neutral-600">
                                            {{ $transaction->unique_code }}
                                        </td>
                                        <td class="p-3 font-medium text-neutral-600">
                                            <a href="{{ route('admin.users.show', $transaction->user) }}"
                                                class="underline decoration-neutral-200 decoration-2 underline-offset-4 hover:text-neutral-950 hover:decoration-neutral-300">
                                                {{ $transaction->user->name }} </a>
                                        </td>
                                        <td class="p-3 font-medium text-neutral-600">
                                            <a href="{{ route('admin.courts.show', $transaction->court) }}"
                                                class="underline decoration-neutral-200 decoration-2 underline-offset-4 hover:text-neutral-950 hover:decoration-neutral-300">
                                                {{ $transaction->court->name }} </a>
                                        </td>
                                        <td class="p-3 text-start">
                                            {{ $transaction->booking_start->format('j F Y | H:i') }}
                                            {{ $transaction->booking_end->format('- H:i') }}
                                        </td>
                                        <td class="p-3 font-medium">
                                            {{ Number::currency($transaction->total_price, 'IDR', 'id_ID') }}
                                        </td>
                                        <td class="p-3 font-medium">
                                            <x-chirp :status="$transaction->status">{{ $transaction->status }}</x-chirp>
                                        </td>
                                        <td class="p-3 font-medium text-end">
                                            <a x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'transaction-detail-{{ $transaction->id }}')"
                                                href="javascript:void(0)"
                                                class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold leading-5 bg-white border rounded-lg border-neutral-200 text-neutral-800 hover:border-neutral-300 hover:text-neutral-950 active:border-neutral-200">
                                                <span>Detail</span>
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
                                        <td colspan="7" class="px-3 py-8 font-semibold text-center text-neutral-600">
                                            Transactions Data Not Found
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
