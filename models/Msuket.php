<?php

class Msuket extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function simpansuket_isolasi($no_pasien, $no_reg, $jenis)
    {
        $id = $this->getnosurat_keterangan();
        $q = $this->ceksuket($no_reg);
        if ($q) {
            return $q->id;
        } else {
            $data = array(
                'no_pasien' => $no_pasien,
                'no_reg'    => $no_reg,
                'bulan'     => date('m'),
                'tahun'     => date('Y'),
                'id'        => $id,
                'jenis'     => $jenis,
            );
            $this->db->insert("surat_keterangan", $data);
            return $id;
        }
    }
    function getpasien_detail($no_pasien)
    {
        $this->db->where("no_pasien", $no_pasien);
        return $this->db->get("pasien")->row();
    }
    function getpasien_inap($no_reg)
    {
        $this->db->select("pi.*,nama_dokter,nama_kelompok,d.nip,d.no_sip,kd.jenis_kelompok");
        $this->db->join("dokter d", "pi.dpjp=d.id_dokter");
        $this->db->join("kelompok_dokter kd", "kd.id_kelompok=d.kelompok_dokter");
        $this->db->where("no_reg", $no_reg);
        $q = $this->db->get("pasien_inap pi");
        return $q->row();
    }
    function getpasien_ralan($no_reg)
    {
        $this->db->select("pi.*,nama_dokter,nama_kelompok,d.nip,d.no_sip,kd.jenis_kelompok,tanggal as tgl_masuk, date(tanggal) as tgl_keluar");
        $this->db->join("dokter d", "pi.dokter_poli=d.id_dokter");
        $this->db->join("kelompok_dokter kd", "kd.id_kelompok=d.kelompok_dokter");
        $this->db->where("no_reg", $no_reg);
        $q = $this->db->get("pasien_ralan pi");
        return $q->row();
    }
    function ceksuket($no_reg)
    {
        $this->db->where("no_reg", $no_reg);
        $q = $this->db->get("surat_keterangan");
        return $q->row();
    }
    function ceksuket_bebascovid($no_reg)
    {
        $this->db->where("no_reg", $no_reg);
        $q = $this->db->get("suket_bebascovid");
        return $q->row();
    }
    function simpansuket_bebascovid($no_pasien, $no_reg, $jenis)
    {
        $id = $this->getnosurat_bebascovid();
        $q = $this->ceksuket_bebascovid($no_reg);
        if ($q) {
            return $q->id;
        } else {
            $data = array(
                'no_pasien' => $no_pasien,
                'no_reg'    => $no_reg,
                'bulan'     => date('m'),
                'tahun'     => date('Y'),
                'id'        => $id,
                'jenis'     => $jenis,
            );
            $this->db->insert("suket_bebascovid", $data);
            return $id;
        }
    }
    function getsuket_detail($id, $table)
    {
        $this->db->where("id", $id);
        $q = $this->db->get($table);
        return $q->row();
    }
    function getsuket_covid($no_reg, $no_pasien, $table)
    {
        $this->db->where("no_reg", $no_reg);
        $this->db->where("no_pasien", $no_pasien);
        $q = $this->db->get($table);
        return $q->row();
    }
    function getsuket_narkoba($no_reg, $no_pasien, $table)
    {
        $this->db->where("no_reg", $no_reg);
        $this->db->where("no_pasien", $no_pasien);
        $q = $this->db->get($table);
        return $q->row();
    }
    function getalamat_rs()
    {
        $this->db->where("kode_rs", "3274020");
        $q = $this->db->get("setup_rs");
        return $q->row();
    }
    function getnosurat_keterangan()
    {
        $this->db->where("jenis_surat", "SK");
        $this->db->where("tahun", date("Y"));
        $q1 = $this->db->get("setup_nomor");
        $row = $q1->row();

        for ($i = $row->mulai_nomor; $i <= 999; $i++) {
            $n = substr("000" . $i, -3);
            $where = array(
                "tahun"         => date("Y"),
                "id"            => $n,
            );
            $q = $this->db->get_where("surat_keterangan", $where);
            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function getnosurat_bebascovid()
    {
        $this->db->where("jenis_surat", "SB");
        $this->db->where("tahun", date("Y"));
        $q1 = $this->db->get("setup_nomor");
        $row = $q1->row();

        for ($i = $row->mulai_nomor; $i <= 999999; $i++) {
            $n = substr("000000" . $i, -6);
            $where = array(
                "tahun"         => date("Y"),
                "id"            => $n,
            );
            $q = $this->db->get_where("suket_bebascovid", $where);
            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function getswab($jenis, $no_reg)
    {
        if ($jenis == "ranap") {
            $this->db->select("p2.no_reg,p2.no_rm,p1.nama_pasien,p2.tgl_masuk");
            $this->db->join("pasien p1", "p1.no_pasien=p2.no_rm", "inner");
            $this->db->where("isnull(tgl_keluar)", 0);
            $this->db->where("p2.no_reg", $no_reg);
            $this->db->order_by("p2.no_reg");
            $p = $this->db->get("pasien_inap p2");
            $data = array();
            $data["pasien"] = $p->result();
            foreach ($p->result() as $row) {
                $this->db->select("e.*,t.nama_tindakan");
                $this->db->order_by("e.tanggal");
                $this->db->where("e.no_reg", $row->no_reg);
                $this->db->group_start();
                $this->db->where("e.kode_tindakan", "L121");
                $this->db->or_where("e.kode_tindakan", "L151");
                $this->db->or_where("e.kode_tindakan", "L157");
                $this->db->or_where("e.kode_tindakan", "L158");
                $this->db->or_where("e.kode_tindakan", "L160");
                $this->db->group_end();
                $this->db->group_by("e.no_reg,e.kode_tindakan,e.tanggal");
                $this->db->join("tarif_lab t", "t.kode_tindakan=e.kode_tindakan", "inner");
                $g = $this->db->get("ekspertisi_labinap e");
                foreach ($g->result() as $rw) {
                    $data["list"][$rw->kode_tindakan][] = $rw;
                    $data["terakhir"] = $rw;
                }
            }
        } else {
            $this->db->select("p2.no_reg,p2.no_pasien as no_rm,p1.nama_pasien,date(p2.tanggal) as tgl_masuk");
            $this->db->join("pasien p1", "p1.no_pasien=p2.no_pasien", "inner");
            $this->db->where("p2.no_reg", $no_reg);
            $this->db->order_by("p2.no_reg");
            $p = $this->db->get("pasien_ralan p2");
            $data = array();
            $data["pasien"] = $p->result();
            foreach ($p->result() as $row) {
                $this->db->select("e.*,t.nama_tindakan");
                $this->db->order_by("e.no_reg");
                $this->db->where("e.no_reg", $row->no_reg);
                $this->db->group_start();
                $this->db->where("e.kode_tindakan", "L121");
                $this->db->or_where("e.kode_tindakan", "L151");
                $this->db->or_where("e.kode_tindakan", "L157");
                $this->db->or_where("e.kode_tindakan", "L158");
                $this->db->or_where("e.kode_tindakan", "L160");
                $this->db->group_end();
                $this->db->join("tarif_lab t", "t.kode_tindakan=e.kode_tindakan", "inner");
                $g = $this->db->get("ekspertisi_lab e");
                foreach ($g->result() as $rw) {
                    $data["list"][$rw->kode_tindakan][] = $rw;
                    $data["terakhir"] = $rw;
                }
            }
        }
        return $data;
    }
    function getnarkoba_test($jenis, $no_reg)
    {
        $data = array();
        if ($jenis == "ranap") {
            $this->db->select("e.*,n.nama as nama_tindakan");
            $this->db->order_by("e.no_reg");
            $this->db->where("e.no_reg", $no_reg);
            $this->db->where("e.kode_tindakan", "L049");
            $this->db->join("lab_normal n", "n.kode_tindakan=e.kode_tindakan and n.kode=e.kode_labnormal", "inner");
            $g = $this->db->get("ekspertisi_labinap e");
            foreach ($g->result() as $rw) {
                $data[] = $rw;
            }
        } else {
            $no_reg_sebelumnya = $this->db->get_where("pasien_ralan",["no_reg_sebelumnya"=>$no_reg])->row()->no_reg;
            $this->db->select("e.*,n.nama as nama_tindakan");
            $this->db->order_by("e.no_reg");
            $this->db->where("e.no_reg", $no_reg);
            $this->db->or_where("e.no_reg", $no_reg_sebelumnya);
            $this->db->where("e.kode_tindakan", "L049");
            $this->db->join("lab_normal n", "n.kode_tindakan=e.kode_tindakan and n.kode=e.kode_labnormal", "inner");
            $g = $this->db->get("ekspertisi_lab e");
            foreach ($g->result() as $rw) {
                $data[] = $rw;
            }
        }
        return $data;
    }
    function simpanttdobat()
    {
        $q = $this->db->get_where("pasien_ttdobat", ["no_reg" => $this->input->post("no_reg"), "jenis" => $this->input->post("jenis")]);
        if ($q->num_rows() <= 0) {
            $data = array(
                "no_reg" => $this->input->post("no_reg"),
                "jenis" => $this->input->post("jenis"),
                'ttd'      => "data:image/png;base64," . $this->input->post("ttd"),
            );
            $this->db->insert("pasien_ttdobat", $data);
        }
    }
    function getpasien_kematian($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $data = array();
        // $this->db->select("s.*,p.berat_badan,p.nama_pasien,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,p.no_pasien as no_rm,i.tanggal_pulang as tgl_keluar,pl.keterangan as nama_ruangan");
        // if ($tgl1 != "" or $tgl2 != "") {
        //     $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
        //     $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
        // }
        // $this->db->join("pasien p", "p.no_pasien=s.no_pasien");
        // $this->db->join("pasien_ralan i", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        // $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "inner");
        // $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
        $this->db->order_by("s.nomor_surat,s.no_reg,s.no_pasien", "desc");
        $query = $this->db->get("surat_kematian s", $page, $offset);
        // $data["ralan"] = $query->result();
        foreach ($query->result() as $row) {
            if ($row->jenis == "ralan") {
                $this->db->select("p.berat_badan,p.nama_pasien,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,p.no_pasien as no_rm,i.tanggal_pulang as tgl_keluar,pl.keterangan as nama_ruangan");
                $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
                $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "inner");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_pasien", $row->no_pasien);
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
                }
                $q = $this->db->get("pasien_ralan i")->row();
            } else {
                $this->db->select("i.tgl_keluar,i.kode_kamar,i.no_bed,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
                $this->db->join("pasien p", "p.no_pasien=i.no_rm");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "inner");
                $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "inner");
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
                }
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_rm", $row->no_pasien);
                $q = $this->db->get("pasien_inap i")->row();
            }
            $data["master"][$row->nomor_surat] = $q;
            $data["surat"][$row->nomor_surat] = $row;
        }
        // $this->db->select("s.*,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
        // $this->db->group_start();
        // $this->db->like("i.no_rm", $no_pasien);
        // $this->db->or_like("i.no_reg", $no_pasien);
        // $this->db->or_like("no_bpjs", $no_pasien);
        // $this->db->or_like("no_sjp", $no_pasien);
        // $this->db->or_like("p.nama_pasien", $no_pasien);
        // $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        // $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        // $this->db->group_end();
        // if ($kode_kelas != "") {
        //     $this->db->where("i.kode_kelas", $kode_kelas);
        // }
        // if ($kode_ruangan != "") {
        //     $this->db->where("i.kode_ruangan", $kode_ruangan);
        // }
        // if ($tgl1 != "" or $tgl2 != "") {
        //     $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
        //     $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        // }
        // $this->db->join("pasien p", "p.no_pasien=s.no_pasien");
        // $this->db->join("pasien_inap i", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        // $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
        // $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "inner");
        // $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "inner");
        // $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        // $query = $this->db->get("surat_kematian s", $page, $offset);
        // // $data["ranap"] = $query->result();
        // foreach ($query->result() as $row) {
        //     $data[$row->nomor_surat] = $row;
        // }
        return $data;
    }
    function getmasukperawatan($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $data = array();
        $this->db->order_by("s.nomor_surat,s.no_reg,s.no_pasien", "desc");
        $query = $this->db->get("surat_masuk_perawatan s", $page, $offset);
        foreach ($query->result() as $row) {
            if ($row->jenis == "ralan") {
                $this->db->select("p.berat_badan,p.nama_pasien,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,p.no_pasien as no_rm,date(i.tanggal) as tgl_masuk,pl.keterangan as nama_ruangan");
                $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
                $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "inner");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_pasien", $row->no_pasien);
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
                }
                $q = $this->db->get("pasien_ralan i")->row();
            } else {
                $this->db->select("i.tgl_masuk,i.kode_kamar,i.no_bed,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
                $this->db->join("pasien p", "p.no_pasien=i.no_rm");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "inner");
                $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "inner");
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
                }
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_rm", $row->no_pasien);
                $q = $this->db->get("pasien_inap i")->row();
            }
            $data["master"][$row->nomor_surat] = $q;
            $data["surat"][$row->nomor_surat] = $row;
        }
        return $data;
    }
    function getmasukperawatan1($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $indeks = $this->session->userdata("indeks");
        $data = array();
        $this->db->select("i.*,s.*,p.berat_badan,p.nama_pasien,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,p.no_pasien as no_rm,i.tanggal_pulang as tgl_keluar,pl.keterangan as nama_ruangan");
        $this->db->group_start();
        $this->db->like("i.no_pasien", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("s.nomor_surat", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "left");
        $this->db->join("surat_masuk_perawatan s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i", $page, $offset);
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("s.nomor_surat", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_masuk_perawatan s", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i", $page, $offset);
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function jumlah_kematian()
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $jml = 0;
        if ($no_pasien != "") {
            $this->db->group_start();
            $this->db->like("s.no_pasien", $no_pasien);
            $this->db->or_like("s.no_reg", $no_pasien);
            // $this->db->or_like("no_bpjs", $no_pasien);
            // $this->db->or_like("no_sjp", $no_pasien);
            // $this->db->or_like("p.nama_pasien", $no_pasien);
            // $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
            // $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
            $this->db->group_end();
        }
        // if ($tgl1 != "" or $tgl2 != "") {
        //     $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
        //     $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
        // }
        // $this->db->join("pasien p", "p.no_pasien=s.no_pasien");
        // $this->db->join("pasien_ralan i", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        // $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $query = $this->db->get("surat_kematian s");
        $jml += $query->num_rows();
        // $this->db->group_start();
        // $this->db->like("i.no_rm", $no_pasien);
        // $this->db->or_like("i.no_reg", $no_pasien);
        // $this->db->or_like("no_bpjs", $no_pasien);
        // $this->db->or_like("no_sjp", $no_pasien);
        // $this->db->or_like("p.nama_pasien", $no_pasien);
        // $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        // $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        // $this->db->group_end();
        // if ($kode_kelas != "") {
        //     $this->db->where("i.kode_kelas", $kode_kelas);
        // }
        // if ($kode_ruangan != "") {
        //     $this->db->where("i.kode_ruangan", $kode_ruangan);
        // }
        // if ($tgl1 != "" or $tgl2 != "") {
        //     $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
        //     $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        // }
        // $this->db->join("pasien_inap i", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        // $this->db->join("pasien p", "p.no_pasien=s.no_pasien");
        // $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        // $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        // $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        // $query = $this->db->get("surat_kematian s");
        // $jml += $query->num_rows();
        return $jml;
    }
    function getpasien_kelahiran($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $indeks = $this->session->userdata("indeks");
        $this->db->select("i.*,s.*,p.tgl_lahir,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien_inap i", "i.no_reg=s.no_reg", "inner");
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->order_by("i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("surat_kelahiran s", $page, $offset);
        return $query;
    }
    function jumlah_kelahiran()
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        }
        $this->db->order_by("i.no_reg", "desc");
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("surat_kelahiran s", "s.no_reg=i.no_reg", "inner");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->order_by("i.no_reg,i.no_rm");
        $query = $this->db->get("pasien_inap i");
        return $query->num_rows();
    }
    function cetaklistkematian($tgl1, $tgl2)
    {
        $data = array();
        $this->db->select("i.*,s.*,p.berat_badan,p.nama_pasien,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,p.no_pasien as no_rm,i.tanggal_pulang as tgl_keluar,pl.keterangan as nama_ruangan");
        $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "left");
        $this->db->join("surat_kematian s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.tgl_lahir,p.jenis_kelamin,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
        $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_kematian s", "s.no_reg=i.no_reg", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->order_by("i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function cetaklistkematianbpjs($tgl1, $tgl2)
    {
        $data = array();
        $this->db->select("i.*,s.*,p.berat_badan,p.nama_pasien,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,p.no_pasien as no_rm,i.tanggal_pulang as tgl_keluar,pl.keterangan as nama_ruangan,rp.a as diagnosa_akhir");
        $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->group_start();
        $this->db->where("i.no_sjp!=", "");
        $this->db->where("i.no_sjp!=", "-");
        $this->db->where("i.no_sjp!=", ".");
        $this->db->group_end();
        $this->db->group_start();
        $this->db->where("i.gol_pasien!=", 11);
        $this->db->or_where("i.gol_pasien!=", 12);
        $this->db->or_where("i.gol_pasien!=", 13);
        $this->db->or_where("i.gol_pasien!=", 16);
        $this->db->or_where("i.gol_pasien!=", 17);
        $this->db->or_where("i.gol_pasien!=", 18);
        $this->db->or_where("i.gol_pasien!=", 3133);
        $this->db->or_where("i.gol_pasien!=", 3134);
        $this->db->group_end();
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("pasien_igd rp", "rp.no_reg=i.no_reg and rp.no_rm=p.no_pasien", "left");
        $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "left");
        $this->db->join("surat_kematian s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.tgl_lahir,p.jenis_kelamin,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,rp.diagnosa_akhir");
        $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->where("i.no_sjp!=", "");
        $this->db->where("i.no_sjp!=", "-");
        $this->db->where("i.no_sjp!=", ".");
        $this->db->group_start();
        $this->db->where("i.id_gol!=", 11);
        $this->db->or_where("i.id_gol!=", 12);
        $this->db->or_where("i.id_gol!=", 13);
        $this->db->or_where("i.id_gol!=", 16);
        $this->db->or_where("i.id_gol!=", 17);
        $this->db->or_where("i.id_gol!=", 18);
        $this->db->or_where("i.id_gol!=", 3133);
        $this->db->or_where("i.id_gol!=", 3134);
        $this->db->group_end();
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_kematian s", "s.no_reg=i.no_reg", "inner");
        $this->db->join("resume_pulang rp", "rp.no_reg=i.no_reg", "left");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->order_by("i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function cetaklistkelahiran($tgl1, $tgl2)
    {
        $this->db->select("i.*,s.*,p.tgl_lahir,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
        $this->db->where("p.tgl_lahir>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("p.tgl_lahir<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_kelahiran s", "s.no_reg=i.no_reg", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->order_by("i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        return $query;
    }
    function cetaklistberitamasukperawatan($tgl1, $tgl2)
    {
        $this->db->select("i.*,s.*,d.nama_dokter,p.nip,p.tgl_lahir,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien, pk.keterangan as pangkat, ks.keterangan as kesatuan");
        $this->db->where("i.tgl_masuk>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("i.tgl_masuk<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_masuk_perawatan s", "s.no_reg=i.no_reg and s no_rm=i.no_rm", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->join("pangkat pk", "pk.id_pangkat=p.id_pangkat and pk.id_kesatuan=p.id_kesatuan and pk.id_gol=p.id_gol", "left");
        $this->db->join("kesatuan ks", "ks.id_kesatuan=pk.id_kesatuan", "left");
        $this->db->join("dokter d", "d.id_dokter=i.dokter", "left");
        $this->db->order_by("i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        return $query;
    }
    function getberitamasukperawatan($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $indeks = $this->session->userdata("indeks");
        $this->db->select("i.*,s.*,p.tgl_lahir,p.berat_badan,p.nama_pasien,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,pg.keterangan as pangkat,k.keterangan as kesatuan");
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_masuk_perawatan s", "s.no_reg=i.no_reg", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("pangkat pg", "pg.id_pangkat=p.id_pangkat and pg.id_kesatuan=p.id_kesatuan", "left");
        $this->db->join("kesatuan k", "k.id_kesatuan=pg.id_kesatuan", "left");
        $this->db->join("dokter d", "d.id_dokter=i.dpjp", "left");
        $this->db->order_by("i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i", $page, $offset);
        return $query;
    }
    function jumlah_beritamasukperawatan()
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $jml = 0;
        if ($no_pasien != "") {
            $this->db->group_start();
            $this->db->like("i.no_pasien", $no_pasien);
            $this->db->or_like("i.no_reg", $no_pasien);
            $this->db->or_like("no_bpjs", $no_pasien);
            $this->db->or_like("no_sjp", $no_pasien);
            $this->db->or_like("p.nama_pasien", $no_pasien);
            $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
            $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
            $this->db->group_end();
        }
        $query = $this->db->get("surat_masuk_perawatan s");
        $jml += $query->num_rows();
        return $jml;
    }
    function getberitalepasperawatan($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $data = array();
        $this->db->order_by("s.nomor_surat,s.no_reg,s.no_pasien", "desc");
        $query = $this->db->get("surat_lepas_perawatan s", $page, $offset);
        foreach ($query->result() as $row) {
            if ($row->jenis == "ralan") {
                $this->db->select("p.berat_badan,p.nama_pasien,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,p.no_pasien as no_rm,date(i.tanggal) as tgl_masuk,pl.keterangan as nama_ruangan");
                $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
                $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "inner");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_pasien", $row->no_pasien);
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
                }
                $q = $this->db->get("pasien_ralan i")->row();
            } else {
                $this->db->select("i.tgl_masuk,i.kode_kamar,i.no_bed,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
                $this->db->join("pasien p", "p.no_pasien=i.no_rm");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "inner");
                $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "inner");
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
                }
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_rm", $row->no_pasien);
                $q = $this->db->get("pasien_inap i")->row();
            }
            $data["master"][$row->nomor_surat] = $q;
            $data["surat"][$row->nomor_surat] = $row;
        }
        return $data;
    }
    function jumlah_beritalepasperawatan()
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $jml = 0;
        if ($no_pasien != "") {
            $this->db->group_start();
            $this->db->like("i.no_pasien", $no_pasien);
            $this->db->or_like("i.no_reg", $no_pasien);
            $this->db->or_like("no_bpjs", $no_pasien);
            $this->db->or_like("no_sjp", $no_pasien);
            $this->db->or_like("p.nama_pasien", $no_pasien);
            $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
            $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
            $this->db->group_end();
        }
        $query = $this->db->get("surat_lepas_perawatan s");
        $jml += $query->num_rows();
        return $jml;
    }
    function cetaklistberitalepasperawatan($tgl1, $tgl2)
    {
        $this->db->select("i.*,s.*,d.nama_dokter,p.nip,p.tgl_lahir,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien, pk.keterangan as pangkat, ks.keterangan as kesatuan");
        $this->db->where("i.tgl_masuk>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("i.tgl_masuk<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_lepas_perawatan s", "s.no_reg=i.no_reg and s no_rm=i.no_rm", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->join("pangkat pk", "pk.id_pangkat=p.id_pangkat and pk.id_kesatuan=p.id_kesatuan and pk.id_gol=p.id_gol", "left");
        $this->db->join("kesatuan ks", "ks.id_kesatuan=pk.id_kesatuan", "left");
        $this->db->join("dokter d", "d.id_dokter=i.dpjp", "left");
        $this->db->order_by("i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        return $query;
    }
    function getsuratketerangandokter($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $data = array();
        $this->db->order_by("s.nomor_surat,s.no_reg,s.no_pasien", "desc");
        $query = $this->db->get("surat_keterangan_dokter s", $page, $offset);
        foreach ($query->result() as $row) {
            if ($row->jenis == "ralan") {
                $this->db->select("p.berat_badan,p.nama_pasien,p.tgl_lahir,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,p.no_pasien as no_rm,date(i.tanggal) as tgl_masuk,pl.keterangan as nama_ruangan");
                $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
                $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "inner");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_pasien", $row->no_pasien);
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
                }
                $q = $this->db->get("pasien_ralan i")->row();
            } else {
                $this->db->select("i.tgl_masuk,i.kode_kamar,i.no_bed,p.tgl_lahir,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
                $this->db->join("pasien p", "p.no_pasien=i.no_rm");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "inner");
                $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "inner");
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
                }
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_rm", $row->no_pasien);
                $q = $this->db->get("pasien_inap i")->row();
            }
            $data["master"][$row->nomor_surat] = $q;
            $data["surat"][$row->nomor_surat] = $row;
        }
        return $data;
    }
    function getnarkoba($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $indeks = $this->session->userdata("indeks");
        $data = array();
        $this->db->select("i.*,s.*,p.pekerjaan,p.tgl_lahir,p.nama_pasien,p.alamat,p.telpon");
        $this->db->group_start();
        $this->db->like("i.no_pasien", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tanggal>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tanggal<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");

        $this->db->join("surat_narkoba s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.pekerjaan,p.tgl_lahir,p.nama_pasien,p.alamat,p.telpon");
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");

        $this->db->join("surat_narkoba s", "s.no_reg=i.no_reg", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i", $page, $offset);
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function getjiwa($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $indeks = $this->session->userdata("indeks");
        $data = array();
        $this->db->select("i.*,s.*,p.pekerjaan,p.tgl_lahir,p.nama_pasien,p.alamat,p.telpon");
        $this->db->group_start();
        $this->db->like("i.no_pasien", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("s.tgl_insert>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("s.tgl_insert<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");

        $this->db->join("surat_jiwa s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.pekerjaan,p.tgl_lahir,p.nama_pasien,p.alamat,p.telpon");
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("s.tgl_insert>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("s.tgl_insert<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");

        $this->db->join("surat_jiwa s", "s.no_reg=i.no_reg", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i", $page, $offset);
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function getrujukan($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $indeks = $this->session->userdata("indeks");
        $data = array();
        $this->db->select("i.*,s.*,p.nama_pasien,p.alamat,p.telpon");
        $this->db->group_start();
        $this->db->like("i.no_pasien", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tanggal>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tanggal<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");

        $this->db->join("buku_rujukan s", "s.no_reg=i.no_reg ", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.nama_pasien,p.alamat,p.telpon");
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        }
        if ($indeks != "") {
            $this->db->where("i.no_reg IS NULL");
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");

        $this->db->join("buku_rujukan s", "s.no_reg=i.no_reg", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i", $page, $offset);
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function jumlah_suratketerangandokter()
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $jml = 0;
        if ($no_pasien != "") {
            $this->db->group_start();
            $this->db->like("i.no_pasien", $no_pasien);
            $this->db->or_like("i.no_reg", $no_pasien);
            $this->db->or_like("no_bpjs", $no_pasien);
            $this->db->or_like("no_sjp", $no_pasien);
            $this->db->or_like("p.nama_pasien", $no_pasien);
            $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
            $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
            $this->db->group_end();
        }
        $query = $this->db->get("surat_keterangan_dokter s");
        $jml += $query->num_rows();
        return $jml;
    }
    function jumlahsurat_narkoba()
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $jml = 0;
        $this->db->group_start();
        $this->db->like("i.no_pasien", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tanggal>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tanggal<=", date("Y-m-d", strtotime($tgl2)));
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("surat_narkoba s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $query = $this->db->get("pasien_ralan i");
        $jml += $query->num_rows();
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_narkoba s", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        $query = $this->db->get("pasien_inap i");
        $jml += $query->num_rows();
        return $jml;
    }
    function jumlahsurat_jiwa()
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $jml = 0;
        $this->db->group_start();
        $this->db->like("i.no_pasien", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("s.tgl_insert>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("s.tgl_insert<=", date("Y-m-d", strtotime($tgl2)));
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("surat_jiwa s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $query = $this->db->get("pasien_ralan i");
        $jml += $query->num_rows();
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("s.tgl_insert>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("s.tgl_insert<=", date("Y-m-d", strtotime($tgl2)));
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_jiwa s", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        $query = $this->db->get("pasien_inap i");
        $jml += $query->num_rows();
        return $jml;
    }
    function jumlahsurat_rujukan()
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $jml = 0;
        $this->db->group_start();
        $this->db->like("i.no_pasien", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("s.tgl_insert>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("s.tgl_insert<=", date("Y-m-d", strtotime($tgl2)));
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("buku_rujukan s", "s.no_reg=i.no_reg", "inner");
        $query = $this->db->get("pasien_ralan i");
        $jml += $query->num_rows();
        $this->db->group_start();
        $this->db->like("i.no_rm", $no_pasien);
        $this->db->or_like("i.no_reg", $no_pasien);
        $this->db->or_like("no_bpjs", $no_pasien);
        $this->db->or_like("no_sjp", $no_pasien);
        $this->db->or_like("p.nama_pasien", $no_pasien);
        $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
        $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
        $this->db->group_end();
        if ($kode_kelas != "") {
            $this->db->where("i.kode_kelas", $kode_kelas);
        }
        if ($kode_ruangan != "") {
            $this->db->where("i.kode_ruangan", $kode_ruangan);
        }
        if ($tgl1 != "" or $tgl2 != "") {
            $this->db->where("s.tgl_insert>=", date("Y-m-d", strtotime($tgl1)));
            $this->db->where("s.tgl_insert<=", date("Y-m-d", strtotime($tgl2)));
        }
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("buku_rujukan s", "s.no_reg=i.no_reg ", "inner");
        $query = $this->db->get("pasien_inap i");
        $jml += $query->num_rows();
        return $jml;
    }
    function cetaklistsuratketerangandokter($tgl1, $tgl2)
    {
        $data = array();
        $this->db->select("i.*,s.*,p.tgl_lahir,p.berat_badan,p.nama_pasien,p.telpon,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,pl.keterangan as nama_ruangan");
        $this->db->where("date(s.tgl_insert)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(s.tgl_insert)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("surat_keterangan_dokter s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "left");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("kelas k", "k.kode_kelas=p.kode_kelas", "left");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.tgl_lahir,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
        $this->db->where("date(s.tgl_insert)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(s.tgl_insert)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_keterangan_dokter s", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function cetaklistnarkoba($tgl1, $tgl2)
    {
        $data = array();
        $this->db->select("i.*,s.*,p.tgl_lahir,p.pekerjaan,p.nama_pasien,p.telpon,p.alamat");
        $this->db->where("date(s.tgl_insert)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(s.tgl_insert)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("surat_narkoba s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.tgl_lahir,p.pekerjaan,p.nama_pasien,p.telpon,p.alamat");
        $this->db->where("date(s.tgl_insert)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(s.tgl_insert)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_narkoba s", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function cetaklistjiwa($tgl1, $tgl2)
    {
        $data = array();
        $this->db->select("i.*,s.*,p.tgl_lahir,p.pekerjaan,p.nama_pasien,p.telpon,p.alamat");
        $this->db->where("date(s.tgl_insert)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(s.tgl_insert)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("surat_jiwa s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.tgl_lahir,p.pekerjaan,p.nama_pasien,p.telpon,p.alamat");
        $this->db->where("date(s.tgl_insert)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(s.tgl_insert)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_jiwa s", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function cetaklistrujukan($tgl1, $tgl2)
    {
        $data = array();
        $this->db->select("i.*,s.*,p.tgl_lahir,p.pekerjaan,p.nama_pasien,p.telpon,p.alamat");
        $this->db->where("date(s.tgl_insert)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(s.tgl_insert)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
        $this->db->join("buku_rujukan s", "s.no_reg=i.no_reg and s.no_pasien=i.no_pasien", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_pasien", "desc");
        $query = $this->db->get("pasien_ralan i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        $this->db->select("i.*,s.*,p.tgl_lahir,p.pekerjaan,p.nama_pasien,p.telpon,p.alamat");
        $this->db->where("date(s.tgl_insert)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(s.tgl_insert)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("buku_rujukan s", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        foreach ($query->result() as $row) {
            $data[$row->nomor_surat] = $row;
        }
        return $data;
    }
    function getsuratistirahatsakit($page, $offset)
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $data = array();
        $this->db->order_by("s.nomor_surat,s.no_reg,s.no_pasien", "desc");
        $query = $this->db->get("surat_istirahat_sakit s", $page, $offset);
        foreach ($query->result() as $row) {
            if ($row->jenis == "ralan") {
                $this->db->select("p.berat_badan,p.nama_pasien,p.telpon,p.alamat,p.no_bpjs, g.keterangan as gol_pasien,p.no_pasien as no_rm,date(i.tanggal) as tgl_masuk,pl.keterangan as nama_ruangan");
                $this->db->join("pasien p", "p.no_pasien=i.no_pasien");
                $this->db->join("poliklinik pl", "pl.kode=i.tujuan_poli", "inner");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_pasien", $row->no_pasien);
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tanggal_pulang>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tanggal_pulang<=", date("Y-m-d", strtotime($tgl2)));
                }
                $q = $this->db->get("pasien_ralan i")->row();
            } else {
                $this->db->select("i.tgl_masuk,i.kode_kamar,i.no_bed,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
                $this->db->join("pasien p", "p.no_pasien=i.no_rm");
                $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "inner");
                $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "inner");
                $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "inner");
                if ($tgl1 != "" or $tgl2 != "") {
                    $this->db->where("i.tgl_keluar>=", date("Y-m-d", strtotime($tgl1)));
                    $this->db->where("i.tgl_keluar<=", date("Y-m-d", strtotime($tgl2)));
                }
                $this->db->where("i.no_reg", $row->no_reg);
                $this->db->where("i.no_rm", $row->no_pasien);
                $q = $this->db->get("pasien_inap i")->row();
            }
            $data["master"][$row->nomor_surat] = $q;
            $data["surat"][$row->nomor_surat] = $row;
        }
        return $data;
    }
    function jumlah_suratistirahatsakit()
    {
        $kode_kelas = $this->session->userdata("kode_kelas");
        $kode_ruangan = $this->session->userdata("kode_ruangan");
        $tgl1 = $this->session->userdata("tgl1");
        $tgl2 = $this->session->userdata("tgl2");
        $no_pasien = $this->session->userdata("no_pasien");
        $no_reg = $this->session->userdata("no_reg");
        $nama = $this->session->userdata("nama");
        $jml = 0;
        if ($no_pasien != "") {
            $this->db->group_start();
            $this->db->like("i.no_pasien", $no_pasien);
            $this->db->or_like("i.no_reg", $no_pasien);
            $this->db->or_like("no_bpjs", $no_pasien);
            $this->db->or_like("no_sjp", $no_pasien);
            $this->db->or_like("p.nama_pasien", $no_pasien);
            $this->db->or_like("p.nip", $this->session->userdata("no_pasien"));
            $this->db->or_like("p.ktp", $this->session->userdata("no_pasien"));
            $this->db->group_end();
        }
        $query = $this->db->get("surat_istirahat_sakit s");
        $jml += $query->num_rows();
        return $jml;
    }
    function cetaklistsuratistirahatsakit($tgl1, $tgl2)
    {
        $this->db->select("i.*,s.*,p.tgl_lahir,p.berat_badan,p.nama_pasien,p.telpon, r.nama_ruangan,k.nama_kelas,p.alamat,p.no_bpjs, g.keterangan as gol_pasien");
        $this->db->where("date(s.tgl_insert)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(s.tgl_insert)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->join("pasien p", "p.no_pasien=i.no_rm");
        $this->db->join("surat_istirahat_sakit s", "s.no_reg=i.no_reg and s.no_pasien=i.no_rm", "inner");
        $this->db->join("gol_pasien g", "g.id_gol=p.id_gol", "left");
        $this->db->join("ruangan r", "r.kode_ruangan=i.kode_ruangan", "left");
        $this->db->join("kelas k", "k.kode_kelas=i.kode_kelas", "left");
        $this->db->order_by("s.nomor_surat,i.no_reg,i.no_rm", "desc");
        $query = $this->db->get("pasien_inap i");
        return $query;
    }

    function getdetailsurat_masuk_sekretariat($id)
    {
        $this->db->select("sms.*");
        $q = $this->db->get_where("surat_masuk_sekretariat sms", array("no_agenda_surat" => $id));
        return $q->row();
    }
    function getsurat_masuk_sekretariat()
    {
        $no_surat = $this->session->userdata("no_agenda_surat");
        $this->db->like("no_agenda_surat", $no_surat);
        $this->db->order_by("no_agenda_surat", "desc");
        $q = $this->db->get("surat_masuk_sekretariat");
        return $q;
    }
    function jumlah_suratmasuksekretariat()
    {
        $query = $this->db->get("surat_masuk_sekretariat", "desc");
        return $query->num_rows();
    }
    function getno_suratmasuksekretariat_baru()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("surat_masuk_sekretariat", array("no_agenda_surat" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function simpansuratmasuksekretariat($action, $nama_file = "")
    {
        switch ($action) {
            case 'simpan':
                $no_agenda_surat = $this->getno_suratmasuksekretariat_baru();
                $data1 = array(
                    'no_agenda_surat' => $no_agenda_surat,
                    'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'tanggal_surat' => date('Y-m-d', strtotime($this->input->post('tanggal_surat'))),
                    'lampiran' => $this->input->post('lampiran'),
                    'pengirim' => $this->input->post('pengirim'),
                    'perihal' => $this->input->post('perihal'),
                    'disposisi' => $this->input->post('disposisi'),
                );
                $this->db->insert("surat_masuk_sekretariat", $data1);
                break;
            case 'edit':
                $no_agenda_surat = $this->input->post('idlama');
                $data = array(
                    'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'tanggal_surat' => date('Y-m-d', strtotime($this->input->post('tanggal_surat'))),
                    'lampiran' => $this->input->post('lampiran'),
                    'pengirim' => $this->input->post('pengirim'),
                    'perihal' => $this->input->post('perihal'),
                    'disposisi' => $this->input->post('disposisi'),
                );
                $this->db->where("no_agenda_surat", $no_agenda_surat);
                $this->db->update("surat_masuk_sekretariat", $data);
                break;
        }
        if ($nama_file != "") {
            $data = array(
                'filepdf' => $nama_file
            );
            $this->db->where("no_agenda_surat", $no_agenda_surat);
            $this->db->update("surat_masuk_sekretariat", $data);
        }
        return "success-Data berhasil di input-" . $no_agenda_surat;
    }
    function cetaklistmasuksekretariat($tgl1, $tgl2)
    {
        $this->db->select("sms.*,");
        $this->db->where("date(sms.tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(sms.tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("sms.no_agenda_surat", "desc");
        $query = $this->db->get("surat_masuk_sekretariat sms");
        return $query;
    }
    function getdetailsurat_b_keluarsekretariat($id)
    {
        $this->db->select("sbk.*");
        $q = $this->db->get_where("surat_b_keluar_sekretariat sbk", array("no_b_keluar" => $id));
        return $q->row();
    }
    function getsurat_b_keluarsekretariat()
    {
        $no_surat = $this->session->userdata("no_b_keluar");
        $this->db->like("no_b_keluar", $no_surat);
        $this->db->order_by("no_b_keluar", "desc");
        $q = $this->db->get("surat_b_keluar_sekretariat");
        return $q;
    }
    function jumlah_b_keluarsekretariat()
    {
        $query = $this->db->get("surat_b_keluar_sekretariat", "desc");
        return $query->num_rows();
    }
    function getno_surat_b_keluarsekretariat_baru()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("surat_b_keluar_sekretariat", array("no_b_keluar" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function simpansurat_b_keluarsekretariat($action, $nama_file = "")
    {
        switch ($action) {
            case 'simpan':
                $no_b_keluar = $this->getno_surat_b_keluarsekretariat_baru();
                $data1 = array(
                    'no_b_keluar' => $no_b_keluar,
                    'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'kepada' => $this->input->post('kepada'),
                    'asal_surat' => $this->input->post('asal_surat'),
                    'perihal' => $this->input->post('perihal'),
                    'lampiran' => $this->input->post('lampiran'),
                );
                $this->db->insert("surat_b_keluar_sekretariat", $data1);
                break;
            case 'edit':
                $no_b_keluar = $this->input->post('idlama');
                $data = array(
                    'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'kepada' => $this->input->post('kepada'),
                    'asal_surat' => $this->input->post('asal_surat'),
                    'perihal' => $this->input->post('perihal'),
                    'lampiran' => $this->input->post('lampiran'),
                );
                $this->db->where("no_b_keluar", $no_b_keluar);
                $this->db->update("surat_b_keluar_sekretariat", $data);
                break;
        }
        if ($nama_file != "") {
            $data = array(
                'filepdf' => $nama_file
            );
            $this->db->where("no_b_keluar", $no_b_keluar);
            $this->db->update("surat_b_keluar_sekretariat", $data);
        }
        return "success-Data berhasil di input-" . $no_b_keluar;
    }
    function cetaklist_bkeluar($tgl1, $tgl2)
    {
        $this->db->select("b.*,");
        $this->db->where("date(b.tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(b.tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("b.no_b_keluar", "desc");
        $query = $this->db->get("surat_b_keluar_sekretariat b");
        return $query;
    }
    function getsprin_keluar()
    {
        $no_surat = $this->session->userdata("no_sprint");
        $this->db->like("no_sprint", $no_surat);
        $this->db->order_by("no_sprint", "desc");
        $q = $this->db->get("sprint_keluar");
        return $q;
    }
    function jumlah_sprintkeluar()
    {
        $query = $this->db->get("sprint_keluar", "desc");
        return $query->num_rows();
    }
    function getdetaillampiran_sprint($id)
    {
        $this->db->select("h.*,p.*,p.nama_perawat as nama,p.pangkat,s.tmt as ta_tmt,j1.nama_jabatan as nama_jabatan_baru,j2.nama_jabatan as nama_jabatan_lama");
        $this->db->join("perawat p", "h.nrp=p.id_perawat", "inner");
        $this->db->join("jabatan j1", "j1.kode_jabatan=h.jabatan_baru", "left");
        $this->db->join("jabatan j2", "j2.kode_jabatan=h.jabatan_lama", "left");
        $this->db->join("sprint_keluar s", "s.no_sprint=h.no_sprint", "inner");
        $this->db->order_by("h.no_sprint", "desc");
        $q = $this->db->get_where("history_jabatan h", array("h.no_sprint" => $id));
        return $q;
    }
    function getkegiatan($id)
    {
        $this->db->select("k.*,p.*,p.nama_perawat as nama,p.pangkat,p.jabatan,s.tmt as ta_tmt");
        $this->db->join("perawat p", "k.nrp=p.id_perawat", "inner");
        $this->db->join("sprint_keluar s", "s.no_sprint=k.no_sprint", "inner");
        $this->db->order_by("k.no_sprint", "desc");
        $q = $this->db->get_where("history_kegiatan k", array("k.no_sprint" => $id));
        return $q;
    }
    function getdetailsprintkeluar($id)
    {
        $this->db->order_by("h.no_sprint", "desc");
        $q = $this->db->get_where("history_jabatan h", array("no_sprint" => $id));
        return $q;
    }
    function getdetailsprint($id)
    {
        $q = $this->db->get_where("sprint_keluar", array("no_sprint" => $id));
        return $q->row();
    }
    function getcetaksprintkeluar($id)
    {
        $this->db->select("h.*,p.*,p.nama_perawat as nama,p.pangkat,s.tmt as ta_tmt,s.ket as keterangan,j1.nama_jabatan as nama_jabatan_baru,j2.nama_jabatan as nama_jabatan_lama");
        $this->db->join("perawat p", "h.nrp=p.id_perawat", "inner");
        $this->db->join("jabatan j1", "j1.kode_jabatan=h.jabatan_baru", "left");
        $this->db->join("jabatan j2", "j2.kode_jabatan=h.jabatan_lama", "left");
        $this->db->join("sprint_keluar s", "s.no_sprint=h.no_sprint", "inner");
        $this->db->order_by("h.no_sprint", "desc");
        $q = $this->db->get_where("history_jabatan h", array("h.no_sprint" => $id));
        return $q;
    }

    function addsprintperawat($action)
    {
        $q = $this->db->get_where("history_jabatan", ["no_sprint" => $this->input->post('no_sprint'), "nrp" => $this->input->post('nrp')]);
        if ($q->num_rows() > 0) {
            return "danger-Data Perawat sudah ada";
        } else {
            $data1 = array(
                'no_sprint' => $this->input->post('no_sprint'),
                'nrp' => $this->input->post('nrp'),
                'jabatan_lama' => $this->input->post('jabatan_lama'),
                'jabatan_baru' => $this->input->post('jabatan_baru'),
            );
            $this->db->insert("history_jabatan", $data1);
            return "success-Data berhasil disimpan";
        }
    }
    function addkegiatan($action)
    {
        $q = $this->db->get_where("history_kegiatan", ["no_sprint" => $this->input->post('no_sprint'), "nrp" => $this->input->post('nrp')]);
        if ($q->num_rows() > 0) {
            return "danger-Data Perawat sudah ada";
        } else {
            $data1 = array(
                'no_sprint' => $this->input->post('no_sprint'),
                'nrp' => $this->input->post('nrp'),
                'tim' => $this->input->post('tim'),
            );
            $this->db->insert("history_kegiatan", $data1);
            return "success-Data berhasil disimpan";
        }
    }
    function getno_sprint_keluar()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("sprint_keluar", array("no_sprint" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }

    function simpansprint_keluar($action, $nama_file = "")
    {
        switch ($action) {
            case 'simpan':
                $no_sprint = $this->getno_sprint_keluar();
                $data1 = array(
                    'no_sprint' => $no_sprint,
                    'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'asal_surat' => $this->input->post('asal_surat'),
                    'tmt' => date('Y-m-d', strtotime($this->input->post('tmt'))),
                    'perihal' => $this->input->post('perihal'),
                    'ket' => $this->input->post('ket'),
                    'pertimbangan' => $this->input->post('pertimbangan'),
                    'dasar' => $this->input->post('dasar'),
                    'kepada' => $this->input->post('kepada'),
                    'untuk' => $this->input->post('untuk'),
                    'tembusan' => $this->input->post('tembusan'),
                );
                $this->db->insert("sprint_keluar", $data1);
                break;
            case 'edit':
                $no_sprint = $this->input->post('idlama');
                $data = array(
                    'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'asal_surat' => $this->input->post('asal_surat'),
                    'tmt' => date('Y-m-d', strtotime($this->input->post('tmt'))),
                    'perihal' => $this->input->post('perihal'),
                    'ket' => $this->input->post('ket'),
                    'pertimbangan' => $this->input->post('pertimbangan'),
                    'dasar' => $this->input->post('dasar'),
                    'kepada' => $this->input->post('kepada'),
                    'untuk' => $this->input->post('untuk'),
                    'tembusan' => $this->input->post('tembusan'),
                );
                $this->db->where("no_sprint", $no_sprint);
                $this->db->update("sprint_keluar", $data);
                break;
        }
        if ($nama_file != "") {
            $data = array(
                'filepdf' => $nama_file
            );
            $this->db->where("no_sprint", $no_sprint);
            $this->db->update("sprint_keluar", $data);
        }
        return "success-Data berhasil di input-" . $no_sprint;
    }
    function cetaklistsprint_keluar($tgl1, $tgl2)
    {
        $this->db->select("sk.*,");
        $this->db->where("date(sk.tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(sk.tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("sk.no_sprint", "desc");
        $query = $this->db->get("sprint_keluar sk");
        return $query;
    }
    function sprintperawat()
    {
        $this->db->select("p.*,s.*");
        $this->db->join("sprint_keluar sk", "sk.no_sprint=p.id_perawat");
        $this->db->order_by("sk.no_sprint", "desc");
        $query = $this->db->get("perawat p");
        return $query;
    }
    function getcutitahunan()
    {
        $nomor = $this->session->userdata("nomor");
        $this->db->like("nomor", $nomor);
        $this->db->select("ct.*,p.nama_perawat as nama");
        $this->db->join("perawat p", "ct.nrp=p.id_perawat", "inner");
        $this->db->order_by("ct.nomor", "desc");
        $query = $this->db->get("cuti_tahunan ct");
        return $query;
    }
    function jumlah_cutitahunan()
    {
        $query = $this->db->get("cuti_tahunan", "desc");
        return $query->num_rows();
    }
    function getdetailcutitahunan($id)
    {
        $q = $this->db->get_where("cuti_tahunan", array("nomor" => $id));
        return $q->row();
    }
    function simpancutitahunan($action)
    {
        switch ($action) {
            case 'simpan':
                $nomor = $this->getno_cutitahunan();
                $data1 = array(
                    'nomor' => $nomor,
                    'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'tgl_berangkat' => date('Y-m-d', strtotime($this->input->post('tgl_berangkat'))),
                    'tgl_kembali' => date('Y-m-d', strtotime($this->input->post('tgl_kembali'))),
                    'pangkat' => $this->input->post('pangkat'),
                    'nrp' => $this->input->post('nrp'),
                    'jabatan' => $this->input->post('jabatan'),
                    'keperluan' => $this->input->post('keperluan'),
                    'tujuan' => $this->input->post('tujuan'),
                    'ket' => $this->input->post('ket'),
                );
                $this->db->insert("cuti_tahunan", $data1);
                break;
            case 'edit':
                $nomor = $this->input->post('idlama');
                $data = array(
                    'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'tgl_berangkat' => date('Y-m-d', strtotime($this->input->post('tgl_berangkat'))),
                    'tgl_kembali' => date('Y-m-d', strtotime($this->input->post('tgl_kembali'))),
                    'pangkat' => $this->input->post('pangkat'),
                    'nrp' => $this->input->post('nrp'),
                    'jabatan' => $this->input->post('jabatan'),
                    'keperluan' => $this->input->post('keperluan'),
                    'tujuan' => $this->input->post('tujuan'),
                    'ket' => $this->input->post('ket'),
                );
                $this->db->where("nomor", $nomor);
                $this->db->update("cuti_tahunan", $data);
                break;
        }
        return "success-Data berhasil di input-" . $nomor;
    }

    function getno_cutitahunan()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("cuti_tahunan", array("nomor" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }

    function cetakrekapcuti($tgl1, $tgl2)
    {
        $this->db->select("ct.*,");
        $this->db->where("date(ct.tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(ct.tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("ct.nomor", "desc");
        $query = $this->db->get("cuti_tahunan ct");
        return $query;
    }
    function getcutiperawat($nama)
    {
        $this->db->like('nama_perawat', $nama, 'both');
        $this->db->order_by('nama_perawat', 'ASC');
        $this->db->limit(10);
        return $this->db->get('perawat')->result();
    }
    function getperawat()
    {
        $this->db->select("id_perawat,nama_perawat,jabatan,pangkat");
        $q = $this->db->get("perawat");
        return $q;
    }
    function getjabatan()
    {
        $q = $this->db->get("jabatan");
        return $q;
    }
    function getpengajuan($id)
    {
        $this->db->select("ct.*,p.*,p.nama_perawat as nama");
        $this->db->join("perawat p", "ct.nrp=p.id_perawat", "inner");
        $this->db->order_by("ct.nomor", "desc");
        $query = $this->db->get_where("cuti_tahunan ct", array("ct.nomor" => $id));
        return $query->row();
    }
    function getsuratsprint()
    {
        $q = $this->db->get("sprint_keluar");
        return $q->row();
    }
    function getmou()
    {
        $no_surat = $this->session->userdata("no_surat");
        $this->db->like("no_surat", $no_surat);
        $this->db->order_by("no_surat", "desc");
        $q = $this->db->get("mou");
        return $q;
    }
    function getdetailmou($id)
    {
        $q = $this->db->get_where("mou", array("no_surat" => $id));
        return $q->row();
    }
    function jumlah_mou()
    {
        $query = $this->db->get("mou", "desc");
        return $query->num_rows();
    }
    function getno_mou()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("mou", array("no_surat" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function simpanmou($action, $nama_file = "")
    {
        switch ($action) {
            case 'simpan':
                $no_surat = $this->getno_mou();
                $data1 = array(
                    'no_surat'      => $no_surat,
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'tgl_awal'       => date('Y-m-d', strtotime($this->input->post('tgl_awal'))),
                    'tgl_akhir'       => date('Y-m-d', strtotime($this->input->post('tgl_akhir'))),
                    'kepada'        => $this->input->post('kepada'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'perihal'       => $this->input->post('perihal'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->insert("mou", $data1);
                break;
            case 'edit':
                $no_surat = $this->input->post('idlama');
                $data = array(
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'tgl_awal'       => date('Y-m-d', strtotime($this->input->post('tgl_awal'))),
                    'tgl_akhir'       => date('Y-m-d', strtotime($this->input->post('tgl_akhir'))),
                    'kepada'        => $this->input->post('kepada'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'perihal'       => $this->input->post('perihal'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->where("no_surat", $no_surat);
                $this->db->update("mou", $data);
                break;
        }
        if ($nama_file != "") {
            $data = array(
                'filepdf' => $nama_file
            );
            $this->db->where("no_surat", $no_surat);
            $this->db->update("mou", $data);
        }
        return "success-Data berhasil di input-" . $no_surat;
    }
    function cetaklistmou($tgl1, $tgl2)
    {
        $this->db->where("date(tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("no_surat", "desc");
        $query = $this->db->get("mou");
        return $query;
    }
    function get_ba()
    {
        $no_surat = $this->session->userdata("no_surat");
        $this->db->like("no_surat", $no_surat);
        $this->db->order_by("no_surat", "desc");
        $q = $this->db->get("no_ba");
        return $q;
    }
    function getdetail_ba($id)
    {
        $q = $this->db->get_where("no_ba", array("no_surat" => $id));
        return $q->row();
    }
    function jumlah_ba()
    {
        $query = $this->db->get("no_ba", "desc");
        return $query->num_rows();
    }
    function getno_ba()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("no_ba", array("no_surat" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function simpan_ba($action, $nama_file = "")
    {
        switch ($action) {
            case 'simpan':
                $no_surat = $this->getno_ba();
                $data1 = array(
                    'no_surat'      => $no_surat,
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'kepada'        => $this->input->post('kepada'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'perihal'       => $this->input->post('perihal'),
                    'lampiran'      => $this->input->post('lampiran'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->insert("no_ba", $data1);
                break;
            case 'edit':
                $no_surat = $this->input->post('idlama');
                $data = array(
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'kepada'        => $this->input->post('kepada'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'perihal'       => $this->input->post('perihal'),
                    'lampiran'      => $this->input->post('lampiran'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->where("no_surat", $no_surat);
                $this->db->update("no_ba", $data);
                break;
        }
        if ($nama_file != "") {
            $data = array(
                'filepdf' => $nama_file
            );
            $this->db->where("no_surat", $no_surat);
            $this->db->update("no_ba", $data);
        }
        return "success-Data berhasil di input-" . $no_surat;
    }
    function cetaklistno_ba($tgl1, $tgl2)
    {
        $this->db->where("date(tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("no_surat", "desc");
        $query = $this->db->get("no_ba");
        return $query;
    }
    function get_se()
    {
        $no_surat = $this->session->userdata("no_surat");
        $this->db->like("no_surat", $no_surat);
        $this->db->order_by("no_surat", "desc");
        $q = $this->db->get("se_keluar");
        return $q;
    }
    function getdetail_se($id)
    {
        $q = $this->db->get_where("se_keluar", array("no_surat" => $id));
        return $q->row();
    }
    function jumlah_se()
    {
        $query = $this->db->get("se_keluar", "desc");
        return $query->num_rows();
    }
    function getno_se()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("se_keluar", array("no_surat" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function simpan_se($action, $nama_file = "")
    {
        switch ($action) {
            case 'simpan':
                $no_surat = $this->getno_se();
                $data1 = array(
                    'no_surat'      => $no_surat,
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'uraian'        => $this->input->post('uraian'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->insert("se_keluar", $data1);
                break;
            case 'edit':
                $no_surat = $this->input->post('idlama');
                $data = array(
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'uraian'        => $this->input->post('uraian'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->where("no_surat", $no_surat);
                $this->db->update("se_keluar", $data);
                break;
        }
        if ($nama_file != "") {
            $data = array(
                'filepdf' => $nama_file
            );
            $this->db->where("no_surat", $no_surat);
            $this->db->update("se_keluar", $data);
        }
        return "success-Data berhasil di input-" . $no_surat;
    }
    function cetaklistno_se($tgl1, $tgl2)
    {
        $this->db->where("date(tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("no_surat", "desc");
        $query = $this->db->get("se_keluar");
        return $query;
    }
    function get_nokep()
    {
        $no_surat = $this->session->userdata("no_surat");
        $this->db->like("no_surat", $no_surat);
        $this->db->order_by("no_surat", "desc");
        $q = $this->db->get("nokep");
        return $q;
    }
    function getdetail_nokep($id)
    {
        $q = $this->db->get_where("nokep", array("no_surat" => $id));
        return $q->row();
    }
    function jumlah_nokep()
    {
        $query = $this->db->get("nokep", "desc");
        return $query->num_rows();
    }
    function getno_nokep()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("nokep", array("no_surat" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function simpan_nokep($action, $nama_file = "")
    {
        switch ($action) {
            case 'simpan':
                $no_surat = $this->getno_nokep();
                $data1 = array(
                    'no_surat'      => $no_surat,
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'tgl_kep'       => date('Y-m-d', strtotime($this->input->post('tgl_kep'))),
                    'uraian'        => $this->input->post('uraian'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->insert("nokep", $data1);
                break;
            case 'edit':
                $no_surat = $this->input->post('idlama');
                $data = array(
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'tgl_kep'       => date('Y-m-d', strtotime($this->input->post('tgl_kep'))),
                    'uraian'        => $this->input->post('uraian'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->where("no_surat", $no_surat);
                $this->db->update("nokep", $data);
                break;
        }
        if ($nama_file != "") {
            $data = array(
                'filepdf' => $nama_file
            );
            $this->db->where("no_surat", $no_surat);
            $this->db->update("nokep", $data);
        }
        return "success-Data berhasil di input-" . $no_surat;
    }
    function cetaklist_nokep($tgl1, $tgl2)
    {
        $this->db->where("date(tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("no_surat", "desc");
        $query = $this->db->get("nokep");
        return $query;
    }
    function get_noketkeluar()
    {
        $no_surat = $this->session->userdata("no_surat");
        $this->db->like("no_surat", $no_surat);
        $this->db->order_by("no_surat", "desc");
        $q = $this->db->get("noketkeluar");
        return $q;
    }
    function getdetail_noketkeluar($id)
    {
        $q = $this->db->get_where("noketkeluar", array("no_surat" => $id));
        return $q->row();
    }
    function jumlah_noketkeluar()
    {
        $query = $this->db->get("noketkeluar", "desc");
        return $query->num_rows();
    }
    function getno_noketkeluar()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("noketkeluar", array("no_surat" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function simpan_noketkeluar($action, $nama_file = "")
    {
        switch ($action) {
            case 'simpan':
                $no_surat = $this->getno_noketkeluar();
                $data1 = array(
                    'no_surat'      => $no_surat,
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'uraian'        => $this->input->post('uraian'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->insert("noketkeluar", $data1);
                break;
            case 'edit':
                $no_surat = $this->input->post('idlama');
                $data = array(
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'uraian'        => $this->input->post('uraian'),
                    'asal_surat'    => $this->input->post('asal_surat'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->where("no_surat", $no_surat);
                $this->db->update("noketkeluar", $data);
                break;
        }
        if ($nama_file != "") {
            $data = array(
                'filepdf' => $nama_file
            );
            $this->db->where("no_surat", $no_surat);
            $this->db->update("noketkeluar", $data);
        }
        return "success-Data berhasil di input-" . $no_surat;
    }
    function cetaklist_noketkeluar($tgl1, $tgl2)
    {
        $this->db->where("date(tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("no_surat", "desc");
        $query = $this->db->get("noketkeluar");
        return $query;
    }

    function get_kontrak()
    {
        $no_surat = $this->session->userdata("no_surat");
        $this->db->like("no_surat", $no_surat);
        $this->db->order_by("no_surat", "desc");
        $q = $this->db->get("kontrak");
        return $q;
    }
    function getdetail_kontrak($id)
    {
        $q = $this->db->get_where("kontrak", array("no_surat" => $id));
        return $q->row();
    }
    function jumlah_kontrak()
    {
        $query = $this->db->get("kontrak", "desc");
        return $query->num_rows();
    }
    function getno_kontrak()
    {
        for ($i = 1; $i <= 300000; $i++) {
            $n = substr("000000" . $i, -6, 6);
            $q = $this->db->get_where("kontrak", array("no_surat" => $n));

            if ($q->num_rows() <= 0) {
                return $n;
                break;
            }
        }
    }
    function simpan_kontrak($action, $nama_file = "")
    {
        switch ($action) {
            case 'simpan':
                $no_surat = $this->getno_kontrak();
                $data1 = array(
                    'no_surat'      => $no_surat,
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'perihal'        => $this->input->post('perihal'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->insert("kontrak", $data1);
                break;
            case 'edit':
                $no_surat = $this->input->post('idlama');
                $data = array(
                    'tanggal'       => date('Y-m-d', strtotime($this->input->post('tanggal'))),
                    'perihal'        => $this->input->post('perihal'),
                    'ket'           => $this->input->post('ket'),
                );
                $this->db->where("no_surat", $no_surat);
                $this->db->update("kontrak", $data);
                break;
        }
        if ($nama_file != "") {
            $data = array(
                'filepdf' => $nama_file
            );
            $this->db->where("no_surat", $no_surat);
            $this->db->update("kontrak", $data);
        }
        return "success-Data berhasil di input-" . $no_surat;
    }
    function cetaklist_kontrak($tgl1, $tgl2)
    {
        $this->db->where("date(tanggal)>=", date("Y-m-d", strtotime($tgl1)));
        $this->db->where("date(tanggal)<=", date("Y-m-d", strtotime($tgl2)));
        $this->db->order_by("no_surat", "desc");
        $query = $this->db->get("kontrak");
        return $query;
    }

}
