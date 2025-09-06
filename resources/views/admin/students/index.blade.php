<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">Kelola Siswa</h2>
                <p class="text-muted mb-0">Daftar semua siswa yang terdaftar dalam sistem</p>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge bg-primary me-3">
                    <i class="fas fa-users me-1"></i>
                    {{ $students->total() }} siswa
                </span>
                <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Siswa
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Search and Filter Section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-start-0"
                                   placeholder="Cari berdasarkan nama, NIS, atau email..."
                                   id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="classFilter">
                            <option value="">Semua Kelas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>
                                    {{ $class }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                    <div class="d-flex">
                        <button class="btn btn-outline-secondary me-2" onclick="resetFilters()">
                            <i class="fas fa-undo me-1"></i>
                            Reset
                        </button>

                        <a href="{{ route('admin.reports.students.pdf', ['class' => request('class')]) }}" 
                        class="btn btn-danger me-2">
                            <i class="fas fa-file-pdf me-1"></i> PDF
                        </a>

                        <a href="{{ route('admin.reports.students.excel', ['class' => request('class')]) }}" 
                        class="btn btn-success">
                            <i class="fas fa-file-excel me-1"></i> Excel
                        </a>

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
                            <button type="button" class="btn btn-outline-secondary active" onclick="toggleView('table')">
                                <i class="fas fa-table"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="toggleView('grid')">
                                <i class="fas fa-th"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <!-- Table View -->
                <div id="tableView" class="table-responsive">
                    <table class="table table-hover mb-0" id="studentsTable">
                        <thead class="table-light">
                            <tr>
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
                                <th class="border-0 fw-bold text-uppercase text-center" style="font-size: 12px;">
                                    <i class="fas fa-cogs text-primary"></i>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr class="student-row">
                                    <td class="align-middle">
                                        <span class="fw-bold text-primary">{{ $student->nis }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                 style="width: 40px; height: 40px; font-size: 14px;">
                                                {{ strtoupper(substr($student->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $student->name }}</div>
                                                <small class="text-muted">ID: {{ $student->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info">
                                            {{ $student->class }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div>
                                            <div>{{ $student->user->email }}</div>
                                            <small class="text-muted">
                                                <i class="fas fa-circle text-success" style="font-size: 8px;"></i>
                                                Aktif
                                            </small>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if($student->phone)
                                            <div>
                                                <i class="fas fa-phone me-1 text-muted"></i>
                                                {{ $student->phone }}
                                            </div>
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-minus"></i>
                                                Belum diisi
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle"
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
                                    <td colspan="6" class="text-center py-5">
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

                <!-- Grid View (Hidden by default) -->
                <div id="gridView" class="d-none p-4">
                    <div class="row" id="studentsGrid">
                        @foreach ($students as $student)
                            <div class="col-lg-4 col-md-6 mb-4 student-card">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                             style="width: 60px; height: 60px; font-size: 24px;">
                                            {{ strtoupper(substr($student->name, 0, 2)) }}
                                        </div>
                                        <h6 class="fw-bold">{{ $student->name }}</h6>
                                        <p class="text-muted mb-2">{{ $student->nis }}</p>
                                        <span class="badge bg-info">{{ $student->class }}</span>
                                        <div class="mt-3">
                                            <small class="text-muted d-block">{{ $student->user->email }}</small>
                                            <small class="text-muted">{{ $student->phone ?? 'No phone' }}</small>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent border-top-0">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admin.students.show', $student) }}"
                                               class="btn btn-sm btn-outline-info me-1">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.students.edit', $student) }}"
                                               class="btn btn-sm btn-outline-warning me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.students.destroy', $student) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus siswa {{ $student->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('.student-row');
            const cards = document.querySelectorAll('.student-card');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });

            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        document.getElementById('classFilter').addEventListener('change', function() {
            const selectedClass = this.value;
            const currentUrl = new URL(window.location.href);
            if (selectedClass) {
                currentUrl.searchParams.set('class', selectedClass);
            } else {
                currentUrl.searchParams.delete('class');
            }
            window.location.href = currentUrl.toString();
        });

        // Reset filters
        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('classFilter').value = '';

            document.querySelectorAll('.student-row, .student-card').forEach(element => {
                element.style.display = '';
            });
        }

        // Toggle view
        function toggleView(view) {
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
        }
    </script>
    @endpush
</x-admin-layout>
