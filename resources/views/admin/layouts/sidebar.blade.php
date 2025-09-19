<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('whpower.png') }}" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">JAIPLUS</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ request()->is('admin/members*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/members*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Members <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/members/1') }}"
                                class="nav-link {{ request()->is('admin/members/1') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/members/2') }}"
                                class="nav-link {{ request()->is('admin/members/2') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inactive</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user_activate_plan') }}"
                        class="nav-link {{ request()->is('admin/user_activate_plan') ? 'active' : '' }}">
                        <i class="fas fa-trophy nav-icon"></i>
                        <p>Plans</p>
                    </a>
                </li>

                <li
                    class="nav-item has-treeview {{ request()->is('admin/spornser') || request()->is('admin/global_rebirth') || request()->is('admin/upline_spornser') || request()->is('admin/upgrade') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/spornser') || request()->is('admin/global_rebirth') || request()->is('admin/upline_spornser') || request()->is('admin/upgrade') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>Incomes <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/spornser') }}"
                                class="nav-link {{ request()->is('admin/spornser') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Direct Refferal Income</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/global_rebirth') }}"
                                class="nav-link {{ request()->is('admin/global_rebirth') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Regain Income</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/upline_spornser') }}"
                                class="nav-link {{ request()->is('admin/upline_spornser') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upline Income</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="{{ url('admin/upgrade') }}"
                                class="nav-link {{ request()->is('admin/upgrade') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upgrade</p>
                            </a>
                        </li> -->
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('plan_activation_request') }}"
                        class="nav-link {{ request()->is('admin/plan_activation_request') ? 'active' : '' }}">
                        <i class="fas fa-power-off nav-icon"></i>
                        <p>Plan Activation Request</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/wallet') }}"
                        class="nav-link {{ request()->is('admin/wallet') ? 'active' : '' }}">
                        <i class="fas fa-wallet nav-icon"></i>
                        <p>Wallet</p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ request()->is('admin/withdrawal*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/withdrawal*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>Withdrawal <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/withdrawal/1') }}"
                                class="nav-link {{ request()->is('admin/withdrawal/1') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/withdrawal/2') }}"
                                class="nav-link {{ request()->is('admin/withdrawal/2') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Completed</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(auth()->user()->user_type_id == 1)
                <li
                    class="nav-item has-treeview {{ request()->is('admin/users*') || request()->is('admin/user_type*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/users*') || request()->is('admin/user_type*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Users <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/users') }}"
                                class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/user_type') }}"
                                class="nav-link {{ request()->is('admin/user_type') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Type</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item has-treeview {{ request()->is('plans') || request()->is('backup') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('plans') || request()->is('backup') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('plans') }}"
                                class="nav-link {{ request()->is('plans') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create Plan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backup') }}"
                                class="nav-link {{ request()->is('backup') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Backup</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li
                    class="nav-item has-treeview {{ request()->is('admin/profile') || request()->is('admin/changepassword') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/profile') || request()->is('admin/changepassword') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>{{ Auth::user()->name }} <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('profile') }}"
                                class="nav-link {{ request()->is('admin/profile') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/changepassword') }}"
                                class="nav-link {{ request()->is('admin/changepassword') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/logout') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>