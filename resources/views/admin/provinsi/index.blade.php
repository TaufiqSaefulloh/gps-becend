@extends('layout.master')

@section('page-content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Master Data Provinsi</h5>

        <div class="d-flex align-items-center">
            <!-- Search Bar -->
            <form action="{{ route('admin.provinsi.index') }}" method="GET" class="d-flex me-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control form-control-sm me-2"
                    placeholder="Cari nama provinsi...">
                <button type="submit" class="btn btn-sm btn-outline-primary">🔍</button>
            </form>


            <!-- Tambah Provinsi -->
            <a href="{{ route('admin.provinsi.create') }}" class="btn btn-primary btn-sm">➕ Tambah Provinsi</a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0 text-center">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nama Provinsi</th>
                    <th>UID</th>
                    <th>Cluster</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data provinsi akan ditampilkan di sini -->
                @foreach($data as $i => $row)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $row->nama_provinsi }}</td>
                    <td>
                        @if($row->uid)
                        <span class="badge bg-info">{{ $row->uid->nama_uid }}</span>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($row->uid && $row->uid->cluster)
                        <span class="badge bg-primary">{{ $row->uid->cluster->nama_cluster }}</span>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    <!-- <td>{{ $row->created_at ? $row->created_at->format('d-m-Y H:i') : '-' }}</td>
                                <td>{{ $row->updated_at ? $row->updated_at->format('d-m-Y H:i') : '-' }}</td> -->
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal" onclick='showDetail({{ json_encode([
                                        "no" => $i+1,
                                        "nama_provinsi" => $row->nama_provinsi,
                                        "uid" => $row->uid->nama_uid,
                                        "cluster" => $row->uid->cluster->nama_cluster,
                                        "created_at" => $row->created_at ? $row->created_at->format('d-m-Y H:i') : '-',
                                        "updated_at" => $row->updated_at ? $row->updated_at->format('d-m-Y H:i') : '-'
                                    ]) }})'>
                            <i class="mdi mdi-eye"></i> View
                        </button>
                        <a href="{{ route('admin.provinsi.edit', $row->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="mdi mdi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.provinsi.destroy', $row->id) }}" method="POST" class="form-delete d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-delete" title="Hapus">
                                <i class="mdi mdi-trash-can"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Data Provinsi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalDetailBody">
                <!-- Konten detail akan diisi JS -->
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function showDetail(data) {
        let html = `<table class='table table-bordered'>`;
        html += `<tr><th>No</th><td>${data.no}</td></tr>`;
        html += `<tr><th>Nama Provinsi</th><td>${data.nama_provinsi}</td></tr>`;
        html += `<tr><th>UID</th><td><span class="badge bg-info">${data.uid}</span></td></tr>`;
        html += `<tr><th>Cluster</th><td><span class="badge bg-primary">${data.cluster}</span></td></tr>`;
        html += `<tr><th>Dibuat</th><td>${data.created_at}</td></tr>`;
        html += `<tr><th>Diperbarui</th><td>${data.updated_at}</td></tr>`;
        html += `</table>`;
        document.getElementById('modalDetailBody').innerHTML = html;
    }

    // SweetAlert2 konfirmasi hapus
    document.querySelectorAll('.form-delete').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>