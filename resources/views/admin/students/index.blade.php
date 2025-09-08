<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">
                    <i class="fas fa-users me-2 text-primary"></i>
                    Kelola Siswa
                </h2>
                <p class="text-muted mb-0">Daftar semua siswa yang terdaftar dalam sistem</p>
            </div>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary btn-lg rounded-pill px-4 py-2">
                <i class="fas fa-plus-circle me-2"></i>
                Tambah Siswa
            </a>
        </div>
    </x-slot>

    <style>
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .stat-title {
            font-size: 0.95rem;
            color: #64748b;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
        }

        .filter-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.03);
            margin-bottom: 1.5rem;
        }

        .filter-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .table-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
        }

        .table-header {
            background: #f8fafc;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 0.6rem 1.1rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .table-responsive {
            overflow-x: auto;
        }

        .students-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .students-table th {
            background: #f1f5f9;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .students-table td {
            padding: 1.1rem 1.25rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .students-table tr:last-child td {
            border-bottom: none;
        }

        .students-table tr:hover {
            background-color: #f8fafc;
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .student-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
        }

        .student-details h6 {
            margin: 0 0 0.25rem 0;
            font-weight: 600;
            color: #0f172a;
            font-size: 1rem;
        }

        .student-details p {
            margin: 0;
            font-size: 0.85rem;
            color: #64748b;
        }

        .badge-class {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-status {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-active {
            background: #dcfce7;
            color: #166534;
        }

        .dropdown-toggle {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .dropdown-toggle:hover {
            background: #e2e8f0;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        .pagination-info {
            color: #64748b;
            font-size: 0.9rem;
        }

        .pagination-links {
            display: flex;
            gap: 0.5rem;
        }

        .pagination-link {
            padding: 0.5rem 0.9rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            color: #475569;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .pagination-link:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .pagination-link.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 6px;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        .empty-state i {
            font-size: 3rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .empty-state h5 {
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 0.75rem;
        }

        .empty-state p {
            color: #64748b;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 992px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .filter-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .filter-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                width: 100%;
                justify-content: center;
            }
            
            .table-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .students-table th, .students-table td {
                padding: 0.75rem;
            }
            
            .student-info {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
        }
    </style>

    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon bg-primary text-white">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-title">Total Siswa</div>
                <div class="stat-value">{{ $students->total() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-success text-white">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-title">Kelas Aktif</div>
                <div class="stat-value">{{ count($classes) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-info text-white">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-title">Akun Aktif</div>
                <div class="stat-value">{{ $students->total() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-warning text-white">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="stat-title">Siswa Baru</div>
                <div class="stat-value">{{ $students->filter(function($student) { return $student->created_at >= now()->subDays(30); })->count() }}</div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="filter-card">
            <h5 class="filter-title">
                <i class="fas fa-filter text-primary"></i>
                Filter & Pencarian
            </h5>
            <div class="filter-grid">
                <div>
                    <label class="form-label fw-600 mb-2 fs-6">Cari Siswa</label>
                    <div class="input-group" style="height: 50px;">
                        <span class="input-group-text bg-light border-end-0 fs-5" style="height: 100%;">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 fs-6" 
                            placeholder="Masukkan nama, NIS, atau email..." id="searchInput" style="height: 100%; padding: 1rem;">
                    </div>
                </div>
                <div>
                    <label class="form-label fw-600 mb-2 fs-6">Kelas</label>
                    <select class="form-select fs-6" id="classFilter" style="height: 50px; padding: 0.75rem 1rem;">
                        <option value="">Semua Kelas</option>
                        @foreach($classes as $class)
                            <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>
                                {{ $class }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label fw-600 mb-2 fs-6">Status</label>
                    <select class="form-select fs-6" id="statusFilter" style="height: 50px; padding: 0.75rem 1rem;">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="form-label fw-600 mb-2 fs-6">Urutkan</label>
                    <select class="form-select fs-6" id="sortFilter" style="height: 50px; padding: 0.75rem 1rem;">
                        <option value="name">Urutkan Nama</option>
                        <option value="nis">Urutkan NIS</option>
                        <option value="class">Urutkan Kelas</option>
                        <option value="created">Terbaru</option>
                    </select>
                </div>
                <div class="d-flex align-items-end">
                    <button class="btn btn-outline-secondary w-100 fs-6" onclick="resetFilters()" style="height: 50px; padding: 0.75rem 1rem;">
                        <i class="fas fa-undo me-2"></i>
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <div class="table-card">
            <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                <h5 class="table-title">
                    <i class="fas fa-table text-primary"></i>
                    Daftar Siswa
                </h5>
                <div class="action-buttons">
                    <button type="button" class="btn-action btn-outline-primary" onclick="bulkExport()">
                        <i class="fas fa-file-excel"></i>
                        Export Excel
                    </button>
                    <button type="button" class="btn-action btn-outline-danger" onclick="bulkDelete()">
                        <i class="fas fa-trash"></i>
                        Hapus Terpilih
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="students-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                </div>
                            </th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Terdaftar</th>
                            <th class="text-center">Aksi</th>
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
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input student-checkbox" type="checkbox"
                                            value="{{ $student->id }}">
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-primary">{{ $student->nis }}</span>
                                </td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar bg-primary">
                                            {{ strtoupper(substr($student->name, 0, 2)) }}
                                        </div>
                                        <div class="student-details">
                                            <h6>{{ $student->name }}</h6>
                                            <p>ID: {{ $student->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-class">
                                        <i class="fas fa-graduation-cap"></i>
                                        {{ $student->class }}
                                    </span>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-semibold">{{ $student->user->email }}</div>
                                        <span class="badge-status badge-active">
                                            <i class="fas fa-circle me-1" style="font-size: 8px;"></i>
                                            Aktif
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @if($student->phone)
                                        <div class="fw-semibold">
                                            <i class="fas fa-phone me-2 text-muted"></i>
                                            {{ $student->phone }}
                                        </div>
                                    @else
                                        <div class="text-muted">
                                            <i class="fas fa-minus me-2"></i>
                                            Belum diisi
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-bold">{{ $student->created_at->format('d M Y') }}</div>
                                        <div class="small text-muted">{{ $student->created_at->diffForHumans() }}</div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.students.show', $student) }}">
                                                    <i class="fas fa-eye text-info me-2"></i>
                                                    Lihat Detail
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.students.edit', $student) }}">
                                                    <i class="fas fa-edit text-warning me-2"></i>
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
                                <td colspan="8" class="text-center">
                                    <div class="empty-state">
                                        <i class="fas fa-users"></i>
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

            <!-- Pagination -->
            @if($students->hasPages())
                <div class="pagination">
                    <div class="pagination-info">
                        Menampilkan {{ $students->firstItem() }} - {{ $students->lastItem() }}
                        dari {{ $students->total() }} siswa
                    </div>
                    <div class="pagination-links">
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

            // Initial apply
            applyFilters();
        })();
    </script>
    @endpush
</x-admin-layout>
