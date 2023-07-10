    @auth
        <!-- drawer component -->
        <div id="drawer-navigation"  tabindex="-1" aria-labelledby="drawer-navigation-label">
            <button id="collespe_left" type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-200 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>
                <span class="sr-only">{{__('Close menu')}}</span>
            </button>
        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                {{-- <li>
                    <a href="{{route('home.index')}}" class="flex casino-dropdown items-center w-full p-2 text-gray-200 dark:hover:text-gray-200 hover:text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                            <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
                            <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z"/>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li> --}}
                @if(Auth::user() && Auth::user()->role == 'administrator')
                    <li>
                        <a href="{{route('overview.index')}}" class="{{Route::is('overview.index') ? 'bg-gray-600' : ''}} flex casino-dropdown items-center w-full p-2 text-gray-200 dark:hover:text-gray-200 hover:text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-moon-fill" viewBox="0 0 16 16">
                                <path d="M11.473 11a4.5 4.5 0 0 0-8.72-.99A3 3 0 0 0 3 16h8.5a2.5 2.5 0 0 0 0-5h-.027z"/>
                                <path d="M11.286 1.778a.5.5 0 0 0-.565-.755 4.595 4.595 0 0 0-3.18 5.003 5.46 5.46 0 0 1 1.055.209A3.603 3.603 0 0 1 9.83 2.617a4.593 4.593 0 0 0 4.31 5.744 3.576 3.576 0 0 1-2.241.634c.162.317.295.652.394 1a4.59 4.59 0 0 0 3.624-2.04.5.5 0 0 0-.565-.755 3.593 3.593 0 0 1-4.065-5.422z"/>
                            </svg>
                            <span class="ml-3">{{ __('Overview') }}</span>
                        </a>
                    </li>
                    <li>
                        <button type="button" class="{{Route::is('workers.index') || Route::is('workers.create') ? 'bg-gray-600' : ''}} flex casino-dropdown hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">{{__('Workers')}}</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2 dropdown-items">
                            <li>
                                <a href="{{route('workers.index')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{__('All Workers')}}</a>
                            </li>
                            <li>
                                <a href="{{route('workers.create')}}" class="flex items-center w-full hover:text-gray-200 p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">Add New</a>
                            </li>
                        </ul>
                    </li>
                @endif
                
                <li>
                    <button type="button" class="{{Route::is('casinos-done-lists') || Route::is('casinos-done') || Route::is('incoming-payments') || Route::is('new-casino-done')  ? 'bg-gray-600' : '' }} flex casino-dropdown dark:hover:text-gray-200 hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5Zm-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5Zm4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5Z"/>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{__('Casinos Done')}}</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul id="dropdown-casinos" class="hidden py-2 space-y-2 dropdown-items">
                        <li>
                            <a href="{{route('casinos-done')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('All Casino') }}</a>
                        </li>
                        <li>
                            <a href="{{route('casinos-done-lists', 'reload')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('Reload') }}</a>
                        </li>
                        <li>
                            <a href="{{route('casinos-done-lists', 'sub')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('Sub-Reload') }}</a>
                        </li>
                        {{-- <li><a href="{{route('casinos-summary')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('Short Summary') }}</a></li> --}}
                        <li>
                            <a href="{{route('incoming-payments') }}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{__('Incoming Payments')}}</a>
                        </li>
                        <li>
                            <a href="{{route('new-casino-done') }}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{__('Add New')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('profit.index')}}" class="{{Route::is('profit.index') ? 'bg-gray-600' : ''}} flex casino-dropdown items-center w-full p-2 text-gray-200 hover:text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layer-forward" viewBox="0 0 16 16">
                            <path d="M8.354.146a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708l1 1a.5.5 0 0 0 .708 0L7 4.207V12H1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1H9V4.207l.646.647a.5.5 0 0 0 .708 0l1-1a.5.5 0 0 0 0-.708l-3-3z"/>
                            <path d="M1 7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h4.5a.5.5 0 0 0 0-1H1V8h4.5a.5.5 0 0 0 0-1H1zm9.5 0a.5.5 0 0 0 0 1H15v2h-4.5a.5.5 0 0 0 0 1H15a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-4.5z"/>
                        </svg>
                        <span class="ml-3">{{ __('Profit Range') }}</span>
                    </a>
                </li>

                <li>
                    <button type="button" class="{{Route::is('bonus.index') || Route::is('bonus.edit') || Route::is('bonus.create') ? 'bg-gray-600' : ''}} flex casino-dropdown hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{__('Bonus')}}</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul id="dropdown-bonus" class="hidden py-2 space-y-2 dropdown-items">
                        <li>
                            <a href="{{route('bonus.index')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{__('Bonus Lists')}}</a>
                        </li>
                        <li>
                            <a href="{{route('bonus.create') }}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('New Bonus') }}</a>
                        </li>
                    </ul>
                </li>
                
                
                <li>
                    <button type="button" class="{{Route::is('slot.index') || Route::is('slot.create') ? 'bg-gray-600' : ''}} flex casino-dropdown hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-range-fill" viewBox="0 0 16 16">
                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 7V5H0v5h5a1 1 0 1 1 0 2H0v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9h-6a1 1 0 1 1 0-2h6z"/>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{__('Slots')}}</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul id="dropdown-casinos" class="hidden py-2 space-y-2 dropdown-items">
                        <li>
                            <a href="{{route('slot.index')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{__('Slot Lists')}}</a>
                        </li>
                        <li>
                            <a href="{{route('slot.create') }}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('Add New') }}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <button type="button" class="{{Route::is('gnomeinfo.index') || Route::is('gnomeinfo.create') ? 'bg-gray-600' : ''}} flex casino-dropdown hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{__('Gnom Info.')}}</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul id="dropdown-casinos" class="hidden py-2 space-y-2 dropdown-items">
                        <li>
                            <a href="{{route('gnomeinfo.index')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{__('Gnominfo Lists')}}</a>
                        </li>
                        <li>
                            <a href="{{route('gnomeinfo.create') }}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('Add New') }}</a>
                        </li>
                    </ul>
                </li>

                {{-- <li>
                    <button type="button" class="{{Route::is('groups.index') || Route::is('groups.create') ? 'bg-gray-600' : ''}} flex casino-dropdown hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-collection-fill" viewBox="0 0 16 16">
                            <path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{__('Groups')}}</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul id="dropdown-casinos" class="hidden py-2 space-y-2 dropdown-items">
                        <li>
                            <a href="{{route('groups.index')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{__('Group Lists')}}</a>
                        </li>
                        <li>
                            <a href="{{route('groups.create') }}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('Add New Group') }}</a>
                        </li>
                    </ul>
                </li> --}}
                
                <li>
                    <button type="button" class="{{Route::is('casinos.index') || Route::is('casinos.create') ? 'bg-gray-600' : ''}} flex casino-dropdown hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building-gear" viewBox="0 0 16 16">
                            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1V1Z"/>
                            <path d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Zm4.386 1.46c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{__('Casinos')}}</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul id="dropdown-casinos" class="hidden py-2 space-y-2 dropdown-items">
                        <li>
                            <a href="{{route('casinos.index')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{__('Casino Lists')}}</a>
                        </li>
                        <li>
                            <a href="{{route('casinos.create') }}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('Add New Casino') }}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <button type="button" class="{{Route::is('bans.index') || Route::is('bans.create') ? 'bg-gray-600' : ''}} flex casino-dropdown hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-slash" viewBox="0 0 16 16">
                            <path d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465l3.465-3.465Zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465Zm-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{__('Bans')}}</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <ul id="dropdown-bans" class="hidden py-2 space-y-2 dropdown-items">
                        <li>
                            <a href="{{route('bans.index')}}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{__('Bans Lists')}}</a>
                        </li>
                        <li>
                            <a href="{{route('bans.create') }}" class="flex hover:text-gray-200 items-center w-full p-2 text-gray-200 transition duration-75 rounded-lg pl-11 group hover:bg-gray-600 dark:text-white dark:hover:bg-gray-700">{{ __('Add New') }}</a>
                        </li>
                    </ul>
                </li>
                
                
                <li>
                    <a href="{{ route('logout.perform') }}" class="flex items-center items-left w-full p-2 text-gray-100 transition duration-75 rounded-lg group hover:bg-red-500 dark:text-white bg-red-700 dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                            <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">{{ __('Logout') }}</span>
                    </a>
                </li>
            </ul>
            </div>
        </div>
        @endauth