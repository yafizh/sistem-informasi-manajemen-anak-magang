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
        <li class="menu-item {{ $sidebar === 'presences' ? 'active' : '' }}">
            <a href="/student/presences" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Presensi</div>
            </a>
        </li>
        <li class="menu-item {{ $sidebar === 'table-presences' ? 'active' : '' }}">
            <a href="/student/table-presences" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Tabel Presensi</div>
            </a>
        </li>
        <li class="menu-item {{ $sidebar === 'evaluations' ? 'active' : '' }}">
            <a href="/student/evaluations" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Penilaian</div>
            </a>
        </li>
    </ul>
</aside>
