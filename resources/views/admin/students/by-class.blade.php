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

        <!-- Students by Class -->
        @foreach($studentsByClass as $className => $students)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-users me-2"></i> 
                        Kelas {{ $className }}
                        <span class="badge bg-primary ms-2">{{ $students->count() }} siswa</span>
                    </h5>
                    <button class="btn btn-sm btn-outline-primary" type="button" 
                            data-bs-toggle="collapse" data-bs-target="#class-{{ Str::slug($className) }}" 
                            aria-expanded="true">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div class="collapse show" id="class-{{ Str::slug($className) }}">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
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
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                                         style="width: 32px; height: 32px; font-size: 12px;">
                                                        {{ strtoupper(substr($student->name, 0, 2)) }}
                                                    </div>
                                                    <strong>{{ $student->name }}</strong>
                                                </div>
                                            </td>
                                            <td>{{ $student->user->email }}</td>
                                            <td>{{ $student->phone ?? '-' }}</td>
                                            <td>
                                                @php
                                                    $unpaidCount = $student->sppBills->where('status', 'unpaid')->count();
                                                    $paidCount = $student->sppBills->where('status', 'paid')->count();
                                                    $totalCount = $student->sppBills->count();
                                                @endphp
                                                
                                                @if($totalCount == 0)
                                                    <span class="badge bg-secondary">Belum ada tagihan</span>
                                                @elseif($unpaidCount == 0)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check"></i> Semua lunas ({{ $paidCount }})
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning">
                                                        <i class="fas fa-exclamation-triangle"></i> {{ $unpaidCount }} belum bayar
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.students.show', $student) }}" 
                                                       class="btn btn-sm btn-info" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.students.edit', $student) }}" 
                                                       class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.spp-bills.create') }}?student_id={{ $student->id }}" 
                                                       class="btn btn-sm btn-success" title="Buat Tagihan">
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

    @push('scripts')
    <script>
        // Auto collapse/expand functionality
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('[data-bs-toggle="collapse"]');
            
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const target = document.querySelector(this.getAttribute('data-bs-target'));
                    
                    target.addEventListener('shown.bs.collapse', function() {
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    });
                    
                    target.addEventListener('hidden.bs.collapse', function() {
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    });
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>
