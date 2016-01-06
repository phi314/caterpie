<?php
/**
 * Created by PhpStorm.
 * User: phi314
 * Date: 12/25/15
 * Time: 1:29 AM
 */

include "../koneksi.php";
include "stemming.php";

class Similiatiry {

    var $array_token = [];
    var $array_stop_word = [];

    var $opl_baru;
    var $array_opl_lama;

    var $array_clean_opl_lama = [];

    var $array_word_opl;
    var $array_string_opl;

    var $word_opl;

    var $pembobotan;

    public function __construct($opl_baru, $array_opl_lama)
    {
        $this->opl_baru = $opl_baru;
        $this->array_opl_lama = $array_opl_lama;
        $this->set_token();
        $this->set_stop_word();


        $this->init();
    }

    public function get_all_opl_to_string()
    {
        echo "OPL BARU<br>";
        echo $this->opl_baru;
        echo "<br>---------------------<br>";
        foreach($this->array_opl_lama as $var => $opl_lama)
        {
            echo "OPL LAMA $var <br>";
            echo $opl_lama;
            echo "<br>---------------------<br>";
        }

    }

    public function set_token()
    {
        $q = mysql_query("SELECT * FROM ref_token");
        while($d = mysql_fetch_object($q))
        {
            array_push($this->array_token, $d->nama);
        }
    }

    public function set_stop_word()
    {
        $q = mysql_query("SELECT * FROM ref_stop_word");
        while($d = mysql_fetch_object($q))
        {
            array_push($this->array_stop_word, $d->nama);
        }
    }

    public function table_token()
    {
        echo "Table Token<br>";
        echo "<table><tbody>";

        foreach($this->array_token as $token)
        {
            echo "<tr><td>".$token."</td></tr>";
        }


        echo "</tbody></table";
    }

    public function tokenization($string)
    {
        $step = str_replace($this->array_token, " ", $string);
        $step = str_replace(" ", " ", $step);

        return $step;
    }

    public function remove_stop_word($string)
    {
        $step = strtolower($string);
        $step = preg_replace('/\b('.implode('|',$this->array_stop_word).')\b/','',$step);


        $step = str_replace("  ", " ", $step);
        $step = str_replace("   ", " ", $step);
        $step = str_replace("    ", " ", $step);

        return $step;
    }

    public function stemming($string)
    {
        return stemming($string);
    }

    public function clean($string)
    {
        $string = $this->tokenization($string);
        $string = $this->remove_stop_word($string);

        return $string;
    }

