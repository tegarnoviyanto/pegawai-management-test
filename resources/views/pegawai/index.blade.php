@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Pegawai</h4>    
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
            + Tambah Pegawai
        </a>
    </div>
    <div class="table-responsive">
        <table id="pegawaiTable" class="table table-striped table-bordered align-middle w-100">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Umur</th>
                    <th>CV</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pegawais as $pegawai)
                <tr>
                    <td>{{ $pegawai->name }}</td>
                    <td>{{ $pegawai->position->name }}</td>
                    <td>{{ $pegawai->office->name }}</td>

                    {{-- IMPORTANT untuk sorting angka --}}
                    <td data-order="{{ $pegawai->age }}">
                        {{ $pegawai->age }} tahun
                    </td>

                    <td>
                        @if($pegawai->cv)
                            <a href="{{ asset('storage/'.$pegawai->cv) }}" 
                               target="_blank"
                               class="text-decoration-none">
                                {{ basename($pegawai->cv) }}
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection

@section('scripts')
<script>
$(function () {

    $('#pegawaiTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        order: [[0, 'asc']],
        columnDefs: [
            {
                targets: [1, 2, 4], // Position, Office, CV
                orderable: false
            }
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            zeroRecords: "Data tidak ditemukan",
            paginate: {
                next: "Next",
                previous: "Prev"
            }
        }
    });

});
</script>
@endsection