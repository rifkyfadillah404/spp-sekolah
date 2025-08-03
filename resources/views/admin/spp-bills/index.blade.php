<x-admin-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Tagihan SPP') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Siswa</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Jumlah</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bills as $bill)
                                    <tr class="{{ $bill->is_overdue ? 'table-danger' : '' }}">
                                        <td>{{ $bill->student->name }}</td>
                                        <td>{{ $bill->student->nis }}</td>
                                        <td>{{ $bill->student->class }}</td>
                                        <td>{{ $bill->month }}</td>
                                        <td>{{ $bill->year }}</td>
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
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.spp-bills.show', $bill) }}"
                                                   class="btn btn-sm btn-info">Lihat</a>
                                                @if($bill->status !== 'paid')
                                                    <a href="{{ route('admin.spp-bills.edit', $bill) }}"
                                                       class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('admin.spp-bills.destroy', $bill) }}"
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus tagihan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $bills->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