    public function pembobotan()
    {
        $pembobotan = [];
        sort($this->word_opl, SORT_STRING);

        $count_dokumen = count($this->array_word_opl);
        foreach($this->word_opl as $key => $term)
        {
            $tf = [];
            $w = [];
            $tf['q'] = $this->count_word_in_string($term, $this->array_word_opl[0]);

            $df = 0;
            for($i = 1; $i < $count_dokumen; $i++)
            {
                $count_word = $this->count_word_in_string($term, $this->array_word_opl[$i]);

                // dokumen n+1
                $tf['d'.$i] = $count_word;
                if($count_word > 0)
                {
                    $df++;
                }

            }

            // df
            $df = $df == 0 ? 1 : $df;

            // ndf
            $ndf = ($count_dokumen - 1) / $df;

            // idf
            $idf = round(log10($ndf), 3);

            $w['q'] = $tf['q'] * $idf;
            for($i_w = 1; $i_w < $count_dokumen; $i_w++)
            {
                $w['d'.$i_w] = $tf['d'.$i_w] * $idf;
            }

            $vektor = [];
            $vektor['q2'] = $w['q'] * $w['q'];
            $vektor['q2'] = round($vektor['q2'], 3);
            for($i_vektor = 1; $i_vektor < $count_dokumen; $i_vektor++)
            {
                $vektor['d2'.$i_vektor] = $w['d'.$i_vektor] * $w['d'.$i_vektor];
                $vektor['d2'.$i_vektor] = round($vektor['d2'.$i_vektor], 3);


            }

            $similaritas = [];
            for($i_similaritas = 1; $i_similaritas < $count_dokumen; $i_similaritas++)
            {
                $similaritas['qd'.$i_similaritas] = $w['q'] * $w['d'.$i_similaritas];
                $similaritas['qd'.$i_similaritas] = round($similaritas['qd'.$i_similaritas], 3);
            }


            $array = [
                'term'  => $term,
                'tf'    => $tf,
                'df'    => $df,
                'n/df'    => $ndf,
                'idf'    => $idf,
                'w'     => $w,
                'vektor' => $vektor,
                'similaritas' => $similaritas
            ];

            $pembobotan[] = $array;
        }

        $this->pembobotan = $pembobotan;


        $jumlah_vektor = 0;
        foreach($pembobotan as $vektor)
        {
            $jumlah_vektor += $vektor['vektor']['q2'];
        }
        $this->pembobotan['jumlah_vektor_q'] = $jumlah_vektor;
        $this->pembobotan['akar_jumlah_vektor_q'] = sqrt($jumlah_vektor);


        for($i_jumlah_vektor = 1; $i_jumlah_vektor < $count_dokumen; $i_jumlah_vektor++)
        {
            $jumlah_vektor = 0;
            foreach($pembobotan as $vektor)
            {
                $jumlah_vektor += $vektor['vektor']['d2'.$i_jumlah_vektor];
            }
            $this->pembobotan['jumlah_vektor_d'.$i_jumlah_vektor] = $jumlah_vektor;
            $this->pembobotan['akar_jumlah_vektor_d'.$i_jumlah_vektor] = sqrt($jumlah_vektor);
        }

        for($i_jumlah_similaritas = 1; $i_jumlah_similaritas < $count_dokumen; $i_jumlah_similaritas++)
        {
            $jumlah_similaritas = 0;
            foreach($pembobotan as $similaritas)
            {
                $jumlah_similaritas += $similaritas['similaritas']['qd'.$i_jumlah_similaritas];
            }
            $this->pembobotan['jumlah_similaritas_qd'.$i_jumlah_similaritas] = $jumlah_similaritas;
            $this->pembobotan['akar_jumlah_similaritas_qd'.$i_jumlah_similaritas] = sqrt($jumlah_similaritas);
        }


    }

    public function count_word_in_string($word, $array_word_opl)
    {
        $array = array_count_values($array_word_opl);
        return !empty($array[$word]) ? $array[$word] : 0;
    }

    public function table_word_opl()
    {
        echo "<table>";
        echo "<thead>";
        echo "<tr><td>OPL BARU</td>";
        $no = 1;
        for($i = 0; $i < count($this->array_opl_lama); $i++)
        {

            echo "<td style='display: table-cell'>OPL KE ".$no++."</td>";

        }
        echo "<tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach($this->array_word_opl as $word_opl)
        {

            echo "<tr style='display: table-cell'>";
            foreach($word_opl as $word)
            {
                echo "<td style='display: table-row'>$word</td>";
            }
            echo "</tr>";

        }
        echo "</tbody>";
        echo "</table>";

    }

