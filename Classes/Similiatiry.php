<?php
/**
 * Created by PhpStorm.
 * User: phi314
 * Date: 12/25/15
 * Time: 1:29 AM
 */

include "../koneksi.php";

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
        $q = mysql_query("SELECT * FROM reference_token");
        while($d = mysql_fetch_object($q))
        {
            array_push($this->array_token, $d->nama);
        }
    }

    public function set_stop_word()
    {
        $q = mysql_query("SELECT * FROM reference_stop_word");
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
        $string = strtolower($string);
        $step = str_replace($this->array_stop_word, " ", $string);
        $step = str_replace("  ", " ", $step);
        $step = str_replace("   ", " ", $step);
        $step = str_replace("    ", " ", $step);

        return $step;
    }

    public function stemming($string)
    {
        $array_stem = ['ter', 'nya', 'me', 'di'];
        $step = str_replace($array_stem, " ", $string);

        return $step;
    }

    public function clean($string)
    {
        $string = $this->tokenization($string);
        $string = $this->remove_stop_word($string);
        // $string = $this->stemming($string);

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
            $tf['df'] = $df;

            // ndf
            $ndf = ($count_dokumen - 1) / $df;
            $tf['n/df'] = $ndf;

            // idf
            $tf['idf'] = round(log10($ndf), 3);

            $array = [
                'term'  => $term,
                'tf'    => $tf
            ];

            $pembobotan[] = $array;
        }

        $this->pembobotan = $pembobotan;
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
            echo "<td>".$pembobotan['tf']['df']."</td>";
            echo "<td>".$pembobotan['tf']['n/df']."</td>";
            echo "<td>".$pembobotan['tf']['idf']."</td>";
            echo "</tr>";

        }
        echo "</tbody>";
        echo "</table>";
    }

    public function init()
    {
        /*
         * Clean OPL Baru
         */
        $clean_opl_baru = $this->clean($this->opl_baru);
        $this->array_string_opl[] = $clean_opl_baru;
        $word_opl_baru = explode(" ", $clean_opl_baru);
        $this->array_word_opl[] = $word_opl_baru;

        /*
         * Clean OPL Lama
         */
        foreach($this->array_opl_lama as $opl_lama)
        {
            $clean_opl_lama = $this->clean($opl_lama);
            $this->array_string_opl[] = $clean_opl_lama;
            $word_opl_lama = explode(" ", $clean_opl_lama);
            $this->array_word_opl[] = $word_opl_lama;
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

    public function run()
    {
        $this->pembobotan();
    }




}

$opl_lama = [];
$opl_baru = "Terdapat hasil print yang tidak bagus, tetapi di monitor menunjukan bahwa tinta masih ada. Caranya pastikan printer dalam kondisi menyala, kemudian jalankan Adjustment-Resetter. Setelah terbuka, pilih Particular adjustment mode. Selanjutnya pilih waste ink counter dan klik ok. Lalu klik check dan tunggu hingga form terisi.";
$opl_lama[] = "Hasil Print tidak OK karena tinta Magenta Habis, tetapi pada EPSON status monitor 3 Tinta Magenta masih ada. Pastikan printer dalam posisi nyala dan tersambung dengan komputer, jalankan Adjustment-Resetter Epson L200 dengan klik pada Adjprog.exe, setelah jendela EPSON adjustment program terbuka pilih Particular adjustment mode, pilih WASTE INK COUNTER untuk mereset waste ink printer dan klik OK. Setelah jendela Waste ink pada counter terbuka, maka klik check dan tunggu sampai form terisi";
$opl_lama[] = "Ketika kondisi hasil print kusut, maka coba lanjut cek pada lubang kertas printer. Karena dikhawatirkan terdapat benda asing yang tersangkut pada lubang printer tersebut. Jika ditemukan, maka caranya dikeluarkan";
$opl_lama[] = "Isikan IP Address atau MAC pada kolom connect, untuk Login diisi dengan admin dan password dikosongkan, lalu klik connect. Tampilan awal Winbox setelah sukses Login. Untuk memberi nama settingan mikrotik, masukan nama di kolom identity lalu klik apply dan ok";

$similiarity = new Similiatiry($opl_baru, $opl_lama);
$similiarity->run();

$similiarity->table_word_opl();
$similiarity->table_pembobotan();





