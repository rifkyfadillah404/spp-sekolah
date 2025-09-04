<x-admin-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0 text-dark fw-bold">
            Siswa Per Kelas
        </h2>
    </x-slot>

    <div class="container-fluid">
        <!-- Class Statistics Overview -->
        <div class="row mb-4">
            @foreach($classStats as $className => $stats)
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-graduation-cap me-2"></i>
                                Kelas {{ $className }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 mb-3">
                                    <div class="bg-primary bg-opacity-10 rounded p-3">
                                        <h4 class="mb-1 fw-bold text-primary">{{ $stats['total_students'] }}</h4>
                                        <small class="text-muted">Siswa</small>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="bg-success bg-opacity-10 rounded p-3">
                                        <h4 class="mb-1 fw-bold text-success">{{ $stats['paid_bills'] }}</h4>
                                        <small class="text-muted">Lunas</small>
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

        <!-- Students by Class (tanpa dropdown) -->
        @foreach($studentsByClass as $className => $students)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-users me-2"></i>
                        Kelas {{ $className }}
                        <span class="badge bg-primary ms-2">{{ $students->count() }} siswa</span>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-rounded table-row-gray-300 table-hover by-class-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Status Tagihan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students->sortBy('name') as $index => $student)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span class="fw-bold">{{ $student->nis }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-35px symbol-circle me-3">
                                                    <div class="symbol-label bg-light-primary text-primary">
                                                        {{ strtoupper(substr($student->name, 0, 2)) }}
                                                    </div>
                                                </div>
                                                <div class="text-gray-800 fw-bold fs-6">{{ $student->name }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-gray-800 fw-semibold fs-6">{{ $student->user->email }}</div>
                                        </td>
                                        <td>
                                            <div class="text-gray-600 fs-6">{{ $student->phone ?? '-' }}</div>
                                        </td>
                                        <td>
                                            @php
                                                $unpaidCount = $student->sppBills->where('status', 'unpaid')->count();
                                                $paidCount = $student->sppBills->where('status', 'paid')->count();
                                                $totalCount = $student->sppBills->count();
                                            @endphp

                                            @if($totalCount == 0)
                                                <span class="badge badge-light-primary">Belum ada tagihan</span>
                                            @elseif($unpaidCount == 0)
                                                <span class="badge badge-light-success">
                                                    <i class="fas fa-check me-1"></i> Semua lunas ({{ $paidCount }})
                                                </span>
                                            @else
                                                <span class="badge badge-light-warning">
                                                    <i class="fas fa-exclamation-triangle me-1"></i> {{ $unpaidCount }} belum bayar
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('admin.students.show', $student) }}"
                                                   class="btn btn-sm btn-light-primary btn-icon" title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.students.edit', $student) }}"
                                                   class="btn btn-sm btn-light-warning btn-icon" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.spp-bills.create') }}?student_id={{ $student->id }}"
                                                   class="btn btn-sm btn-light-success btn-icon" title="Buat Tagihan">
                                                    <i class="fas fa-plus"></i>
                                                </a>
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
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum Ada Siswa</h4>
                    <p class="text-muted">Belum ada siswa yang terdaftar dalam sistem.</p>
                    <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Siswa Pertama
                    </a>
                </div>
            </div>
        @endif

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <div>
                <a href="{{ route('admin.students.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-list"></i> Lihat Semua Siswa
                </a>
                <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Siswa Baru
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
