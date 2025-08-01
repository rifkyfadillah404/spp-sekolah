<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tagihan SPP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.spp-bills.update', $sppBill) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="student_id" class="form-label">Pilih Siswa</label>
                                    <select class="form-select @error('student_id') is-invalid @enderror" 
                                            id="student_id" name="student_id" required>
                                        <option value="">-- Pilih Siswa --</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" 
                                                {{ (old('student_id', $sppBill->student_id) == $student->id) ? 'selected' : '' }}>
                                                {{ $student->nis }} - {{ $student->name }} ({{ $student->class }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Jumlah Tagihan (Rp)</label>
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                           id="amount" name="amount" value="{{ old('amount', $sppBill->amount) }}" 
                                           min="0" step="1000" required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="month" class="form-label">Bulan</label>
                                    <select class="form-select @error('month') is-invalid @enderror" 
                                            id="month" name="month" required>
                                        <option value="">-- Pilih Bulan --</option>
                                        @php
                                            $months = [
                                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                            ];
                                        @endphp
                                        @foreach($months as $month)
                                            <option value="{{ $month }}" 
                                                {{ old('month', $sppBill->month) == $month ? 'selected' : '' }}>
                                                {{ $month }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Tahun</label>
                                    <select class="form-select @error('year') is-invalid @enderror" 
                                            id="year" name="year" required>
                                        <option value="">-- Pilih Tahun --</option>
                                        @for($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                                            <option value="{{ $year }}" 
                                                {{ old('year', $sppBill->year) == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="due_date" class="form-label">Tanggal Jatuh Tempo</label>
                                    <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                                           id="due_date" name="due_date" 
                                           value="{{ old('due_date', $sppBill->due_date->format('Y-m-d')) }}" required>
                                    @error('due_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="unpaid" {{ old('status', $sppBill->status) == 'unpaid' ? 'selected' : '' }}>
                                            Belum Bayar
                                        </option>
                                        <option value="pending" {{ old('status', $sppBill->status) == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="paid" {{ old('status', $sppBill->status) == 'paid' ? 'selected' : '' }}>
                                            Lunas
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if($sppBill->payment)
                            <div class="alert alert-info">
                                <strong>Info:</strong> Tagihan ini terkait dengan pembayaran 
                                <strong>{{ $sppBill->payment->order_id }}</strong> 
                                dengan status <strong>{{ $sppBill->payment->transaction_status }}</strong>.
                            </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.spp-bills.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update Tagihan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
