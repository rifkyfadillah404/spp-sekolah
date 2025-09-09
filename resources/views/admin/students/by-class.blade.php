<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">Siswa Per Kelas</h2>
                <p class="text-muted mb-0">Lihat dan kelola siswa berdasarkan kelas masing-masing</p>
            </div>
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

        .table-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
            margin-bottom: 1.5rem;
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

        .badge-paid {
            background: #dcfce7;
            color: #166534;
        }

        .badge-unpaid {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-pending {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-overdue {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-empty {
            background: #f1f5f9;
            color: #64748b;
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
        }

        @media (max-width: 768px) {
            .stats-container {
                grid-template-columns: 1fr;
            }

            .table-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .action-buttons {
                width: 100%;
                justify-content: center;
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
        <!-- Class Statistics Overview -->
        <div class="stats-container">
            @foreach($classStats as $className => $stats)
                <div class="stat-card">
                    <div class="stat-icon bg-primary text-white">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stat-title">Kelas {{ $className }}</div>
                    <div class="stat-value">{{ $stats['total_students'] }}</div>
                    <div class="mt-2">
                        <small class="text-muted">{{ $stats['paid_bills'] }} lunas • {{ $stats['unpaid_bills'] }} belum bayar</small>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Students by Class Tables -->
        @foreach($studentsByClass as $className => $students)
            <div class="table-card">
                <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <h5 class="table-title">
                        <i class="fas fa-table text-primary"></i>
                        Kelas {{ $className }}
                    </h5>
                    <div class="d-flex align-items-center gap-3">
                        <span class="text-muted">{{ $students->count() }} siswa</span>
                        <div class="action-buttons">
                            <a href="{{ route('admin.students.create') }}?class={{ $className }}" class="btn-action btn-outline-primary">
                                <i class="fas fa-user-plus"></i>
                                Tambah Siswa
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="students-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll{{ $className }}">
                                    </div>
                                </th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Status Tagihan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students->sortBy('name') as $index => $student)
                                <tr>
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
                                        <div>
                                            <div class="fw-semibold">{{ $student->user->email }}</div>
                                            <span class="badge-status badge-paid">
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
                                        @php
                                            $unpaidCount = $student->sppBills->where('status', 'unpaid')->count();
                                            $paidCount = $student->sppBills->where('status', 'paid')->count();
                                            $totalCount = $student->sppBills->count();
                                        @endphp

                                        @if($totalCount == 0)
                                            <span class="badge-status badge-empty">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Belum ada tagihan
                                            </span>
                                        @elseif($unpaidCount == 0)
                                            <span class="badge-status badge-paid">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Semua lunas ({{ $paidCount }})
                                            </span>
                                        @else
                                            <div class="d-flex flex-wrap gap-1">
                                                <span class="badge-status badge-unpaid">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                                    {{ $unpaidCount }} belum bayar
                                                </span>
                                                @if($paidCount > 0)
                                                    <span class="badge-status badge-paid">
                                                        {{ $paidCount }} lunas
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
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
                            @endforeach
                        </tbody>
                    </table>
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