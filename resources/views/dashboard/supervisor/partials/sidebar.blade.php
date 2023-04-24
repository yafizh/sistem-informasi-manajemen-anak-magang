<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link p-3">
            <img src="/assets/img/logo/logo1.png" class="w-100">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ $sidebar === 'dashboard' ? 'active' : '' }}">
            <a href="/supervisor" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Bimbingan Magang</span>
        </li>
        <li class="menu-item {{ $sidebar === 'internship-programs-1' ? 'active' : '' }}">
            <a href="/supervisor/internship-programs?student_status=1" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user"></i>
                <div data-i18n="Analytics">Siswa</div>
            </a>
        </li>
        <li class="menu-item {{ $sidebar === 'internship-programs-2' ? 'active' : '' }}">
            <a href="/supervisor/internship-programs?student_status=2" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-graduation"></i>
                <div data-i18n="Analytics">Mahasiswa</div>
            </a>
        </li>
    </ul>
</aside>
