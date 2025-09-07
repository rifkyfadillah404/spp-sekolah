<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">Kelola Siswa</h2>
                <p class="text-muted mb-0">Daftar semua siswa yang terdaftar dalam sistem</p>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Total Siswa</h6>
                                <h3 class="mb-0 fw-bold text-primary">{{ $students->total() }}</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded p-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Kelas Aktif</h6>
                                <h3 class="mb-0 fw-bold text-success">{{ count($classes) }}</h3>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded p-3">
                                <i class="fas fa-graduation-cap fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Akun Aktif</h6>
                                <h3 class="mb-0 fw-bold text-info">{{ $students->total() }}</h3>
                            </div>
                            <div class="bg-info bg-opacity-10 rounded p-3">
                                <i class="fas fa-user-check fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted mb-1">Siswa Baru</h6>
                                <h3 class="mb-0 fw-bold text-warning">{{ $students->filter(function($student) { return $student->created_at >= now()->subDays(30); })->count() }}</h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded p-3">
                                <i class="fas fa-user-plus fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0"
                                   placeholder="Cari berdasarkan nama, NIS, atau email..."
                                   id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="classFilter">
                            <option value="">Semua Kelas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>
                                    {{ $class }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="sortFilter">
                            <option value="name">Urutkan Nama</option>
                            <option value="nis">Urutkan NIS</option>
                            <option value="class">Urutkan Kelas</option>
                            <option value="created">Terbaru</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex">
                            <button class="btn btn-outline-secondary me-2" onclick="resetFilters()">
                                <i class="fas fa-undo me-1"></i>
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-table me-2 text-primary"></i>
                        Daftar Siswa
                    </h5>
                    <div class="d-flex align-items-center">
                        <small class="text-muted me-3">
                            Menampilkan {{ $students->firstItem() ?? 0 }} - {{ $students->lastItem() ?? 0 }}
                            dari {{ $students->total() }} siswa
                        </small>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary" onclick="bulkExport()">
                                <i class="fas fa-download me-1"></i>
                                Export
                            </button>
                            <button type="button" class="btn btn-outline-danger" onclick="bulkDelete()">
                                <i class="fas fa-trash me-1"></i>
                                Hapus Terpilih
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- Table View -->
                <div id="tableView" class="table-responsive">
                    <table class="table table-rounded table-row-gray-300 table-hover mb-0" id="studentsTable">
                        <thead>
                            <tr>
                                <th class="border-0" style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-id-card me-2 text-primary"></i>
                                        NIS
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user me-2 text-primary"></i>
                                        Nama Siswa
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-graduation-cap me-2 text-primary"></i>
                                        Kelas
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope me-2 text-primary"></i>
                                        Email
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone me-2 text-primary"></i>
                                        Telepon
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar me-2 text-primary"></i>
                                        Terdaftar
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase text-center" style="font-size: 12px;">
                                    <i class="fas fa-cogs text-primary"></i>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr class="student-row"
                                    data-class="{{ $student->class }}"
                                    data-status="active"
                                    data-name="{{ strtolower($student->name) }}"
                                    data-nis="{{ strtolower($student->nis) }}"
                                    data-email="{{ strtolower($student->user->email) }}">
                                    <td class="align-middle">
                                        <div class="form-check">
                                            <input class="form-check-input student-checkbox" type="checkbox"
                                                value="{{ $student->id }}">
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="fw-bold text-primary">{{ $student->nis }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px symbol-circle me-3">
                                                <div class="symbol-label bg-light-primary text-primary">
                                                    {{ strtoupper(substr($student->name, 0, 2)) }}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="text-gray-800 fw-bold fs-6">{{ $student->name }}</div>
                                                <div class="text-muted fs-7">ID: {{ $student->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge badge-light-info">
                                            <i class="fas fa-graduation-cap me-1"></i>
                                            {{ $student->class }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column">
                                            <div class="text-gray-800 fw-semibold fs-6">{{ $student->user->email }}</div>
                                            <div class="text-success fs-7">
                                                <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                                                Aktif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if($student->phone)
                                            <div class="text-gray-800 fw-semibold fs-6">
                                                <i class="fas fa-phone me-2 text-muted"></i>
                                                {{ $student->phone }}
                                            </div>
                                        @else
                                            <div class="text-muted fs-6">
                                                <i class="fas fa-minus me-2"></i>
                                                Belum diisi
                                            </div>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column">
                                            <div class="text-gray-800 fw-bold fs-6">{{ $student->created_at->format('d M Y') }}</div>
                                            <div class="text-muted fs-7">{{ $student->created_at->diffForHumans() }}</div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light btn-icon dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.students.show', $student) }}">
                                                        <i class="fas fa-eye me-2 text-info"></i>
                                                        Lihat Detail
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.students.edit', $student) }}">
                                                        <i class="fas fa-edit me-2 text-warning"></i>
                                                        Edit Data
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.spp-bills.create') }}?student_id={{ $student->id }}">
                                                        <i class="fas fa-plus me-2 text-success"></i>
                                                        Buat Tagihan
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('admin.students.destroy', $student) }}"
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus siswa {{ $student->name }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash me-2"></i>
                                                            Hapus Siswa
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-users fa-3x mb-3"></i>
                                            <h5>Belum Ada Siswa</h5>
                                            <p>Belum ada siswa yang terdaftar dalam sistem.</p>
                                            <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-1"></i>
                                                Tambah Siswa Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($students->hasPages())
                <div class="card-footer bg-white border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Menampilkan {{ $students->firstItem() }} - {{ $students->lastItem() }}
                            dari {{ $students->total() }} siswa
                        </div>
                        {{ $students->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        (function () {
            const searchInput = document.getElementById('searchInput');
            const classFilter = document.getElementById('classFilter');
            const statusFilter = document.getElementById('statusFilter');
            const sortFilter = document.getElementById('sortFilter');

            function applyFilters() {
                const searchTerm = (searchInput?.value || '').toLowerCase().trim();
                const selectedClass = classFilter?.value || '';
                const selectedStatus = statusFilter?.value || '';

                document.querySelectorAll('.student-row').forEach(row => {
                    const rowName = row.dataset.name || '';
                    const rowNis = row.dataset.nis || '';
                    const rowEmail = row.dataset.email || '';
                    const rowClass = row.dataset.class || '';
                    const rowStatus = row.dataset.status || '';

                    // Search across multiple fields
                    const matchesSearch = !searchTerm ||
                        rowName.includes(searchTerm) ||
                        rowNis.includes(searchTerm) ||
                        rowEmail.includes(searchTerm);

                    const matchesClass = !selectedClass || rowClass === selectedClass;
                    const matchesStatus = !selectedStatus || rowStatus === selectedStatus;

                    row.style.display = (matchesSearch && matchesClass && matchesStatus) ? '' : 'none';
                });
            }

            if (searchInput) searchInput.addEventListener('input', applyFilters);
            if (classFilter) classFilter.addEventListener('change', applyFilters);
            if (statusFilter) statusFilter.addEventListener('change', applyFilters);

            window.resetFilters = function () {
                if (searchInput) searchInput.value = '';
                if (classFilter) classFilter.value = '';
                if (statusFilter) statusFilter.value = '';
                if (sortFilter) sortFilter.value = 'name';
                applyFilters();
            };

            // Select all functionality
            const selectAll = document.getElementById('selectAll');
            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    const checkboxes = document.querySelectorAll('.student-checkbox');
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }

            // Bulk export functionality
            window.bulkExport = function () {
                const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
                if (checkedBoxes.length === 0) {
                    alert('Pilih siswa yang ingin diexport terlebih dahulu.');
                    return;
                }

                const studentIds = Array.from(checkedBoxes).map(cb => cb.value);

                // Create form and submit for export
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.students.export") }}';

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const idsInput = document.createElement('input');
                idsInput.type = 'hidden';
                idsInput.name = 'student_ids';
                idsInput.value = JSON.stringify(studentIds);

                form.appendChild(csrfToken);
                form.appendChild(idsInput);
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            };

            // Bulk delete functionality
            window.bulkDelete = function () {
                const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
                if (checkedBoxes.length === 0) {
                    alert('Pilih siswa yang ingin dihapus terlebih dahulu.');
                    return;
                }

                if (confirm(`Yakin ingin menghapus ${checkedBoxes.length} siswa? Tindakan ini tidak dapat dibatalkan.`)) {
                    const studentIds = Array.from(checkedBoxes).map(cb => cb.value);

                    // Create form and submit for bulk delete
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("admin.students.bulk-delete") }}';

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    const idsInput = document.createElement('input');
                    idsInput.type = 'hidden';
                    idsInput.name = 'student_ids';
                    idsInput.value = JSON.stringify(studentIds);

                    form.appendChild(csrfToken);
                    form.appendChild(methodInput);
                    form.appendChild(idsInput);
                    document.body.appendChild(form);
                    form.submit();
                    document.body.removeChild(form);
                }
            };

            // Toggle view
            window.toggleView = function (view) {
                const tableView = document.getElementById('tableView');
                const gridView = document.getElementById('gridView');
                const buttons = document.querySelectorAll('[onclick^="toggleView"]');

                buttons.forEach(btn => btn.classList.remove('active'));
                event.target.closest('button').classList.add('active');

                if (view === 'table') {
                    tableView.classList.remove('d-none');
                    gridView.classList.add('d-none');
                } else {
                    tableView.classList.add('d-none');
                    gridView.classList.remove('d-none');
                }
            };

            // Initial apply
            applyFilters();
        })();
    </script>
    @endpush
</x-admin-layout>