    public function table_pembobotan()
    {
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<td>Term</td>";
        echo "<td>q</td>";
        echo "<td>d1</td>";
        echo "<td>d2</td>";
        echo "<td>d3</td>";
        echo "<td>df</td>";
        echo "<td>N/df</td>";
        echo "<td>idf</td>";
        echo "<td>q</td>";
        echo "<td>d1</td>";
        echo "<td>d2</td>";
        echo "<td>d3</td>";
        echo "<td>vq2</td>";
        echo "<td>vd12</td>";
        echo "<td>vd22</td>";
        echo "<td>vd32</td>";
        echo "<td>sqd1</td>";
        echo "<td>sqd2</td>";
        echo "<td>sqd3</td>";
        echo "<tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach($this->pembobotan as $pembobotan)
        {
            echo "<tr>";
            echo "<td>".$pembobotan['term']."</td>";
            echo "<td>".$pembobotan['tf']['q']."</td>";
            echo "<td>".$pembobotan['tf']['d1']."</td>";
            echo "<td>".$pembobotan['tf']['d2']."</td>";
            echo "<td>".$pembobotan['tf']['d3']."</td>";
            echo "<td>".$pembobotan['df']."</td>";
            echo "<td>".$pembobotan['n/df']."</td>";
            echo "<td>".$pembobotan['idf']."</td>";
            echo "<td>".$pembobotan['w']['q']."</td>";
            echo "<td>".$pembobotan['w']['d1']."</td>";
            echo "<td>".$pembobotan['w']['d2']."</td>";
            echo "<td>".$pembobotan['w']['d3']."</td>";
            echo "<td>".$pembobotan['vektor']['q2']."</td>";
            echo "<td>".$pembobotan['vektor']['d21']."</td>";
            echo "<td>".$pembobotan['vektor']['d22']."</td>";
            echo "<td>".$pembobotan['vektor']['d23']."</td>";
            echo "<td>".$pembobotan['similaritas']['qd1']."</td>";
            echo "<td>".$pembobotan['similaritas']['qd2']."</td>";
            echo "<td>".$pembobotan['similaritas']['qd3']."</td>";
            echo "</tr>";

        }
        echo "</tbody>";
        echo "<tfoot>";
        echo "<tr>";
        echo "<td colspan='12'></td>";
        echo "<td colspan=''>".$this->pembobotan['jumlah_vektor_q']."</td>";
        echo "<td colspan=''>".$this->pembobotan['jumlah_vektor_d1']."</td>";
        echo "<td colspan=''>".$this->pembobotan['jumlah_vektor_d2']."</td>";
        echo "<td colspan=''>".$this->pembobotan['jumlah_vektor_d3']."</td>";
        echo "<td colspan=''>".$this->pembobotan['jumlah_vektor_d4']."</td>";
        echo "<td colspan=''>".$this->pembobotan['jumlah_similaritas_qd1']."</td>";
        echo "<td colspan=''>".$this->pembobotan['jumlah_similaritas_qd2']."</td>";
        echo "<td colspan=''>".$this->pembobotan['jumlah_similaritas_qd3']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td colspan='12'></td>";
        echo "<td colspan=''>".$this->pembobotan['akar_jumlah_vektor_q']."</td>";
        echo "<td colspan=''>".$this->pembobotan['akar_jumlah_vektor_d1']."</td>";
        echo "<td colspan=''>".$this->pembobotan['akar_jumlah_vektor_d2']."</td>";
        echo "<td colspan=''>".$this->pembobotan['akar_jumlah_vektor_d3']."</td>";
        echo "<td colspan=''>".$this->pembobotan['akar_jumlah_similaritas_qd1']."</td>";
        echo "<td colspan=''>".$this->pembobotan['akar_jumlah_similaritas_qd2']."</td>";
        echo "<td colspan=''>".$this->pembobotan['akar_jumlah_similaritas_qd3']."</td>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table>";
    }

    public function init()
    {
        /*
         * Clean OPL Baru
         */
        $array_baru = [];
        $clean_opl_baru = $this->clean($this->opl_baru);
        $this->array_string_opl[] = $clean_opl_baru;
        $word_opl_baru = explode(" ", $clean_opl_baru);
        foreach($word_opl_baru as $word_baru)
        {
            $array_baru[] = stemming($word_baru) == null ? $word_baru : stemming($word_baru);
        }

        $this->array_word_opl[] = $array_baru;

        /*
         * Clean OPL Lama
         */
        foreach($this->array_opl_lama as $opl_lama)
        {
            $array_lama = [];
            $clean_opl_lama = $this->clean($opl_lama);
            $this->array_string_opl[] = $clean_opl_lama;
            $word_opl_lama = explode(" ", $clean_opl_lama);
            foreach($word_opl_lama as $word_lama)
            {
                $array_lama[] = stemming($word_lama) == null ? $word_lama : stemming($word_lama);
            }

            $this->array_word_opl[] = $array_lama;
        }

        foreach($this->array_word_opl as $word_opl)
        {
            foreach($word_opl as $word)
            {
                $this->word_opl[] = $word;
            }
        }

        $this->word_opl = array_unique($this->word_opl);
        $this->word_opl = array_filter($this->word_opl);
    }

