<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">
                    <i class="fas fa-file-invoice-dollar me-2 text-primary"></i>
                    Kelola Tagihan SPP
                </h2>
                <p class="text-muted mb-0">Pantau dan kelola semua tagihan SPP siswa</p>
            </div>
            <a href="{{ route('admin.spp-bills.create') }}" class="btn btn-primary btn-lg rounded-pill px-4 py-2">
                <i class="fas fa-plus-circle me-2"></i>
                Buat Tagihan Baru
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

        .bills-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .bills-table th {
            background: #f1f5f9;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .bills-table td {
            padding: 1.1rem 1.25rem;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .bills-table tr:last-child td {
            border-bottom: none;
        }

        .bills-table tr:hover {
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

        .badge-pending {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-unpaid {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-overdue {
            background: #fee2e2;
            color: #991b1b;
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
            .bills-table th, .bills-table td {
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
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="stat-title">Total Tagihan</div>
                <div class="stat-value">{{ $bills->total() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-success text-white">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-title">Sudah Lunas</div>
                <div class="stat-value">{{ $bills->where('status', 'paid')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-warning text-white">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-title">Belum Bayar</div>
                <div class="stat-value">{{ $bills->where('status', 'unpaid')->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-title">Terlambat</div>
                <div class="stat-value">{{ $bills->filter(fn($bill) => $bill->is_overdue)->count() }}</div>
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
                            placeholder="Masukkan nama atau NIS..." id="searchInput" style="height: 100%; padding: 1rem;">
                    </div>
                </div>
                <div>
                    <label class="form-label fw-600 mb-2 fs-6">Status</label>
                    <select class="form-select fs-6" id="statusFilter" style="height: 50px; padding: 0.75rem 1rem;">
                        <option value="">Semua Status</option>
                        <option value="paid">Lunas</option>
                        <option value="unpaid">Belum Bayar</option>
                        <option value="pending">Pending</option>
                        <option value="overdue">Terlambat</option>
                    </select>
                </div>
                <div>
                    <label class="form-label fw-600 mb-2 fs-6">Bulan</label>
                    <select class="form-select fs-6" id="monthFilter" style="height: 50px; padding: 0.75rem 1rem;">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="form-label fw-600 mb-2 fs-6">Tahun</label>
                    <select class="form-select fs-6" id="yearFilter" style="height: 50px; padding: 0.75rem 1rem;">
                        <option value="">Semua Tahun</option>
                        @for ($year = date('Y'); $year >= date('Y') - 3; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
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

        <!-- Bills Table -->
        <div class="table-card">
            <div class="table-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                <h5 class="table-title">
                    <i class="fas fa-table text-primary"></i>
                    Daftar Tagihan SPP
                </h5>
                <div class="action-buttons">
                    <button type="button" class="btn-action btn-outline-success" onclick="bulkExport()">
                        <i class="fas fa-download"></i>
                        Export Terpilih
                    </button>
                    <a href="{{ route('admin.reports.spp.excel') }}" class="btn-action btn-outline-primary">
                        <i class="fas fa-file-excel"></i>
                        Export Semua
                    </a>
                    <button type="button" class="btn-action btn-outline-danger" onclick="bulkDelete()">
                        <i class="fas fa-trash"></i>
                        Hapus Terpilih
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="bills-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                </div>
                            </th>
                            <th>Siswa</th>
                            <th>Periode</th>
                            <th>Jumlah</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bills as $bill)
                            <tr
                                class="bill-row {{ $bill->is_overdue && $bill->status !== 'paid' ? 'table-warning' : '' }}"
                                data-status="{{ $bill->status }}"
                                data-month="{{ (['Januari'=>1,'Februari'=>2,'Maret'=>3,'April'=>4,'Mei'=>5,'Juni'=>6,'Juli'=>7,'Agustus'=>8,'September'=>9,'Oktober'=>10,'November'=>11,'Desember'=>12,'January'=>1,'February'=>2,'March'=>3,'April'=>4,'May'=>5,'June'=>6,'July'=>7,'August'=>8,'September'=>9,'October'=>10,'November'=>11,'December'=>12][$bill->month] ?? (is_numeric($bill->month) ? intval($bill->month) : '')) }}"
                                data-year="{{ $bill->year }}"
                                data-overdue="{{ $bill->is_overdue && $bill->status !== 'paid' ? '1' : '0' }}">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input bill-checkbox" type="checkbox"
                                            value="{{ $bill->id }}"
                                            {{ $bill->status === 'paid' ? 'disabled' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar bg-primary">
                                            {{ strtoupper(substr($bill->student->name, 0, 2)) }}
                                        </div>
                                        <div class="student-details">
                                            <h6>{{ $bill->student->name }}</h6>
                                            <p>{{ $bill->student->nis }} • {{ $bill->student->class }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-600">{{ $bill->month }}</div>
                                        <div class="text-muted small">{{ $bill->year }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-success">{{ $bill->formatted_amount }}</div>
                                </td>
                                <td>
                                    @if ($bill->due_date)
                                        <div>
                                            <div class="fw-600">{{ $bill->due_date->format('d M Y') }}</div>
                                            <div class="small {{ $bill->is_overdue && $bill->status !== 'paid' ? 'text-danger' : 'text-muted' }}">
                                                {{ $bill->due_date->diffForHumans() }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-muted">Belum diset</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($bill->status === 'paid')
                                        <span class="badge-status badge-paid">
                                            <i class="fas fa-check-circle"></i>
                                            Lunas
                                        </span>
                                    @elseif ($bill->status === 'pending')
                                        <span class="badge-status badge-pending">
                                            <i class="fas fa-clock"></i>
                                            Pending
                                        </span>
                                    @elseif ($bill->status === 'unpaid')
                                        <div class="d-flex flex-wrap gap-1">
                                            <span class="badge-status badge-unpaid">
                                                <i class="fas fa-hourglass-half"></i>
                                                Belum Bayar
                                            </span>
                                            @if ($bill->is_overdue)
                                                <span class="badge-status badge-overdue">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Terlambat
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
                                                <a class="dropdown-item" href="{{ route('admin.spp-bills.show', $bill) }}">
                                                    <i class="fas fa-eye text-info me-2"></i>
                                                    Lihat Detail
                                                </a>
                                            </li>
                                            @if ($bill->status !== 'paid')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.spp-bills.edit', $bill) }}">
                                                        <i class="fas fa-edit text-warning me-2"></i>
                                                        Edit Tagihan
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item" onclick="exportSingle({{ $bill->id }})">
                                                        <i class="fas fa-download text-success me-2"></i>
                                                        Export Tagihan
                                                    </button>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('admin.spp-bills.destroy', $bill) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus tagihan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash me-2"></i>
                                                            Hapus Tagihan
                                                        </button>
                                                    </form>
                                                </li>
                                            @else
                                                <li>
                                                    <span class="dropdown-item text-muted">
                                                        <i class="fas fa-lock me-2"></i>
                                                        Tagihan Lunas
                                                    </span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <div class="empty-state">
                                        <i class="fas fa-file-invoice"></i>
                                        <h5>Belum Ada Tagihan</h5>
                                        <p>Belum ada tagihan SPP yang dibuat dalam sistem.</p>
                                        <a href="{{ route('admin.spp-bills.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i>
                                            Buat Tagihan Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($bills->hasPages())
                <div class="pagination">
                    <div class="pagination-info">
                        Menampilkan {{ $bills->firstItem() }} - {{ $bills->lastItem() }}
                        dari {{ $bills->total() }} tagihan
                    </div>
                    <div class="pagination-links">
                        {{ $bills->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            (function () {
                const searchInput = document.getElementById('searchInput');
                const statusFilter = document.getElementById('statusFilter');
                const monthFilter = document.getElementById('monthFilter');
                const yearFilter = document.getElementById('yearFilter');

                function applyFilters() {
                    const searchTerm = (searchInput?.value || '').toLowerCase().trim();
                    const selectedStatus = statusFilter?.value || '';
                    const selectedMonth = monthFilter?.value || '';
                    const selectedYear = yearFilter?.value || '';

                    document.querySelectorAll('.bill-row').forEach(row => {
                        const text = row.textContent.toLowerCase();
                        const rowStatus = row.dataset.status || '';
                        const rowMonth = row.dataset.month || '';
                        const rowYear = row.dataset.year || '';
                        const rowOverdue = row.dataset.overdue === '1';

                        const matchesSearch = !searchTerm || text.includes(searchTerm);

                        let matchesStatus = true;
                        if (selectedStatus) {
                            matchesStatus = selectedStatus === 'overdue'
                                ? rowOverdue
                                : rowStatus === selectedStatus;
                        }

                        const matchesMonth = !selectedMonth || String(rowMonth) === String(selectedMonth);
                        const matchesYear = !selectedYear || String(rowYear) === String(selectedYear);

                        row.style.display = (matchesSearch && matchesStatus && matchesMonth && matchesYear) ? '' : 'none';
                    });
                }

                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        applyFilters();
                        updateSelectAllAfterFilter();
                    });
                }
                if (statusFilter) {
                    statusFilter.addEventListener('change', function() {
                        applyFilters();
                        updateSelectAllAfterFilter();
                    });
                }
                if (monthFilter) {
                    monthFilter.addEventListener('change', function() {
                        applyFilters();
                        updateSelectAllAfterFilter();
                    });
                }
                if (yearFilter) {
                    yearFilter.addEventListener('change', function() {
                        applyFilters();
                        updateSelectAllAfterFilter();
                    });
                }

                window.resetFilters = function () {
                    if (searchInput) searchInput.value = '';
                    if (statusFilter) statusFilter.value = '';
                    if (monthFilter) monthFilter.value = '';
                    if (yearFilter) yearFilter.value = '';
                    applyFilters();
                    updateSelectAllAfterFilter();
                };

                // Select all functionality
                const selectAll = document.getElementById('selectAll');

                function getVisibleCheckboxes() {
                    return document.querySelectorAll('.bill-row:not([style*="display: none"]) .bill-checkbox');
                }

                function getCheckedVisibleCheckboxes() {
                    return document.querySelectorAll('.bill-row:not([style*="display: none"]) .bill-checkbox:checked');
                }

                function updateSelectAllState() {
                    if (!selectAll) return;

                    const visibleCheckboxes = getVisibleCheckboxes();
                    const enabledCheckboxes = document.querySelectorAll('.bill-row:not([style*="display: none"]) .bill-checkbox:not(:disabled)');
                    const checkedBoxes = getCheckedVisibleCheckboxes();

                    if (visibleCheckboxes.length === 0) {
                        selectAll.checked = false;
                        selectAll.indeterminate = false;
                    } else if (checkedBoxes.length === enabledCheckboxes.length && enabledCheckboxes.length > 0) {
                        selectAll.checked = true;
                        selectAll.indeterminate = false;
                    } else if (checkedBoxes.length > 0) {
                        selectAll.checked = false;
                        selectAll.indeterminate = true;
                    } else {
                        selectAll.checked = false;
                        selectAll.indeterminate = false;
                    }
                }

                // Select all checkbox event
                if (selectAll) {
                    selectAll.addEventListener('change', function () {
                        const enabledCheckboxes = document.querySelectorAll('.bill-row:not([style*="display: none"]) .bill-checkbox:not(:disabled)');
                        enabledCheckboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                    });
                }

                // Individual checkbox change event
                document.addEventListener('change', function(e) {
                    if (e.target.classList.contains('bill-checkbox')) {
                        updateSelectAllState();
                    }
                });

                // Update select all state when filters change
                function updateSelectAllAfterFilter() {
                    setTimeout(() => {
                        updateSelectAllState();
                    }, 50);
                }

                // Export single bill
                window.exportSingle = function (billId) {
                    if (confirm('Export tagihan ini ke Excel?')) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route("admin.spp-bills.bulk-export") }}';

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        form.appendChild(csrfToken);

                        const billIdInput = document.createElement('input');
                        billIdInput.type = 'hidden';
                        billIdInput.name = 'bill_ids[]';
                        billIdInput.value = billId;
                        form.appendChild(billIdInput);

                        document.body.appendChild(form);
                        form.submit();
                        document.body.removeChild(form);
                    }
                };

                // Bulk export
                window.bulkExport = function () {
                    const checkedBoxes = document.querySelectorAll('.bill-checkbox:checked:not(:disabled)');
                    if (checkedBoxes.length === 0) {
                        alert('Pilih tagihan yang ingin di-export terlebih dahulu.');
                        return;
                    }

                    if (confirm(`Export ${checkedBoxes.length} tagihan ke Excel?`)) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route("admin.spp-bills.bulk-export") }}';

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';
                        form.appendChild(csrfToken);

                        checkedBoxes.forEach(checkbox => {
                            const billIdInput = document.createElement('input');
                            billIdInput.type = 'hidden';
                            billIdInput.name = 'bill_ids[]';
                            billIdInput.value = checkbox.value;
                            form.appendChild(billIdInput);
                        });

                        document.body.appendChild(form);
                        form.submit();
                        document.body.removeChild(form);
                    }
                };

                // Bulk delete (placeholder)
                window.bulkDelete = function () {
                    const checkedBoxes = document.querySelectorAll('.bill-checkbox:checked:not(:disabled)');
                    if (checkedBoxes.length === 0) {
                        alert('Pilih tagihan yang ingin dihapus terlebih dahulu.');
                        return;
                    }

                    if (confirm(`Yakin ingin menghapus ${checkedBoxes.length} tagihan?`)) {
                        alert('Fitur bulk delete akan segera tersedia!');
                    }
                };

                // Auto-refresh every 30 seconds for real-time updates
                setInterval(function () {
                    console.log('Auto-refresh triggered');
                }, 30000);

                // Initial apply
                applyFilters();
                updateSelectAllState();
            })();
        </script>
    @endpush
</x-admin-layout>
