<?php
    session_start();
    include("koneksi.php");
    $sql2 = "INSERT INTO tbl_pegawai VALUES(
                null,
                '$_POST[nip]', '$_POST[nama_pegawai]', null, '$_POST[id_status_kepegawaian]', '$_POST[id_jenis_kepegawaian]', '$_POST[id_kedudukan_kepegawaian]',
                '$_POST[id_instansi]', '$_POST[id_satuan_organisasi]', '$_POST[id_pangkat]', '$_POST[id_tipe_jabatan]', '$_POST[id_jabatan]', '$_POST[gelar_depan]', '$_POST[gelar_belakang]',
                '$_POST[id_golongan_darah]', '$_POST[id_jenis_kelamin]', '$_POST[tempat_lahir]', '$_POST[tanggal_lahir]', '$_POST[alamat]', '$_POST[rt]', '$_POST[rw]',
                '$_POST[marga]', '$_POST[id_suku]', '$_POST[id_agama]', '$_POST[id_provinsi]', '$_POST[id_kabupaten]', '$_POST[id_kecamatan]', '$_POST[id_kelurahan]',
                '$_POST[kode_pos]', '$_POST[no_telp]', '$_POST[no_hp]', '$_POST[nama_ayah]', '$_POST[nama_ibu]', '$_POST[id_status_pernikahan]', '$_POST[npwp]',
                '$_POST[tinggi]', '$_POST[berat]', '$_POST[id_rambut]', '$_POST[id_bentuk_muka]', '$_POST[id_warna_kulit]', '$_POST[ciri_khas]', '$_POST[cacat_tubuh]',
                '$_POST[hobi]', '$_POST[id_status_kepegawaian]', 0, 0
            )";
    $sql = "UPDATE tbl_pegawai SET
                nip = '$_POST[nip]',
                nama_pegawai = '$_POST[nama_pegawai]',
                id_status_kepegawaian= '$_POST[id_status_kepegawaian]',
                id_jenis_kepegawaian= '$_POST[id_jenis_kepegawaian]',
                id_kedudukan_kepegawaian = '$_POST[id_kedudukan_kepegawaian]',
                id_instansi = '$_POST[id_instansi]',
                id_satuan_organisasi = '$_POST[id_satuan_organisasi]',
                id_pangkat = '$_POST[id_pangkat]',
                id_tipe_jabatan= '$_POST[id_tipe_jabatan]',
                id_jabatan= '$_POST[id_jabatan]',
                gelar_depan= '$_POST[gelar_depan]',
                gelar_belakang= '$_POST[gelar_belakang]',
                id_golongan_darah= '$_POST[id_golongan_darah]',
                id_jenis_kelamin= '$_POST[id_jenis_kelamin]',
                tempat_lahir= '$_POST[tempat_lahir]',
                tanggal_lahir = '$_POST[tanggal_lahir]',
                alamat = '$_POST[alamat]',
                rt = '$_POST[rt]',
                rw = '$_POST[rw]',
                marga = '$_POST[marga]', 
                id_suku = '$_POST[id_suku]', 
                id_agama = '$_POST[id_agama]', 
                id_provinsi = '$_POST[id_provinsi]', 
                id_kabupaten = '$_POST[id_kabupaten]', 
                id_kecamatan = '$_POST[id_kecamatan]', 
                id_kelurahan= '$_POST[id_kelurahan]',
                kode_pos = '$_POST[kode_pos]', 
                no_telp = '$_POST[no_telp]', 
                no_hp = '$_POST[no_hp]', 
                nama_ayah = '$_POST[nama_ayah]', 
                nama_ibu = '$_POST[nama_ibu]', 
                id_status_pernikahan = '$_POST[id_status_pernikahan]', 
                npwp = '$_POST[npwp]',
                tinggi = '$_POST[tinggi]', 
                berat = '$_POST[berat]', 
                id_rambut = '$_POST[id_rambut]', 
                id_bentuk_muka = '$_POST[id_bentuk_muka]', 
                id_warna_kulit = '$_POST[id_warna_kulit]', 
                ciri_khas = '$_POST[ciri_khas]', 
                cacat_tubuh = '$_POST[cacat_tubuh]',
                hobi = '$_POST[hobi]', 
                id_status_kepegawaian = '$_POST[id_status_kepegawaian]'
            WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'";
    //echo($sql);
    mysql_query($sql);
    
    // EDIT JUGA USERNAME DAN NAMA PADA AKUN NYA
    mysql_query("UPDATE tbl_pengguna SET nama='$_POST[nama_pegawai]', username=REPLACE('$_POST[nip]',' ','') WHERE id_pegawai='" . $_SESSION["simpeg_id_pegawai"] . "'");
    header("location:../?mod=info&pesan=2&redir=data_pegawai");
?>