 <div class="container px-4 mx-auto lg:px-8 xl:max-w-7xl">
     <div class="flex justify-between py-5 lg:py-0">
         <!-- Left Section -->
         <div class="flex items-center gap-2 lg:gap-6">
             <!-- Logo -->
             <a href="javascript:void(0)"
                 class="group inline-flex mb-2 items-baseline gap-1.5 text-lg font-bold tracking-wide text-neutral-900 hover:text-neutral-600">
                 <svg width="28" height="28" viewBox="0 0 95 95" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path
                         d="M48.925 0.00716058C44.3175 0.149661 40.755 3.99716 40.8975 8.55716C40.945 9.69716 41.1825 10.7897 41.6575 11.8822L43.035 14.9222C43.225 15.5397 42.8925 16.2047 42.2275 16.3947C41.8 16.6322 41.325 16.3947 40.9925 16.0147L38.9975 13.4022C37.43 11.4072 35.055 10.1722 32.5375 10.1247C27.93 10.0297 24.13 13.6872 24.035 18.2472C23.9875 20.2422 24.6525 22.1422 25.8875 23.7572L27.8825 26.1322H27.93C28.31 26.7497 28.1675 27.5097 27.645 27.8897C27.2175 28.2222 26.6475 28.2222 26.2675 27.8897L23.75 25.8947C22.135 24.6597 20.1875 23.9947 18.24 24.0422C13.68 24.1372 10.0225 27.9372 10.1175 32.5447C10.165 35.0622 11.4 37.4372 13.395 39.0047L16.1025 41.0947C16.625 41.5697 16.625 42.3297 16.055 42.7572C15.8987 42.9192 15.6962 43.0289 15.4751 43.0714C15.254 43.114 15.0252 43.0871 14.82 42.9947H14.7725L11.875 41.6647C10.7825 41.2372 9.69 40.9522 8.55 40.9047C3.99 40.7622 0.1425 44.3722 0 48.9797C0 52.3997 1.9 55.5347 5.035 56.8647L59.1375 80.9472L80.94 59.1447L56.8575 5.04216C55.5275 1.85966 52.25 -0.135339 48.925 0.00716058ZM52.8675 19.4822C54.8625 19.4347 56.6675 20.5747 57.4275 22.3797L71.915 54.8697L53.1525 36.1547L48.735 26.1322C47.31 23.1397 49.495 19.5772 52.8675 19.4822ZM37.2875 32.5447C38.57 32.5447 39.7575 33.0197 40.66 33.9697L63.5075 56.8172C65.4075 58.6222 65.455 61.6147 63.65 63.5147C61.75 65.4147 58.805 65.4622 56.81 63.5147L33.9625 40.6672C33.5107 40.237 33.1494 39.721 32.8995 39.1494C32.6497 38.5778 32.5165 37.9621 32.5076 37.3384C32.4988 36.7146 32.6145 36.0954 32.848 35.5169C33.0815 34.9385 33.4281 34.4125 33.8675 33.9697C34.77 33.0197 36.005 32.5447 37.2875 32.5447ZM24.3675 48.3147C24.985 48.3147 25.65 48.5047 26.125 48.7422L36.2425 53.2072L54.9575 71.9222L22.3725 57.4347C17.5275 55.3447 19.1425 48.1722 24.3675 48.3147ZM86.83 66.6972L66.69 86.8372L70.7275 90.8747C74.3375 94.4372 79.5625 95.8147 84.455 94.5322C86.8641 93.8739 89.0599 92.5989 90.8258 90.833C92.5917 89.0671 93.8667 86.8712 94.525 84.4622C95.8075 79.5697 94.43 74.3447 90.8675 70.7347L86.83 66.6972Z"
                         fill="#FBA834" />
                 </svg>

                 <span class="font-medium font-header text-[22px] text-[#FBA834]">Sewa.In</span>
             </a>
             <!-- END Logo -->

             <!-- Desktop Navigation -->
             <nav class="items-center hidden gap-2 lg:flex">
                 <x-linku :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                     {{ __('Dashboard') }}
                 </x-linku>
                 @if (Auth::user()->role == 'admin')
                     <x-linku :href="route('admin.courts.index')" :active="request()->routeIs('admin.courts.*')">
                         {{ __('Courts') }}
                     </x-linku>
                     <x-linku :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                         {{ __('Customers') }}
                     </x-linku>
                 @endif
             </nav>
             <!-- END Desktop Navigation -->
         </div>
         <!-- END Left Section -->

         <!-- Right Section -->
         <div class="flex items-center gap-2">
             <!-- User Dropdown -->
             <div class="relative inline-block">
                 <!-- Dropdown Toggle Button -->
                 <button x-on:click="userDropdownOpen = !userDropdownOpen" x-bind:aria-expanded="userDropdownOpen"
                     type="button" id="dropdown-user"
                     class="inline-flex items-center justify-center gap-1 px-3 py-2 text-sm font-semibold leading-5 bg-white border rounded-lg border-neutral-200 text-neutral-800 hover:border-neutral-300 hover:text-neutral-950 active:border-neutral-200"
                     aria-haspopup="true">
                     <svg class="inline-block w-5 h-5 hi-mini hi-user-circle sm:hidden"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                         <path fill-rule="evenodd"
                             d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z"
                             clip-rule="evenodd" />
                     </svg>
                     <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                     <svg class="hidden w-5 h-5 hi-mini hi-chevron-down opacity-40 sm:inline-block"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                         <path fill-rule="evenodd"
                             d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                             clip-rule="evenodd" />
                     </svg>
                 </button>
                 <!-- END Dropdown Toggle Button -->

                 <!-- Dropdown -->
                 <div x-cloak x-show="userDropdownOpen" x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0" x-on:click.outside="userDropdownOpen = false" role="menu"
                     aria-labelledby="dropdown-user"
                     class="absolute z-10 w-40 mt-2 rounded-lg shadow-xl end-0 ltr:origin-top-right rtl:origin-top-left">
                     <div class="rounded-lg bg-white py-2.5 ring-1 ring-black ring-opacity-5">
                         <a role="menuitem" href="{{ route('profile.edit') }}"
                             class="group flex items-center justify-between gap-1.5 px-4 py-1.5 text-sm font-medium text-neutral-700 hover:bg-neutral-100 hover:text-neutral-950">
                             <span class="grow">Account</span>
                         </a>
                         <hr class="my-2.5 border-neutral-100" />
                         <form method="post" action="{{ route('logout') }}">
                             @csrf
                             <button type="submit" role="menuitem"
                                 class="group flex w-full items-center justify-between gap-1.5 px-4 py-1.5 text-start text-sm font-medium text-neutral-700 hover:bg-neutral-100 hover:text-neutral-950">
                                 <span class="grow">Sign out</span>
                             </button>
                         </form>
                     </div>
                 </div>
                 <!-- END Dropdown -->
             </div>
             <!-- END User Dropdown -->

             <!-- Toggle Mobile Navigation -->
             <div class="lg:hidden">
                 <button x-on:click="mobileNavOpen = !mobileNavOpen" type="button"
                     class="inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold leading-5 bg-white border rounded-lg border-neutral-200 text-neutral-800 hover:border-neutral-300 hover:text-neutral-950 active:border-neutral-200">
                     <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                         class="inline-block w-5 h-5 hi-solid hi-menu">
                         <path fill-rule="evenodd"
                             d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                             clip-rule="evenodd"></path>
                     </svg>
                 </button>
             </div>
             <!-- END Toggle Mobile Navigation -->
         </div>
         <!-- END Right Section -->
     </div>

     <!-- Mobile Navigation -->
     <div x-cloak x-show="mobileNavOpen" class="lg:hidden">
         <nav class="flex flex-col gap-2 py-4 border-t border-neutral-200">
             <x-linku :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                 {{ __('Dashboard') }}
             </x-linku>
             @if (Auth::user()->role == 'admin')
                 <x-linku :href="route('admin.courts.index')" :active="request()->routeIs('admin.courts.*')">
                     {{ __('Courts') }}
                 </x-linku>
                 <x-linku :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                     {{ __('Customers') }}
                 </x-linku>
             @endif
         </nav>
     </div>
     <!-- END Mobile Navigation -->
 </div>