    public function similaritas()
    {
        $count_dokumen = count($this->array_word_opl);
        for($i_jumlah_similaritas = 1; $i_jumlah_similaritas < $count_dokumen; $i_jumlah_similaritas++)
        {
            $eqd = $this->pembobotan['jumlah_vektor_q'] * $this->pembobotan['jumlah_vektor_d'.$i_jumlah_similaritas];
            if($eqd == 0)
                $jumlah_similaritas = 0;
            else
                $jumlah_similaritas = $this->pembobotan['jumlah_similaritas_qd'.$i_jumlah_similaritas] / (($this->pembobotan['jumlah_vektor_q'] * $this->pembobotan['jumlah_vektor_d'.$i_jumlah_similaritas]));

            $jumlah_similaritas = round($jumlah_similaritas, 3);
            $this->pembobotan['similaritas']['d'.$i_jumlah_similaritas] = $jumlah_similaritas;


            $this->pembobotan['similaritas']['persentase_d'.$i_jumlah_similaritas] = $jumlah_similaritas*1000;
        }
    }

    public function run()
    {
        $this->pembobotan();
        $this->similaritas();
    }




}

$opl_lama = [];
$opl_baru = "Terdapat hasil print yang tidak bagus, tetapi di monitor menunjukan bahwa tinta masih ada. Caranya pastikan printer dalam kondisi menyala, kemudian jalankan Adjustment-Resetter. Setelah terbuka, pilih Particular adjustment mode. Selanjutnya pilih waste ink counter dan klik ok. Lalu klik check dan tunggu hingga form terisi.";
$opl_lama[] = "Hasil Print tidak OK karena tinta Magenta Habis, tetapi pada EPSON status monitor 3 Tinta Magenta masih ada. Pastikan printer dalam posisi nyala dan tersambung dengan komputer, jalankan Adjustment-Resetter Epson L200 dengan klik pada Adjprog.exe, setelah jendela EPSON adjustment program terbuka pilih Particular adjustment mode, pilih WASTE INK COUNTER untuk mereset waste ink printer dan klik OK. Setelah jendela Waste ink pada counter terbuka, maka klik check dan tunggu sampai form terisi";
$opl_lama[] = "Ketika kondisi hasil print kusut, maka coba lanjut cek pada lubang kertas printer. Karena dikhawatirkan terdapat benda asing yang tersangkut pada lubang printer tersebut. Jika ditemukan, maka caranya dikeluarkan";
$opl_lama[] = "Isikan IP Adress atau MAC pada kolom connect, untuk Login diisi dengan admin dan password dikosongkan, lalu klik connect. Tampilan awal Winbox setelah sukses Login. Untuk memberi nama settingan mikrotik, masukan nama di kolom identity lalu klik apply dan ok";




//$q = mysql_query("SELECT * FROM opl WHERE tema_opl='printer'");
//while($data = mysql_fetch_object($q))
//{
//    $no_opl = $data->no_opl_temp;
//    $q_d = mysql_query("SELECT * FROM detail_opl WHERE no_opl_temp='$no_opl'");
//
//    while($data_q = mysql_fetch_object($q_d))
//    {
//        $opl_lama[] = $data_q->keterangan;
//    }
//
//}
//dump($opl_lama);

$similiarity = new Similiatiry($opl_baru, $opl_lama);
$similiarity->run();

dump($similiarity->pembobotan['similaritas']);





