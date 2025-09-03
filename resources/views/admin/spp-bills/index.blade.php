<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h4 mb-1 fw-bold text-dark">Kelola Tagihan SPP</h2>
                <p class="text-muted mb-0">Pantau dan kelola semua tagihan SPP siswa</p>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge bg-primary me-3">
                    <i class="fas fa-file-invoice me-1"></i>
                    {{ $bills->total() }} tagihan
                </span>
                <a href="{{ route('admin.spp-bills.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Buat Tagihan
                </a>
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
                            <button class="btn btn-outline-secondary me-2" onclick="resetFilters()">
                                <i class="fas fa-undo me-1"></i>
                                Reset
                            </button>
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
                        <small class="text-muted me-3">
                            Menampilkan {{ $bills->firstItem() ?? 0 }} - {{ $bills->lastItem() ?? 0 }}
                            dari {{ $bills->total() }} tagihan
                        </small>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary" onclick="bulkMarkPaid()">
                                <i class="fas fa-check me-1"></i>
                                Tandai Lunas
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
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="billsTable">
                        <thead class="table-light">
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
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 40px; height: 40px; font-size: 14px;">
                                                {{ strtoupper(substr($bill->student->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $bill->student->name }}</div>
                                                <small class="text-muted">
                                                    {{ $bill->student->nis }} • {{ $bill->student->class }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div>
                                            <div class="fw-bold">
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
                                            <small class="text-muted">{{ $bill->year }}</small>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="fw-bold text-success">{{ $bill->formatted_amount }}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div>
                                            @if ($bill->due_date)
                                                <div class="fw-bold">{{ $bill->due_date->format('d M Y') }}</div>
                                                @if ($bill->is_overdue && $bill->status !== 'paid')
                                                    <small class="text-danger">
                                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                                        {{ $bill->due_date->diffForHumans() }}
                                                    </small>
                                                @else
                                                    <small
                                                        class="text-muted">{{ $bill->due_date->diffForHumans() }}</small>
                                                @endif
                                            @else
                                                <div class="fw-bold text-muted">Belum diset</div>
                                                <small class="text-muted">Tanggal jatuh tempo belum diatur</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if ($bill->status === 'paid')
                                            <span
                                                class="badge bg-success bg-opacity-10 text-success border border-success">
                                                <i class="fas fa-check-circle me-1"></i>
                                                Lunas
                                            </span>
                                        @elseif ($bill->status === 'pending')
                                            <span class="badge bg-info bg-opacity-10 text-info border border-info">
                                                <i class="fas fa-clock me-1"></i>
                                                Pending
                                            </span>
                                        @elseif ($bill->status === 'unpaid')
                                            <span
                                                class="badge bg-warning bg-opacity-10 text-warning border border-warning me-1">
                                                <i class="fas fa-hourglass-half me-1"></i>
                                                Belum Bayar
                                            </span>
                                            @if ($bill->is_overdue)
                                                <span
                                                    class="badge bg-danger bg-opacity-10 text-danger border border-danger">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                                    Terlambat
                                                </span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary">
                                                {{ ucfirst($bill->status) }}
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
                                                            onclick="markAsPaid({{ $bill->id }})">
                                                            <i class="fas fa-check me-2 text-success"></i>
                                                            Tandai Lunas
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

                if (searchInput) searchInput.addEventListener('input', applyFilters);
                if (statusFilter) statusFilter.addEventListener('change', applyFilters);
                if (monthFilter) monthFilter.addEventListener('change', applyFilters);
                if (yearFilter) yearFilter.addEventListener('change', applyFilters);

                window.resetFilters = function () {
                    if (searchInput) searchInput.value = '';
                    if (statusFilter) statusFilter.value = '';
                    if (monthFilter) monthFilter.value = '';
                    if (yearFilter) yearFilter.value = '';
                    applyFilters();
                };

                // Select all functionality
                const selectAll = document.getElementById('selectAll');
                if (selectAll) {
                    selectAll.addEventListener('change', function () {
                        const checkboxes = document.querySelectorAll('.bill-checkbox:not(:disabled)');
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                    });
                }

                // Mark as paid (placeholder)
                window.markAsPaid = function (billId) {
                    if (confirm('Tandai tagihan ini sebagai lunas?')) {
                        alert('Fitur tandai lunas akan segera tersedia!');
                    }
                };

                // Bulk mark as paid (placeholder)
                window.bulkMarkPaid = function () {
                    const checkedBoxes = document.querySelectorAll('.bill-checkbox:checked');
                    if (checkedBoxes.length === 0) {
                        alert('Pilih tagihan yang ingin ditandai lunas terlebih dahulu.');
                        return;
                    }

                    if (confirm(`Tandai ${checkedBoxes.length} tagihan sebagai lunas?`)) {
                        alert('Fitur bulk mark paid akan segera tersedia!');
                    }
                };

                // Bulk delete (placeholder)
                window.bulkDelete = function () {
                    const checkedBoxes = document.querySelectorAll('.bill-checkbox:checked');
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
            })();
        </script>
    @endpush
</x-admin-layout>
