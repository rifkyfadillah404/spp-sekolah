<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Tagihan SPP Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.spp-bills.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="class" class="form-label">Pilih Kelas</label>
                                    <select class="form-select" id="class" name="class" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class }}" {{ old('class') == $class ? 'selected' : '' }}>
                                                {{ $class }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="student_id" class="form-label">Pilih Siswa</label>
                                    <select class="form-select @error('student_id') is-invalid @enderror"
                                            id="student_id" name="student_id" required disabled>
                                        <option value="">-- Pilih Siswa --</option>
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
                                           id="amount" name="amount" value="{{ old('amount', 500000) }}"
                                           min="0" step="1000" required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
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
                                            <option value="{{ $month }}" {{ old('month') == $month ? 'selected' : '' }}>
                                                {{ $month }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Tahun</label>
                                    <select class="form-select @error('year') is-invalid @enderror"
                                            id="year" name="year" required>
                                        <option value="">-- Pilih Tahun --</option>
                                        @for($year = date('Y') - 1; $year <= date('Y') + 1; $year++)
                                            <option value="{{ $year }}" {{ old('year', date('Y')) == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="due_date" class="form-label">Tanggal Jatuh Tempo</label>
                                    <input type="date" class="form-control @error('due_date') is-invalid @enderror"
                                           id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                                    @error('due_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Info:</strong> Pastikan kombinasi siswa, bulan, dan tahun belum pernah dibuat sebelumnya.
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.spp-bills.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Buat Tagihan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const classSelect = document.getElementById('class');
            const studentSelect = document.getElementById('student_id');
            const studentIdOld = '{{ old('student_id') }}';

            // Auto set due date to end of selected month
            document.getElementById('month').addEventListener('change', updateDueDate);
            document.getElementById('year').addEventListener('change', updateDueDate);

            function updateDueDate() {
                const month = document.getElementById('month').value;
                const year = document.getElementById('year').value;

                if (month && year) {
                    const monthIndex = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ].indexOf(month);

                    if (monthIndex !== -1) {
                        const lastDay = new Date(year, monthIndex + 1, 0).getDate();
                        const dueDate = new Date(year, monthIndex, lastDay);

                        const formattedDate = dueDate.toISOString().split('T')[0];
                        document.getElementById('due_date').value = formattedDate;
                    }
                }
            }

            classSelect.addEventListener('change', function() {
                const selectedClass = this.value;
                studentSelect.innerHTML = '<option value="">-- Memuat Siswa --</option>';
                studentSelect.disabled = true;

                if (selectedClass) {
                    fetch(`{{ route('admin.spp-bills.getStudentsByClass') }}?class=${selectedClass}`)
                        .then(response => response.json())
                        .then(data => {
                            studentSelect.innerHTML = '<option value="">-- Pilih Siswa --</option>';
                            data.forEach(student => {
                                const option = document.createElement('option');
                                option.value = student.id;
                                option.textContent = `${student.nis} - ${student.name}`;
                                if (student.id == studentIdOld) {
                                    option.selected = true;
                                }
                                studentSelect.appendChild(option);
                            });
                            studentSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error fetching students:', error);
                            studentSelect.innerHTML = '<option value="">-- Gagal memuat siswa --</option>';
                        });
                } else {
                    studentSelect.innerHTML = '<option value="">-- Pilih Siswa --</option>';
                    studentSelect.disabled = true;
                }
            });

            // Trigger change on page load if a class is already selected
            if (classSelect.value) {
                classSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
    @endpush
</x-admin-layout>
