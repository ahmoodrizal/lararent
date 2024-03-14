 <div class="container px-4 mx-auto lg:px-8 xl:max-w-7xl">
     <div class="flex justify-between py-5 lg:py-0">
         <!-- Left Section -->
         <div class="flex items-center gap-2 lg:gap-6">
             <!-- Logo -->
             <a href="javascript:void(0)"
                 class="group inline-flex items-center gap-1.5 text-lg font-bold tracking-wide text-neutral-900 hover:text-neutral-600">
                 <svg class="inline-block w-5 h-5 transition hi-mini hi-lifebuoy text-neutral-950 group-hover:scale-110 group-active:scale-100"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                     <path fill-rule="evenodd"
                         d="M7.171 4.146l1.947 2.466a3.514 3.514 0 011.764 0l1.947-2.466a6.52 6.52 0 00-5.658 0zm8.683 3.025l-2.466 1.947c.15.578.15 1.186 0 1.764l2.466 1.947a6.52 6.52 0 000-5.658zm-3.025 8.683l-1.947-2.466c-.578.15-1.186.15-1.764 0l-1.947 2.466a6.52 6.52 0 005.658 0zM4.146 12.83l2.466-1.947a3.514 3.514 0 010-1.764L4.146 7.171a6.52 6.52 0 000 5.658zM5.63 3.297a8.01 8.01 0 018.738 0 8.031 8.031 0 012.334 2.334 8.01 8.01 0 010 8.738 8.033 8.033 0 01-2.334 2.334 8.01 8.01 0 01-8.738 0 8.032 8.032 0 01-2.334-2.334 8.01 8.01 0 010-8.738A8.03 8.03 0 015.63 3.297zm5.198 4.882a2.008 2.008 0 00-2.243.407 1.994 1.994 0 00-.407 2.243 1.993 1.993 0 00.992.992 2.008 2.008 0 002.243-.407c.176-.175.31-.374.407-.585a2.008 2.008 0 00-.407-2.243 1.993 1.993 0 00-.585-.407z"
                         clip-rule="evenodd" />
                 </svg>
                 <span>Tail<span class="font-normal">Desk</span></span>
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
