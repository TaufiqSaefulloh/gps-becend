<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Ulp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImport implements ToModel, WithHeadingRow, WithChunkReading
{
    // Ambil semua ULP di awal untuk mencegah query per row
    protected static $ulps = null;

    public function __construct()
    {
        if (self::$ulps === null) {
            self::$ulps = Ulp::all(); // ambil semua ULP
        }
    }

    public function model(array $row)
    {
        // Debug sementara (bisa dihapus setelah yakin)
        // dd($row);

        $lokasi = strtolower(trim($row['lokasi'] ?? ''));
        $nama   = trim($row['nama'] ?? '');
        $nip    = trim($row['nip'] ?? '');
        $email  = trim($row['email_aktif'] ?? '');

        // Anggap "-" atau "" pada NIP sebagai kosong
        if ($nip === '-' || $nip === '') {
            $nip = null;
        }
        // Skip row kosong
        // Validasi kolom wajib
        if (empty($lokasi) || empty($nama) || empty($nip) || empty($email)) {
            Log::warning("Row dilewati karena ada data kosong: " . json_encode($row));
            return null; // skip baris ini
        }

        // Matching ULP fleksibel
        $ulp = collect(self::$ulps)->first(function ($item) use ($lokasi) {
            return stripos(strtolower($item->nama_ulp), $lokasi) !== false;
        });

        if (!$ulp) {
            Log::warning("ULP tidak ditemukan untuk lokasi Excel: {$lokasi}");
            return null; // skip jika ULP tidak ada
        }

        Log::info("Insert/update user: {$nama} | {$email} | ULP: {$ulp->nama_ulp}");

        // Insert atau update user berdasarkan email
        return User::updateOrCreate(
            ['email' => $email],
            [
                'nip'      => $nip,
                'name'     => $nama,
                'password' => Hash::make($nip), // default password = NIP
                'id_ulp'   => $ulp->id,
                'role'     => 'user',
            ]
        );
    }

    // Baca Excel per 100 row (chunking)
    public function chunkSize(): int
    {
        return 100;
    }
}
