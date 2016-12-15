<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kirim_pesan extends CI_Model {

	public function kirim($pesan,$nis,$pilih_nomer,$pilih_kelas)
	{
		if ($pilih_nomer=="siswa") {
			$query = '
					SELECT siswa.telp_siswa FROM siswa_kelas
					LEFT JOIN siswa ON siswa_kelas.nis=siswa.nis
					LEFT JOIN tahun_ajr ON siswa_kelas.id_thnajar=tahun_ajr.id_thnajar
					WHERE siswa_kelas.nis='.$nis.' && siswa_kelas.id_kls='.$pilih_kelas.' && tahun_ajr.status=1';
			$sql = $this->db->query($query);

			$data = array(
			    'DestinationNumber' => $sql->row()->telp_siswa,
			    'TextDecoded' => $pesan,
			);
		    $this->db->insert('outbox',$data);

        }elseif ($pilih_nomer=="orang_tua") {
        	$query = '
					SELECT siswa.telp_ortu FROM siswa_kelas
					LEFT JOIN siswa ON siswa_kelas.nis=siswa.nis
					LEFT JOIN tahun_ajr ON siswa_kelas.id_thnajar=tahun_ajr.id_thnajar
					WHERE siswa_kelas.nis='.$nis.' && siswa_kelas.id_kls='.$pilih_kelas.' && tahun_ajr.status=1';
			$sql = $this->db->query($query);

			$data = array(
			    'DestinationNumber' => $sql->row()->telp_ortu,
			    'TextDecoded' => $pesan,
			);
		    $this->db->insert('outbox',$data);

        }elseif ($pilih_nomer=="orang_tua_siswa") {
        	$query = '
					SELECT siswa.telp_ortu, siswa.telp_siswa FROM siswa_kelas
					LEFT JOIN siswa ON siswa_kelas.nis=siswa.nis
					LEFT JOIN tahun_ajr ON siswa_kelas.id_thnajar=tahun_ajr.id_thnajar
					WHERE siswa_kelas.nis='.$nis.' && siswa_kelas.id_kls='.$pilih_kelas.' && tahun_ajr.status=1';
			$sql = $this->db->query($query);
			$data = array();
            for ($i=0;$i<2;$i++) {
            	if ($i==0) {
	            	$data[$i]= array(
	            		'DestinationNumber' => $sql->row()->telp_ortu,
	            		'TextDecoded' => $pesan,
	            	);	
            	}elseif ($i==1) {
            		$data[$i]= array(
	            		'DestinationNumber' => $sql->row()->telp_siswa,
	            		'TextDecoded' => $pesan,
	            	);
            	}
            }
            //insert_batch untuk multi insert
            $this->db->insert_batch('outbox', $data);
        }  
		return $this->db->insert_id();
	}

	//untuk broadcast
	public function kirim_broadcast($pesan,$pilih_nomer,$pilih_kelas)
	{
			$query = '
					SELECT siswa.telp_ortu, siswa.telp_siswa FROM siswa_kelas
					LEFT JOIN siswa ON siswa_kelas.nis=siswa.nis
                    LEFT JOIN tahun_ajr ON siswa_kelas.id_thnajar=tahun_ajr.id_thnajar
					WHERE siswa_kelas.id_kls='.$pilih_kelas.' && tahun_ajr.status=1';
			$sql = $this->db->query($query);
			$tampung = $sql->result();

		if ($pilih_nomer=="siswa") {
			$data = array();
			$i=0;
			foreach ($tampung as $key) {
				$data[$i]= array(
            		'DestinationNumber' => $key->telp_siswa,
            		'TextDecoded' => $pesan,
            	);            	
				$i++;
			}
			$this->db->insert_batch('outbox', $data);

        }elseif ($pilih_nomer=="orang_tua") {
        	$data = array();
			$i=0;
			foreach ($tampung as $key) {
				$data[$i]= array(
            		'DestinationNumber' => $key->telp_ortu,
            		'TextDecoded' => $pesan,
            	);            	
				$i++;
			}
			$this->db->insert_batch('outbox', $data);

        }elseif ($pilih_nomer=="orang_tua_siswa") {
        	$data = array();
        	$data2 = array();
			$i=0;
			foreach ($tampung as $key) {
				$data[$i]= array(
            		'DestinationNumber' => $key->telp_ortu,
            		'TextDecoded' => $pesan,
            	); 
            	$data2[$i]= array(
            		'DestinationNumber' => $key->telp_siswa,
            		'TextDecoded' => $pesan,
            	);            	
				$i++;
			}
			$this->db->insert_batch('outbox', $data);
			$this->db->insert_batch('outbox', $data2);
        }          
		return $this->db->insert_id();
	}

	public function auto_reply()
    {
        // format sms = info nama tingkat
        // format sms 2 = info bayar 1

        $sql='
            SELECT inbox.ID, inbox.SenderNumber, inbox.TextDecoded, inbox.Processed 
            FROM inbox 
            WHERE inbox.Processed="false"';
        $hasil=$this->db->query($sql);
        foreach ($hasil->result() as $cek) {
            
            $id_sms = $cek->ID;
            $pengirim = $cek->SenderNumber;
            $isi_sms = strtoupper($cek->TextDecoded);
            $pecah_isi_sms = explode(" ", $isi_sms);

            if ($cek->Processed == "false") {
                if ($pecah_isi_sms[0] == "INFO" && $pecah_isi_sms[1] == "NAMA" && $pecah_isi_sms[2] == "TINGKAT") {
                    $sql1='SELECT DISTINCT(tingkat) FROM kelas';
                    $hasil1=$this->db->query($sql1);
                    $tampilkan = $hasil1->result();
                    $data=array();
                    foreach ($tampilkan as $tp) {
                        $data[] = $tp->tingkat;
                    }


                        $hasil_baca= implode(", ", $data);
                        $data_insert = array(
                            'DestinationNumber' => $pengirim,
                            'TextDecoded ' => "Nama Tingkat: ".$hasil_baca,
                        );
                        $this->db->insert('outbox',$data_insert);
                }
                
                elseif ($pecah_isi_sms[0] == "INFO" && $pecah_isi_sms[1] == "BAYAR") {
                    $sql2='
                        SELECT nama_bayar.nama_byr, jenis_bayar.biaya FROM jenis_bayar
                        LEFT JOIN nama_bayar ON jenis_bayar.id_namabyr=nama_bayar.id_namabyr
                        LEFT JOIN kelas ON jenis_bayar.id_kls=kelas.id_kls
                        WHERE kelas.tingkat="'.$pecah_isi_sms[2].'"
                    ';
                    $hasil2=$this->db->query($sql2);
                    $tampilkan2 = $hasil2->result();
                    $data2=array();
                    foreach ($tampilkan2 as $tp2) {
                        $data2[] = "(".$tp2->nama_byr."-Rp.".$tp2->biaya.")";
                    }

                        $hasil_baca2=implode(",", $data2);
                        $data_insert2 = array(
                            'DestinationNumber' => $pengirim,
                            'TextDecoded ' => $hasil_baca2,
                        );
                        $this->db->insert('outbox',$data_insert2);
                }

                elseif ($pecah_isi_sms[0] == "INFO" && $pecah_isi_sms[1] == "FORMAT" && $pecah_isi_sms[2] == "SMS") {
                		$data_insert2 = array(
                            'DestinationNumber' => $pengirim,
                            'TextDecoded ' => "INFO NAMA TINGKAT || INFO BAYAR NAMA_TINKAT (cth: INFO BAYAR 1)",
                        );
                        $this->db->insert('outbox',$data_insert2);
                }

                $this->db->set('Processed', 'true');
                $this->db->where('ID', $id_sms);
                $this->db->update('inbox');
            }
        }
    }
}
