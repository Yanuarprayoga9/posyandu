<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class SidebarMenus extends Component
{
    public $menus;

    public function __construct()
    {
        // Ambil role jika user login
        $role = Auth::check() ? Auth::user()->role_name : 'guest';

        // Daftar semua menu
        $allMenus = [
            ['name' => 'Dashboard', 'href' => '/dashboard', 'roles' => ['admin', 'hrd', 'user']],
            ['name' => 'Users', 'href' => '/users', 'roles' => ['admin']],
            ['name' => 'Employee', 'href' => '/employees', 'roles' => ['hrd', 'admin']],
            ['name' => 'Employee Contract', 'href' => '/employee-contracts', 'roles' => ['hrd', 'admin']],
            ['name' => 'Work Table', 'href' => '/works', 'roles' => ['hrd', 'admin']],

            // 👇 Menu khusus guest
            ['name' => 'Home', 'href' => '/', 'roles' => ['guest']],
            ['name' => 'Login', 'href' => '/login', 'roles' => ['guest']],
            ['name' => 'Register', 'href' => '/register', 'roles' => ['guest']],
        ];

        // Filter berdasarkan role
        $this->menus = collect($allMenus)->filter(function ($menu) use ($role) {
            return in_array($role, $menu['roles']);
        })->values()->toArray();
    }

    public function render()
    {
        return view('components.sidebar-menus');
    }
}
