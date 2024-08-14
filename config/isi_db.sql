INSERT INTO sekolah (id, nama, alamat, logo) VALUES
(1, 'SMP Negeri 1', 'Jl. Pendidikan No. 123, Kota A', 'logo_smpn1.png');
INSERT INTO admin (id, nama, username, password) VALUES
(1, 'Admin Sekolah', 'admin', 'password123');
INSERT INTO guru (id, username, password, nip, sekolah, nama_guru, jenis_kelamin, tempat_lahir, tanggal_lahir, nik, pengawas_bidang_studi, alamat, hp, foto) VALUES
(1, 'guru1', 'pass123', '198501012010011001', 1, 'Budi Santoso', 'Laki-laki', 'Jakarta', '1985-01-01', '3171234567890001', 'Matematika', 'Jl. Guru No. 45, Kota A', '081234567890', 'foto_budi.jpg');
INSERT INTO kelas (id, kd_kelas, tingkat, nama_kelas) VALUES
(1, 'K1A', '1', '1.A'),
(2, 'K2A', '2', '2.A'),
(3, 'K3A', '3', '3.A');
INSERT INTO siswa (id, username, password, nama, jenis_kelamin, nisn, tempat_lahir, tanggal_lahir, alamat, hp, email, foto, nama_wali, tahun_lahir_wali, pendidikan_wali, pekerjaan_wali, penghasilan_wali, angkatan, spp_nominal) VALUES
(1, 'siswa1', 'pass1', 'Ana', 'Perempuan', '0001', 'Jakarta', '2010-05-15', 'Jl. A No. 1', '08111111111', 'ana@email.com', 'ana.jpg', 'Wali Ana', 1980, 'S1', 'Karyawan', '5000000', 2023, '500000'),
(2, 'siswa2', 'pass2', 'Budi', 'Laki-laki', '0002', 'Bandung', '2010-06-20', 'Jl. B No. 2', '08222222222', 'budi@email.com', 'budi.jpg', 'Wali Budi', 1975, 'SMA', 'Wiraswasta', '4000000', 2023, '500000'),
(3, 'siswa3', 'pass3', 'Citra', 'Perempuan', '0003', 'Surabaya', '2010-07-25', 'Jl. C No. 3', '08333333333', 'citra@email.com', 'citra.jpg', 'Wali Citra', 1982, 'S2', 'Dosen', '7000000', 2023, '500000'),
(4, 'siswa4', 'pass4', 'Doni', 'Laki-laki', '0004', 'Medan', '2010-08-30', 'Jl. D No. 4', '08444444444', 'doni@email.com', 'doni.jpg', 'Wali Doni', 1978, 'D3', 'Teknisi', '4500000', 2023, '500000'),
(5, 'siswa5', 'pass5', 'Eka', 'Perempuan', '0005', 'Semarang', '2010-09-05', 'Jl. E No. 5', '08555555555', 'eka@email.com', 'eka.jpg', 'Wali Eka', 1985, 'S1', 'Guru', '5500000', 2023, '500000'),
(6, 'siswa6', 'pass6', 'Fandi', 'Laki-laki', '0006', 'Jakarta', '2009-04-10', 'Jl. F No. 6', '08666666666', 'fandi@email.com', 'fandi.jpg', 'Wali Fandi', 1979, 'SMA', 'Wiraswasta', '4200000', 2022, '500000'),
(7, 'siswa7', 'pass7', 'Gita', 'Perempuan', '0007', 'Bandung', '2009-05-15', 'Jl. G No. 7', '08777777777', 'gita@email.com', 'gita.jpg', 'Wali Gita', 1983, 'S1', 'Karyawan', '5500000', 2022, '500000'),
(8, 'siswa8', 'pass8', 'Hadi', 'Laki-laki', '0008', 'Surabaya', '2009-06-20', 'Jl. H No. 8', '08888888888', 'hadi@email.com', 'hadi.jpg', 'Wali Hadi', 1976, 'D3', 'Teknisi', '4800000', 2022, '500000'),
(9, 'siswa9', 'pass9', 'Indah', 'Perempuan', '0009', 'Medan', '2009-07-25', 'Jl. I No. 9', '08999999999', 'indah@email.com', 'indah.jpg', 'Wali Indah', 1981, 'S2', 'Dosen', '7500000', 2022, '500000'),
(10, 'siswa10', 'pass10', 'Joko', 'Laki-laki', '0010', 'Semarang', '2009-08-30', 'Jl. J No. 10', '08000000000', 'joko@email.com', 'joko.jpg', 'Wali Joko', 1977, 'S1', 'PNS', '6000000', 2022, '500000'),
(11, 'siswa11', 'pass11', 'Kartika', 'Perempuan', '0011', 'Jakarta', '2008-03-05', 'Jl. K No. 11', '08111222333', 'kartika@email.com', 'kartika.jpg', 'Wali Kartika', 1980, 'S1', 'Karyawan', '5800000', 2021, '500000'),
(12, 'siswa12', 'pass12', 'Lukman', 'Laki-laki', '0012', 'Bandung', '2008-04-10', 'Jl. L No. 12', '08222333444', 'lukman@email.com', 'lukman.jpg', 'Wali Lukman', 1975, 'SMA', 'Wiraswasta', '4500000', 2021, '500000'),
(13, 'siswa13', 'pass13', 'Mira', 'Perempuan', '0013', 'Surabaya', '2008-05-15', 'Jl. M No. 13', '08333444555', 'mira@email.com', 'mira.jpg', 'Wali Mira', 1982, 'S2', 'Dokter', '10000000', 2021, '500000'),
(14, 'siswa14', 'pass14', 'Nino', 'Laki-laki', '0014', 'Medan', '2008-06-20', 'Jl. N No. 14', '08444555666', 'nino@email.com', 'nino.jpg', 'Wali Nino', 1978, 'D3', 'Teknisi', '5000000', 2021, '500000'),
(15, 'siswa15', 'pass15', 'Olivia', 'Perempuan', '0015', 'Semarang', '2008-07-25', 'Jl. O No. 15', '08555666777', 'olivia@email.com', 'olivia.jpg', 'Wali Olivia', 1985, 'S1', 'Guru', '6000000', 2021, '500000');
INSERT INTO anggota_kelas (id, id_kelas, id_siswa, tahun_akademik, status_anggota) VALUES
(1, '1', '1', '2023/2024', 'Aktif'),
(2, '1', '2', '2023/2024', 'Aktif'),
(3, '1', '3', '2023/2024', 'Aktif'),
(4, '1', '4', '2023/2024', 'Aktif'),
(5, '1', '5', '2023/2024', 'Aktif'),
(6, '2', '6', '2023/2024', 'Aktif'),
(7, '2', '7', '2023/2024', 'Aktif'),
(8, '2', '8', '2023/2024', 'Aktif'),
(9, '2', '9', '2023/2024', 'Aktif'),
(10, '2', '10', '2023/2024', 'Aktif'),
(11, '3', '11', '2023/2024', 'Aktif'),
(12, '3', '12', '2023/2024', 'Aktif'),
(13, '3', '13', '2023/2024', 'Aktif'),
(14, '3', '14', '2023/2024', 'Aktif'),
(15, '3', '15', '2023/2024', 'Aktif');
INSERT INTO jurnal (id, id_kelas, hari, id_guru, jam_ke, mapel) VALUES
(1, 1, 1, 1, 1, 'Matematika');
INSERT INTO genre_buku (id, genre) VALUES
(1, 'Fiksi'),
(2, 'Non-Fiksi'),
(3, 'Sains'),
(4, 'Sejarah'),
(5, 'Teknologi');
INSERT INTO buku (id, judul, pengarang, id_genre, tentang_buku, status) VALUES
(1, 'Laskar Pelangi', 'Andrea Hirata', '1', 'Novel tentang perjuangan anak-anak di Belitung', 'Tersedia'),
(2, 'Bumi Manusia', 'Pramoedya Ananta Toer', '1', 'Novel sejarah Indonesia', 'Tersedia'),
(3, 'Sapiens', 'Yuval Noah Harari', '2', 'Sejarah singkat umat manusia', 'Tersedia'),
(4, 'A Brief History of Time', 'Stephen Hawking', '3', 'Buku tentang kosmologi', 'Tersedia'),
(5, 'The Innovators', 'Walter Isaacson', '5', 'Sejarah revolusi digital', 'Tersedia');