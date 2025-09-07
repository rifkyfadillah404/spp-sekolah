<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">Siswa Per Kelas</h2>
                <p class="text-muted mb-0">Lihat dan kelola siswa berdasarkan kelas masing-masing</p>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <!-- Class Statistics Overview -->
        <div class="row mb-4">
            @foreach($classStats as $className => $stats)
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-graduation-cap me-2 text-primary"></i>
                                    Kelas {{ $className }}
                                </h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <div class="bg-primary bg-opacity-10 rounded p-3">
                                        <h4 class="mb-1 fw-bold text-primary">{{ $stats['total_students'] }}</h4>
                                        <small class="text-muted">Total Siswa</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="bg-success bg-opacity-10 rounded p-3">
                                        <h4 class="mb-1 fw-bold text-success">{{ $stats['paid_bills'] }}</h4>
                                        <small class="text-muted">Tagihan Lunas</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-warning bg-opacity-10 rounded p-3">
                                        <h4 class="mb-1 fw-bold text-warning">{{ $stats['unpaid_bills'] }}</h4>
                                        <small class="text-muted">Belum Bayar</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-info bg-opacity-10 rounded p-3">
                                        <h4 class="mb-1 fw-bold text-info">{{ $stats['total_bills'] }}</h4>
                                        <small class="text-muted">Total Tagihan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Students by Class Tables -->
        @foreach($studentsByClass as $className => $students)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-table me-2 text-primary"></i>
                            Kelas {{ $className }}
                        </h5>
                        <div class="d-flex align-items-center">
                            <small class="text-muted me-3">
                                {{ $students->count() }} siswa terdaftar
                            </small>
                            <span class="badge bg-primary">{{ $students->count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-rounded table-row-gray-300 table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="border-0 fw-bold text-uppercase" style="font-size: 12px; width: 60px;">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-hashtag me-2 text-primary"></i>
                                            No
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
                                            <i class="fas fa-file-invoice me-2 text-primary"></i>
                                            Status Tagihan
                                        </div>
                                    </th>
                                    <th class="border-0 fw-bold text-uppercase text-center" style="font-size: 12px;">
                                        <i class="fas fa-cogs text-primary"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students->sortBy('name') as $index => $student)
                                    <tr>
                                        <td class="align-middle">
                                            <span class="fw-bold text-muted">{{ $index + 1 }}</span>
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
                                            @php
                                                $unpaidCount = $student->sppBills->where('status', 'unpaid')->count();
                                                $paidCount = $student->sppBills->where('status', 'paid')->count();
                                                $totalCount = $student->sppBills->count();
                                            @endphp

                                            @if($totalCount == 0)
                                                <span class="badge badge-light-primary">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Belum ada tagihan
                                                </span>
                                            @elseif($unpaidCount == 0)
                                                <span class="badge badge-light-success">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Semua lunas ({{ $paidCount }})
                                                </span>
                                            @else
                                                <div class="d-flex flex-wrap gap-1">
                                                    <span class="badge badge-light-warning">
                                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                                        {{ $unpaidCount }} belum bayar
                                                    </span>
                                                    @if($paidCount > 0)
                                                        <span class="badge badge-light-success">
                                                            {{ $paidCount }} lunas
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

        @if($studentsByClass->isEmpty())
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="text-muted">
                        <i class="fas fa-users fa-4x mb-4"></i>
                        <h4>Belum Ada Siswa</h4>
                        <p>Belum ada siswa yang terdaftar dalam sistem.</p>
                        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Siswa Pertama
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-bold">Aksi Cepat</h6>
                        <small class="text-muted">Kelola data siswa dengan mudah</small>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-1"></i>
                            Semua Siswa
                        </a>
                        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>
                            Tambah Siswa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Add some interactive features
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight rows on hover
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f8fafc';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });

            // Add smooth scrolling for better UX
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>
