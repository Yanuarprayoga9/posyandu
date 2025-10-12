@foreach($menus as $menu)
    <li>
        <a href="{{ $menu['href'] }}"
           class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group
               {{ request()->is(ltrim($menu['href'], '/')) ? 'bg-gray-200 dark:bg-gray-800' : '' }}">
            <span class="ms-3">{{ $menu['name'] }}</span>
        </a>
    </li>
@endforeach
