<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">Kelola Tagihan SPP</h2>
                <p class="text-muted mb-0">Pantau dan kelola semua tagihan SPP siswa</p>
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
                                <h6 class="text-muted mb-1">Total Tagihan</h6>
                                <h3 class="mb-0 fw-bold text-primary">{{ $bills->total() }}</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded p-3">
                                <i class="fas fa-file-invoice fa-2x text-primary"></i>
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
                                <h6 class="text-muted mb-1">Sudah Lunas</h6>
                                <h3 class="mb-0 fw-bold text-success">{{ $bills->where('status', 'paid')->count() }}
                                </h3>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded p-3">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
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
                                <h6 class="text-muted mb-1">Belum Bayar</h6>
                                <h3 class="mb-0 fw-bold text-warning">{{ $bills->where('status', 'unpaid')->count() }}
                                </h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded p-3">
                                <i class="fas fa-clock fa-2x text-warning"></i>
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
                                <h6 class="text-muted mb-1">Terlambat</h6>
                                <h3 class="mb-0 fw-bold text-danger">
                                    {{ $bills->filter(fn($bill) => $bill->is_overdue)->count() }}</h3>
                            </div>
                            <div class="bg-danger bg-opacity-10 rounded p-3">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
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
                                placeholder="Cari berdasarkan nama siswa atau NIS..." id="searchInput">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="paid">Lunas</option>
                            <option value="unpaid">Belum Bayar</option>
                            <option value="pending">Pending</option>
                            <option value="overdue">Terlambat</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="monthFilter">
                            <option value="">Semua Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="yearFilter">
                            <option value="">Semua Tahun</option>
                            @for ($year = date('Y'); $year >= date('Y') - 3; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex">
                            <!-- <button class="btn btn-outline-secondary me-2" onclick="resetFilters()">
                                <i class="fas fa-undo me-1"></i>
                                Reset
                            </button> -->
                            <div class="d-flex">
                            <button class="btn btn-danger me-2" onclick="exportPDF()">
                                <i class="fas fa-file-pdf me-1"></i>
                                PDF
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bills Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-table me-2 text-primary"></i>
                        Daftar Tagihan SPP
                    </h5>
                    <div class="d-flex align-items-center">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-success" onclick="bulkExport()">
                                <i class="fas fa-download me-1"></i>
                                Export Terpilih
                            </button>
                            <a href="{{ route('admin.reports.spp.excel') }}" class="btn btn-outline-primary">
                                <i class="fas fa-file-excel me-1"></i>
                                Export Semua
                            </a>
                            <button type="button" class="btn btn-outline-danger" onclick="bulkDelete()">
                                <i class="fas fa-trash me-1"></i>
                                Hapus Terpilih
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-rounded table-row-gray-300 table-hover mb-0" id="billsTable">
                        <thead>
                            <tr>
                                <th class="border-0" style="width: 50px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user me-2 text-primary"></i>
                                        Siswa
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar me-2 text-primary"></i>
                                        Periode
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-money-bill me-2 text-primary"></i>
                                        Jumlah
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-clock me-2 text-primary"></i>
                                        Jatuh Tempo
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase" style="font-size: 12px;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle me-2 text-primary"></i>
                                        Status
                                    </div>
                                </th>
                                <th class="border-0 fw-bold text-uppercase text-center" style="font-size: 12px;">
                                    <i class="fas fa-cogs text-primary"></i>
                                    Aksi
                                </th>
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
                                    <td class="align-middle">
                                        <div class="form-check">
                                            <input class="form-check-input bill-checkbox" type="checkbox"
                                                value="{{ $bill->id }}"
                                                {{ $bill->status === 'paid' ? 'disabled' : '' }}>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px symbol-circle me-3">
                                                <div class="symbol-label bg-light-primary text-primary">
                                                    {{ strtoupper(substr($bill->student->name, 0, 2)) }}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="text-gray-800 fw-bold fs-6">{{ $bill->student->name }}</div>
                                                <div class="text-muted fs-7">
                                                    {{ $bill->student->nis }} • {{ $bill->student->class }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column">
                                            <div class="text-gray-800 fw-bold fs-6">
                                                @php
                                                    $monthNames = [
                                                        'Januari' => 'January',
                                                        'Februari' => 'February',
                                                        'Maret' => 'March',
                                                        'April' => 'April',
                                                        'Mei' => 'May',
                                                        'Juni' => 'June',
                                                        'Juli' => 'July',
                                                        'Agustus' => 'August',
                                                        'September' => 'September',
                                                        'Oktober' => 'October',
                                                        'November' => 'November',
                                                        'Desember' => 'December',
                                                    ];
                                                @endphp
                                                {{ $monthNames[$bill->month] ?? $bill->month }}
                                            </div>
                                            <div class="text-muted fs-7">{{ $bill->year }}</div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="text-success fw-bold fs-6">{{ $bill->formatted_amount }}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex flex-column">
                                            @if ($bill->due_date)
                                                <div class="text-gray-800 fw-bold fs-6">{{ $bill->due_date->format('d M Y') }}</div>
                                                @if ($bill->is_overdue && $bill->status !== 'paid')
                                                    <div class="text-danger fs-7">
                                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                                        {{ $bill->due_date->diffForHumans() }}
                                                    </div>
                                                @else
                                                    <div class="text-muted fs-7">{{ $bill->due_date->diffForHumans() }}</div>
                                                @endif
                                            @else
                                                <div class="text-muted fw-bold fs-6">Belum diset</div>
                                                <div class="text-muted fs-7">Tanggal jatuh tempo belum diatur</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if ($bill->status === 'paid')
                                            <span class="badge badge-light-success">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Lunas
                                            </span>
                                        @elseif ($bill->status === 'pending')
                                            <span class="badge badge-light-info">
                                                <i class="fas fa-clock me-1"></i>
                                                Pending
                                            </span>
                                        @elseif ($bill->status === 'unpaid')
                                            <div class="d-flex flex-wrap gap-1">
                                                <span class="badge badge-light-warning">
                                                    <i class="fas fa-hourglass-half me-1"></i>
                                                    Belum Bayar
                                                </span>
                                                @if ($bill->is_overdue)
                                                    <span class="badge badge-light-danger">
                                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                                        Terlambat
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="badge badge-light-primary">
                                                {{ ucfirst($bill->status) }}
                                            </span>
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
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.spp-bills.show', $bill) }}">
                                                        <i class="fas fa-eye me-2 text-info"></i>
                                                        Lihat Detail
                                                    </a>
                                                </li>
                                                @if ($bill->status !== 'paid')
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.spp-bills.edit', $bill) }}">
                                                            <i class="fas fa-edit me-2 text-warning"></i>
                                                            Edit Tagihan
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item"
                                                            onclick="exportSingle({{ $bill->id }})">
                                                            <i class="fas fa-download me-2 text-success"></i>
                                                            Export Tagihan
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
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
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-file-invoice fa-3x mb-3"></i>
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
            </div>

            <!-- Pagination -->
            @if ($bills->hasPages())
                <div class="card-footer bg-white border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Menampilkan {{ $bills->firstItem() }} - {{ $bills->lastItem() }}
                            dari {{ $bills->total() }} tagihan
                        </div>
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
