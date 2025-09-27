@extends('layout.master')

@section('page-content')

<div class="card shadow-sm">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-semibold">Master Data User</h5>

        <div class="d-flex align-items-center">
            <!-- Search Bar -->
            <form action="{{ route('admin.cluster.index') }}" method="GET" class="d-flex me-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control form-control-sm me-2"
                    placeholder="Cari nama cluster...">
                <button type="submit" class="btn btn-sm btn-outline-primary">🔍</button>
            </form>


            <!-- Tambah User -->
            <a href="{{ route('admin.cluster.create') }}" class="btn btn-primary btn-sm">➕ Tambah User</a>
        </div>
    </div>

    <table class="table table-hover mb-0 text-center">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Cluster</th>
                <th>Jumlah UID</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $row->nama_cluster }}</td>
                <td>
                    <span class="badge bg-info">{{ $row->uids->count() }}</span>
                    UID
                </td>
                <!-- <td>{{ $row->created_at ? $row->created_at->format('d-m-Y H:i') : '-' }}</td>
                                <td>{{ $row->updated_at ? $row->updated_at->format('d-m-Y H:i') : '-' }}</td> -->
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal" onclick='showDetail({{ json_encode([
                                        "no" => $i+1,
                                        "nama_cluster" => $row->nama_cluster,
                                        "jumlah_uid" => $row->uids->count(),
                                        "created_at" => $row->created_at ? $row->created_at->format('d-m-Y H:i') : '-',
                                        "updated_at" => $row->updated_at ? $row->updated_at->format('d-m-Y H:i') : '-',
                                        "uid_list" => $row->uids->map(function($uid) {
                                            return [
                                                'id' => $uid->id,
                                                'nama_uid' => $uid->nama_uid,
                                                'created_at' => $uid->created_at ? $uid->created_at->format('d-m-Y H:i') : '-'
                                            ];
                                        })->toArray()
                                    ]) }})'>
                        <i class="mdi mdi-eye"></i> View
                    </button>

                    <a href="{{ route('admin.cluster.edit', $row->id) }}" class="btn btn-sm btn-warning" title="Edit">
                        <i class="mdi mdi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('admin.cluster.destroy', $row->id) }}" method="POST" class="form-delete" style="display:inline-block;">
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
<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Cluster</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="detail-content">
                    Memuat data...
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function showDetail(data) {
        let html = `<table class='table table-bordered'>`;
        html += `<tr><th>No</th><td>${data.no}</td></tr>`;
        html += `<tr><th>Nama Cluster</th><td>${data.nama_cluster}</td></tr>`;
        html += `<tr><th>Jumlah UID</th><td><span class="badge bg-info">${data.jumlah_uid}</span> UID</td></tr>`;
        html += `<tr><th>Dibuat</th><td>${data.created_at}</td></tr>`;
        html += `<tr><th>Diperbarui</th><td>${data.updated_at}</td></tr>`;

        if (data.uid_list && data.uid_list.length > 0) {
            html += `<tr><th>Daftar UID</th><td>`;
            html += `<div class="table-responsive"><table class="table table-sm table-bordered">`;
            html += `<thead><tr><th>ID</th><th>Nama UID</th><th>Dibuat</th></tr></thead><tbody>`;
            data.uid_list.forEach(function(uid) {
                html += `<tr>`;
                html += `<td><span class="badge bg-primary">${uid.id}</span></td>`;
                html += `<td>${uid.nama_uid}</td>`;
                html += `<td>${uid.created_at}</td>`;
                html += `</tr>`;
            });
            html += `</tbody></table></div>`;
            html += `</td></tr>`;
        } else {
            html += `<tr><th>Daftar UID</th><td><span class="text-muted">Belum ada UID yang menggunakan cluster ini</span></td></tr>`;
        }

        html += `</table>`;
        document.getElementById('detail-content').innerHTML = html;
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