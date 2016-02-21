<?php
    session_start();
    include("../koneksi.php");
    include("../fungsi.php");
    include("../model/usulan_hukuman_disiplin_model.php");
    
    function something_wrong($what_is_wrong){
        echo("
            <script type='text/javascript'>
                window.parent.window.something_wrong(\"" . $what_is_wrong . "\");
            </script>
        ");
    }
    function success(){
        echo("
            <script type='text/javascript'>
                window.parent.window.success();
            </script>
        ");
    }
    $id_pegawai = detail_pegawai_by_nip($_POST["nip"], "id_pegawai");
    $tmt = $_POST["tmt"];
    $id_jenis_disiplin = 1;
    $id_sub_jenis_disiplin = $_POST["id_sub_jenis_disiplin"];
    $keterangan = $_POST["keterangan"];
    $jabatan_pejabat_sk = $_POST["jabatan_pejabat_sk"];
    $nama_pejabat_sk = $_POST["nama_pejabat_sk"];
    $nip_pejabat_sk = $_POST["nip_pejabat_sk"];
    $pangkat_pejabat_sk = $_POST["pangkat_pejabat_sk"];
    $tgl_sk = $_POST["tgl_sk"];
    $no_sk = $_POST["no_sk"];
    $membaca = $_POST["membaca"];
    $menimbang = $_POST["menimbang"];
    $mengingat = $_POST["mengingat"];
    $menetapkan = $_POST["menetapkan"];
    $tembusan = $_POST["tembusan"];
    $status = 1;
    $pemisah_hukuman = 1;
    
    if($id_pegawai == 0){
        something_wrong("Maaf, pegawai tidak ditemukan. Pilih pegawai dahulu");
    }else if($keterangan=="" || $id_sub_jenis_disiplin==0 || $jabatan_pejabat_sk=="" || $nama_pejabat_sk=="" || $nip_pejabat_sk==""){
        something_wrong("Maaf, input anda masih belum lengkap");
    }else{
        //echo($_POST["mengingat"] . "<br />");
        $obj = new UsulanHukumanDisiplin();
        $obj->id_pegawai = $id_pegawai;
        $obj->tmt = $tmt;
        $obj->id_jenis_disiplin = $id_jenis_disiplin;
        $obj->id_sub_jenis_disiplin = $id_sub_jenis_disiplin;
        $obj->keterangan = $keterangan;
        $obj->jabatan_pejabat_sk = $jabatan_pejabat_sk;
        $obj->nama_pejabat_sk = $nama_pejabat_sk;
        $obj->nip_pejabat_sk = $nip_pejabat_sk;
        $obj->pangkat_pejabat_sk = $pangkat_pejabat_sk;
        $obj->tgl_sk = $tgl_sk;
        $obj->no_sk = $no_sk;
        $obj->membaca = $membaca;
        $obj->menimbang = $menimbang;
        $obj->mengingat = $mengingat;
        $obj->menetapkan = $menetapkan;
        $obj->tembusan = $tembusan;
        $obj->status = $status;
        $obj->pemisah_hukuman = $pemisah_hukuman;
        $obj->Insert();
        success();
    }
?>