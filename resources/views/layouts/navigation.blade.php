<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('products.index') }}" class="font-black text-xl text-indigo-600 tracking-wider hover:text-indigo-800 transition">
                        📦 PRO-MANAGER
                    </a>
                </div>

                <!-- Navigation Links (Các nút chuyển trang) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 transition">
                        Bảng điều khiển (Dashboard)
                    </a>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-bold leading-5 text-gray-900 transition">
                        Quản lý Sản phẩm
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown (Khung menu xổ xuống bên góc phải) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                                <div class="flex items-center">
                                    <span class="font-bold">{{ Auth::user()->name }}</span>
                                    <!-- Huy hiệu hiển thị Role -->
                                    <span class="ms-2 text-[10px] px-2 py-0.5 rounded-full font-black uppercase tracking-wider {{ Auth::user()->role === 'admin' ? 'bg-red-100 text-red-700 border border-red-200' : 'bg-blue-100 text-blue-700 border border-blue-200' }}">
                                        {{ Auth::user()->role }}
                                    </span>
                                </div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Hồ sơ cá nhân
                            </x-dropdown-link>
                            <!-- Nút Đăng xuất -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    Đăng xuất
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-900">Đăng nhập</a>
                @endauth
            </div>
        </div>
    </div>
</nav>