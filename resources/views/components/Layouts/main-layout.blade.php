<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

    <title>Posyandu Mugi Lestari, Desa Candirenggo | @yield('title')</title>
</head>

<body class="bg-gray-100">
<!-- Top Navigation Bar -->
<nav class="fixed top-0 z-50 w-full bg-teal-800 border-b border-teal-700 shadow-lg">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-white rounded-lg sm:hidden hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
                    <svg class="w-8 h-8 me-3 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                    </svg>
                    <span class="self-center text-lg font-semibold sm:text-xl text-white leading-tight">
  <span class="block">Posyandu Mugi Lestari</span>
  <span class="block text-white/80 text-sm sm:text-base font-normal">Desa Candirenggo</span>
</span>

                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                                class="flex text-sm bg-white rounded-full focus:ring-4 focus:ring-teal-300"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full"
                                 src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                    </div>
                    <div
                        class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900" role="none">
                                {{ auth()->user()->name ?? 'User' }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                {{ auth()->user()->email ?? 'user@posyandu.com' }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('dashboard') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50"
                                   role="menuitem">Dashboard</a>
                            </li>
                            <li>
                                <a href="#"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-50"
                                   role="menuitem">Settings</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-teal-50"
                                            role="menuitem">Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<aside id="logo-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-teal-600 border-r border-teal-700 sm:translate-x-0 shadow-xl"
       aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-teal-600">
        <ul class="space-y-2 font-medium">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center p-2 text-white rounded-lg hover:bg-teal-700 group transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-teal-700' : '' }}">
                    <svg
                        class="w-5 h-5 text-white transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3 font-semibold">Dashboard</span>
                </a>
            </li>

            <!-- Posyandu Anak & Balita -->
            <li>
                <button type="button"
                        class="flex items-center w-full p-2 text-white rounded-lg hover:bg-teal-700 group transition-colors duration-200 {{ request()->routeIs('data-anak.*') ? 'bg-teal-700' : '' }}"
                        data-collapse-toggle="posyandu-dropdown">
                    <svg
                        class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                    </svg>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap font-semibold">Posyandu Anak & Balita</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="posyandu-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('anak.index') }}"
                           class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:bg-teal-700 transition-colors duration-200 {{ request()->routeIs('data-anak.*') ? 'bg-teal-700' : '' }}">
                            Data Anak & Balita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orangtua.index') }}"
                           class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:bg-teal-700 transition-colors duration-200">
                            Data Orang Tua
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('imunisasi.index') }}"
                           class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:bg-teal-700 transition-colors duration-200 {{ request()->routeIs('imunisasi.*') ? 'bg-teal-700' : '' }}">
                            Data Imunisasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemeriksaan.index') }}"
                           class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:bg-teal-700 transition-colors duration-200 {{ request()->routeIs('pemeriksaan.*') ? 'bg-teal-700' : '' }}">
                            Data Pemeriksaan
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Pemeriksaan -->
            <li>
                <button type="button"
                        class="flex items-center w-full p-2 text-white rounded-lg hover:bg-teal-700 group transition-colors duration-200"
                        data-collapse-toggle="pemeriksaan-dropdown">
                    <svg
                        class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                        <path
                            d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                        <path
                            d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
                    </svg>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap font-semibold">Pemeriksaan</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="pemeriksaan-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('imunisasi.create') }}"
                           class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:bg-teal-700 transition-colors duration-200">
                            Imunisasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemeriksaan.create') }}"
                           class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:bg-teal-700 transition-colors duration-200">
                            Penimbangan
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Riwayat -->
            <li>
                <button type="button"
                        class="flex items-center w-full p-2 text-white rounded-lg hover:bg-teal-700 group transition-colors duration-200"
                        data-collapse-toggle="riwayat-dropdown">
                    <svg
                        class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                    </svg>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap font-semibold">Riwayat</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="riwayat-dropdown" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('anak.index') }}"
                           class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:bg-teal-700 transition-colors duration-200">
                            Perkembangan Anak & Balita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemeriksaan.index') }}"
                           class="flex items-center w-full p-2 text-white rounded-lg pl-11 hover:bg-teal-700 transition-colors duration-200">
                            Pantau Gizi Anak
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Event -->
            <li>
                <a href="{{ route('event.index') }}"
                   class="flex items-center p-2 text-white rounded-lg hover:bg-teal-700 group transition-colors duration-200 {{ request()->routeIs('event.*') ? 'bg-teal-700' : '' }}">
                    <svg
                        class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap font-semibold">Event</span>
                </a>
            </li>

            <!-- Laporan -->
            <li>
                <a href="{{ route('laporan.index') }}"
                   class="flex items-center p-2 text-white rounded-lg hover:bg-teal-700 group transition-colors duration-200">
                    <svg
                        class="shrink-0 w-5 h-5 text-white transition duration-75 group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap font-semibold">Laporan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- Main Content Area -->
<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
        <!-- Breadcrumb -->
        @if(!request()->routeIs('dashboard'))
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-teal-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    @yield('breadcrumb')
                </ol>
            </nav>
        @endif

        <!-- Content Section with Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            @if(session('success'))
                <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                    <span class="font-medium">Success!</span> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                    <span class="font-medium">Error!</span> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

</body>

</html>
