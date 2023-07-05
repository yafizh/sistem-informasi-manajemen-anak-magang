<nav class="shadow-none m-0 layout-navbar container-xxl navbar navbar-expand-xl align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    @if (auth()->user()->employee)
                        <div class="avatar">
                            <img src="{{ asset('storage/' . auth()->user()->employee->photo) }}" alt
                                class="w-px-40 h-auto rounded-circle" style="object-fit: cover; aspect-ratio: 1;" />
                        </div>
                    @elseif (auth()->user()->student)
                        <div class="avatar">
                            <img src="{{ asset('storage/' . auth()->user()->student->photo) }}" alt
                                class="w-px-40 h-auto rounded-circle" style="object-fit: cover; aspect-ratio: 1;" />
                        </div>
                    @else
                        Admin
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    @if (auth()->user()->employee)
                                        <div class="avatar">
                                            <img src="{{ asset('storage/' . auth()->user()->employee->photo) }}" alt
                                                class="w-px-40 h-auto rounded-circle" style="object-fit: cover; aspect-ratio: 1;"  />
                                        </div>
                                    @elseif (auth()->user()->student)
                                        <div class="avatar">
                                            <img src="{{ asset('storage/' . auth()->user()->student->photo) }}" alt
                                                class="w-px-40 h-auto rounded-circle" style="object-fit: cover; aspect-ratio: 1;"  />
                                        </div>
                                    @endif
                                </div>
                                @if (auth()->user()->employee)
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ auth()->user()->employee->name }}</span>
                                        <small class="text-muted">Pembimbing</small>
                                    </div>
                                @elseif (auth()->user()->student)
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ auth()->user()->student->name }}</span>
                                        <small class="text-muted">{{ auth()->user()->student->student_status == 'Student' ? "Siswa Magang" : 'Mahasiswa' }}</small>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    @if (auth()->user()->employee || auth()->user()->student)
                        <li>
                            <a class="dropdown-item" href="/{{ request()->segment(1) }}/profile">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">Profil</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a class="dropdown-item" href="/{{ request()->segment(1) }}/change-password">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Ganti Password</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/logout">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
