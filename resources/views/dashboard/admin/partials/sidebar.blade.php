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
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Utama</span>
        </li>
        {{-- <li class="menu-item {{ $sidebar === 'dashboard' ? 'active' : '' }}">
            <a href="/admin" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li> --}}
        <li class="menu-item {{ $sidebar === 'employees' ? 'active' : '' }}">
            <a href="/admin/employees" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-badge"></i>
                <div data-i18n="Analytics">Pegawai</div>
            </a>
        </li>
        <li class="menu-item {{ $sidebar === 'students1' ? 'active' : '' }}">
            <a href="/admin/students?student_status=1" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-circle"></i>
                <div data-i18n="Analytics">Siswa</div>
            </a>
        </li>
        <li class="menu-item {{ $sidebar === 'students2' ? 'active' : '' }}">
            <a href="/admin/students?student_status=2" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-graduation"></i>
                <div data-i18n="Analytics">Mahasiswa</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pengguna</span>
        </li>
        <li class="menu-item {{ $sidebar === 'user-employees' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-badge"></i>
                <div data-i18n="Account Settings">Pegawai</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'admin' ? 'active' : '' }}">
                    <a href="/admin/admin" class="menu-link">
                        <div data-i18n="Account">Admin</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'supervisor' ? 'active' : '' }}">
                    <a href="/admin/supervisor" class="menu-link">
                        <div data-i18n="Notifications">Pembimbing</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ $sidebar === 'user-students' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user-circle"></i>
                <div data-i18n="Account Settings">Magang</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'students1' ? 'active' : '' }}">
                    <a href="/admin/user-students?student_status=1" class="menu-link">
                        <div data-i18n="Notifications">Siswa</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'students2' ? 'active' : '' }}">
                    <a href="/admin/user-students?student_status=2" class="menu-link">
                        <div data-i18n="Notifications">Mahasiswa</div>
                    </a>
                </li>
            </ul>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Magang</span>
        </li>
        <li class="menu-item {{ $sidebar === 'internship-applications' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-book"></i>
                <div data-i18n="Account Settings">Pendaftaran</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'pending' ? 'active' : '' }}">
                    <a href="/admin/internship-application" class="menu-link">
                        <div data-i18n="Account">Pengajuan</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'approved' ? 'active' : '' }}">
                    <a href="/admin/internship-application/approved" class="menu-link">
                        <div data-i18n="Notifications">Diterima</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'rejected' ? 'active' : '' }}">
                    <a href="/admin/internship-application/rejected" class="menu-link">
                        <div data-i18n="Notifications">Ditolak</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ $sidebar === 'internship-programs' ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-book-bookmark"></i>
                <div data-i18n="Account Settings">Kegiatan Magang</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'students1' ? 'active' : '' }}">
                    <a href="/admin/internship-programs?student_status=1" class="menu-link">
                        <div data-i18n="Account">Siswa</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'students2' ? 'active' : '' }}">
                    <a href="/admin/internship-programs?student_status=2" class="menu-link">
                        <div data-i18n="Notifications">Mahasiswa</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Laporan</span></li>
        <li class="menu-item {{ $sidebar === 'report' ? 'active open' : '' }}">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-file-pdf"></i>
                <div data-i18n="User interface">Laporan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'internship-applications' ? 'active' : '' }}">
                    <a href="/admin/report/internship-applications" class="menu-link">
                        <div data-i18n="Accordion">Pendaftaran</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'internship-programs' ? 'active' : '' }}">
                    <a href="/admin/report/internship-programs" class="menu-link">
                        <div data-i18n="Accordion">Kegiatan Magang</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'student1' ? 'active' : '' }}">
                    <a href="/admin/report/students?student_status=1" class="menu-link">
                        <div data-i18n="Accordion">Siswa Magang</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'student2' ? 'active' : '' }}">
                    <a href="/admin/report/students?student_status=2" class="menu-link">
                        <div data-i18n="Accordion">Mahasiswa Magang</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'student-presences1' ? 'active' : '' }}">
                    <a href="/admin/report/student-presences?student_status=1" class="menu-link">
                        <div data-i18n="Accordion">Presensi Siswa</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'student-presences2' ? 'active' : '' }}">
                    <a href="/admin/report/student-presences?student_status=2" class="menu-link">
                        <div data-i18n="Accordion">Presensi Mahasiswa</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'student-presence-table1' ? 'active' : '' }}">
                    <a href="/admin/report/student-presence-table?student_status=1" class="menu-link">
                        <div data-i18n="Accordion">Tabel Presensi Siswa</div>
                    </a>
                </li>
                <li class="menu-item {{ ($sub_sidebar ?? '') === 'student-presence-table2' ? 'active' : '' }}">
                    <a href="/admin/report/student-presence-table?student_status=2" class="menu-link">
                        <div data-i18n="Accordion">Tabel Presensi Mahasiswa</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
