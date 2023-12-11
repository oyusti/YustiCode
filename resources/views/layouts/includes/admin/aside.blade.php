@php
    
    $links = [
        [
            'name' => 'Dashboard',
            'route' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
            'icon' => 'fa-solid fa-gauge-high',
            'can' => ['Gestion de Dashboard']
        ],
        [
            'name' => 'Categorias',
            'route' => route('admin.categories.index'),
            'active' => request()->routeIs('admin.categories.*'),
            'icon' => 'fa-solid fa-inbox',
            'can' => ['Gestion de Categorias']
        ],
        [
            'name' => 'Posts',
            'route' => route('admin.posts.index'),
            'active' => request()->routeIs('admin.posts.*'),
            'icon' => 'fa-solid fa-blog',
            'can' => ['Gestion de Posts']
        ],
        [
            'name' => 'Roles',
            'route' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.*'),
            'icon' => 'fa-solid fa-user-tag',
            'can' => ['Gestion de Roles']
        ],
        [
            'name' => 'Permisos',
            'route' => route('admin.permissions.index'),
            'active' => request()->routeIs('admin.permissions.*'),
            'icon' => 'fa-solid fa-key',
            'can' => ['Gestion de Permisos']
        ],
        [
            'name' => 'Usuarios',
            'route' => route('admin.users.index'),
            'active' => request()->routeIs('admin.users.*'),
            'icon' => 'fa-solid fa-users',
            'can' => ['Gestion de Usuarios']
        ],

    ];

@endphp


<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
                '-translate-x-full': !sidebarOpenMobile,
                'transform-none': sidebarOpenMobile
            }"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">

            @foreach ($links as $link) 
                {{-- Verificamos si el usuario tiene permiso para ver el link --}}
                @canany($link['can'] ?? [null])    
                    <li>
                        <a href="{{ $link['route'] }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{$link['active'] ? 'bg-gray-100' : ''}}">
                            <i class="{{ $link['icon']}} text-gray-500"></i>
                            <span class="ml-3">{{ $link['name'] }}</span>
                        </a>
                    </li>
                @endcanany
            @endforeach
            
        </ul>
    </div>
</aside>
