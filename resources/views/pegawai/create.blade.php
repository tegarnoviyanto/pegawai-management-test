@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-4">Tambah Pegawai</h2>

    <form action="{{ route('pegawai.store') }}" method="POST" id="pegawaiForm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Position</label>
            <select name="position_id" class="form-select select2">
                <option></option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Office</label>
            <select name="office_id" class="form-select select2">
                <option></option>
                @foreach($offices as $office)
                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="text" name="tanggal_lahir" class="form-control datepicker" autocomplete="off">
        </div>

        {{-- UPLOAD CV --}}
        <div class="mb-4">
            <label class="form-label">Upload CV</label>

            <div id="cvDropzone" class="border rounded p-4 text-center bg-light">
                <h6 class="mb-2">Drag & Drop CV di sini</h6>
                <p class="text-muted small">Format: PDF, DOC, DOCX (Max 2MB)</p>

                <button type="button" class="btn btn-outline-primary btn-sm" id="btnPilihCv">
                    Pilih File
                </button>

                <div id="cvPreview" class="mt-3"></div>
            </div>

            <input type="hidden" name="cv" id="cv_path">
        </div>

        <div class="d-flex gap-2">
    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary px-4">
        Kembali
    </a>

    <button type="submit" class="btn btn-success px-4">
        Simpan
    </button>
</div>
    </form>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {

    // SELECT2
    $('.select2').select2({
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Pilih data',
        allowClear: true
    });

    // DATEPICKER
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "1950:2026"
    });

    // DROPZONE
    Dropzone.autoDiscover = false;

    let currentPath = null;

    let myDropzone = new Dropzone("#cvDropzone", {
        url: "{{ route('pegawai.upload-cv') }}",
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        clickable: "#btnPilihCv",
        maxFiles: 1,
        maxFilesize: 2,
        acceptedFiles: ".pdf,.doc,.docx",
        previewsContainer: false,

        success: function(file, response) {

            // Hapus file lama jika ada
            if (currentPath) {
                $.ajax({
                    url: "{{ route('pegawai.delete-cv') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        path: currentPath
                    }
                });
            }

            currentPath = response.path;
            $('#cv_path').val(response.path);

            let fileUrl = "{{ asset('storage') }}/" + response.path;

            $('#cvPreview').html(`
                <div class="alert alert-success py-2 d-flex justify-content-between align-items-center">
                    <div>
                        <strong>File:</strong>
                        <a href="${fileUrl}" target="_blank" class="text-decoration-underline">
                            ${file.name}
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger" id="btnRemoveCv">
                        Hapus
                    </button>
                </div>
            `);
        }
    });

    // HAPUS FILE
    $(document).on('click', '#btnRemoveCv', function() {

        let path = $('#cv_path').val();
        if (!path) return;

        $.ajax({
            url: "{{ route('pegawai.delete-cv') }}",
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}",
                path: path
            },
            success: function() {
                $('#cv_path').val('');
                currentPath = null;
                $('#cvPreview').html('');
                myDropzone.removeAllFiles(true);
            }
        });

    });

    // VALIDATION
    $('#pegawaiForm').validate({
        rules: {
            name: { required: true },
            position_id: { required: true },
            office_id: { required: true },
            tanggal_lahir: { required: true }
        },
        messages: {
            name: "Nama wajib diisi",
            position_id: "Position wajib dipilih",
            office_id: "Office wajib dipilih",
            tanggal_lahir: "Tanggal lahir wajib diisi"
        },
        errorClass: 'text-danger mt-1',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

});
</script>
@endsection