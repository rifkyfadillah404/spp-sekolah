<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Informasi Siswa</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td width="150"><strong>NIS:</strong></td>
                                            <td>{{ $student->nis }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td>{{ $student->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Kelas:</strong></td>
                                            <td>{{ $student->class }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td>{{ $student->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Telepon:</strong></td>
                                            <td>{{ $student->phone ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Alamat:</strong></td>
                                            <td>{{ $student->address ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Terdaftar:</strong></td>
                                            <td>{{ $student->created_at->format('d F Y') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Statistik Tagihan</h5>
                                </div>
                                <div class="card-body">
                                    @php
                                        $totalBills = $student->sppBills->count();
                                        $paidBills = $student->sppBills->where('status', 'paid')->count();
                                        $unpaidBills = $student->sppBills->where('status', 'unpaid')->count();
                                        $pendingBills = $student->sppBills->where('status', 'pending')->count();
                                        $totalAmount = $student->sppBills->sum('amount');
                                        $paidAmount = $student->sppBills->where('status', 'paid')->sum('amount');
                                    @endphp
                                    
                                    <div class="row text-center">
                                        <div class="col-6 mb-3">
                                            <div class="border rounded p-3">
                                                <h4 class="text-primary">{{ $totalBills }}</h4>
                                                <small class="text-muted">Total Tagihan</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="border rounded p-3">
                                                <h4 class="text-success">{{ $paidBills }}</h4>
                                                <small class="text-muted">Lunas</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="border rounded p-3">
                                                <h4 class="text-warning">{{ $pendingBills }}</h4>
                                                <small class="text-muted">Pending</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="border rounded p-3">
                                                <h4 class="text-danger">{{ $unpaidBills }}</h4>
                                                <small class="text-muted">Belum Bayar</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    
                                    <div class="text-center">
                                        <p class="mb-1"><strong>Total Tagihan:</strong></p>
                                        <h5 class="text-primary">Rp {{ number_format($totalAmount, 0, ',', '.') }}</h5>
                                        <p class="mb-1"><strong>Sudah Dibayar:</strong></p>
                                        <h5 class="text-success">Rp {{ number_format($paidAmount, 0, ',', '.') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Riwayat Tagihan SPP</h5>
                        </div>
                        <div class="card-body">
                            @if($student->sppBills->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Periode</th>
                                                <th>Jumlah</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($student->sppBills->sortByDesc('year')->sortByDesc('month') as $bill)
                                                <tr class="{{ $bill->is_overdue ? 'table-danger' : '' }}">
                                                    <td>{{ $bill->month }} {{ $bill->year }}</td>
                                                    <td>{{ $bill->formatted_amount }}</td>
                                                    <td>{{ $bill->due_date->format('d/m/Y') }}</td>
                                                    <td>
                                                        @if($bill->status === 'paid')
                                                            <span class="badge bg-success">Lunas</span>
                                                        @elseif($bill->status === 'pending')
                                                            <span class="badge bg-warning">Pending</span>
                                                        @elseif($bill->is_overdue)
                                                            <span class="badge bg-danger">Terlambat</span>
                                                        @else
                                                            <span class="badge bg-secondary">Belum Bayar</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.spp-bills.show', $bill) }}" 
                                                           class="btn btn-sm btn-info">Detail</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Belum ada tagihan SPP untuk siswa ini.</p>
                                    <a href="{{ route('admin.spp-bills.create') }}" class="btn btn-primary">
                                        Buat Tagihan Pertama
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        
                        <div>
                            <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Siswa
                            </a>
                            <a href="{{ route('admin.spp-bills.create') }}?student_id={{ $student->id }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Buat Tagihan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
