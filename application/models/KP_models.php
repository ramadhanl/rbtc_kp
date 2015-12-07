<?php

class KP_models extends CI_Model {

   
   public function __construct()
   {
      // Call the CI_Model constructor
      parent::__construct();
   }

   public function load_data()
   {
      /*$this->db->distinct();
      $this->db->select('tahun');
      $this->db->order_by("df", "desc");
      $this->db->limit(10);*/
      $tags=$this->db->get('stki_top_tags')->result();
      $data = array('tags' => $tags);
      return $data;
   }

   public function taglist($tag,$tahun)
   {
      $sql=$this->db->get_where('stki_terms',array('term' =>$tag))->row();
      $id_term=$sql->id_term;
      $sql2=$this->db->get_where('stki_tf',array('id_term' =>$id_term));
      $i=0;
      foreach ($sql2->result() as $row) {
         $cek=$this->db->get_where('stki_data_kp',array('tahun'=>$tahun,'id_doc' =>$row->id_doc));
         if($cek->num_rows()!=0)
            $taglist[$i++]=$this->db->get_where('stki_data_kp',array('id_doc' =>$row->id_doc))->row();
         if($tahun==9999)
            $taglist[$i++]=$this->db->get_where('stki_data_kp',array('id_doc' =>$row->id_doc))->row();
      }
      return $taglist;
   }

   public function generate_tags()
   {
      $mtime = microtime(); 
      $mtime = explode(" ",$mtime); 
      $mtime = $mtime[1] + $mtime[0]; 
      $starttime = $mtime;
      ini_set('max_execution_time', 3600);
      require_once __DIR__.'/sastrawi/vendor/autoload.php';
      $tokenizerFactory  = new \Sastrawi\Tokenizer\TokenizerFactory();
      $tokenizer = $tokenizerFactory->createDefaultTokenizer();
      $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
      $stemmer  = $stemmerFactory->createStemmer();
      $sql = $this->db->get('stki_data_kp');
      $n = $sql->num_rows();
      foreach ($sql->result() as $row)
      {   
         //echo $row->judul."<br>";
         $tokens = $tokenizer->tokenize($this->stopword($this->correct_stem($stemmer->stem($this->get_compound_word(strtolower ($row->judul))))));
         $threshold=round(count($tokens),0);
         for ($i=1; $i<=$threshold; $i++)
            $total[$i]=-1;
         unset($tags);
         $tags[]=NULL;
         //echo "<br>".$threshold." - ".count($tokens)."|".$row->judul."<br>";
         foreach ($tokens as $token) {
            $sql2=$this->db->get_where('stki_terms',array('term' =>$token))->row();
            $status=1;
            if(isset($tags)){
               for ($i=1; $i<count($tags); $i++) {
                  if($tags[$i]==$token)
                     $status=0;
               }
            }
            $x=1;$i=1;
            if($sql2->df>4 && $status==1){
               for ($i=1; $i<=count($total); $i++) { 
                  if($sql2->df>$total[$i]){
                     $total[$i]=$sql2->df;
                     $tags[$i]=$token;
                     $i=99;
                  }
               }
            }
         }
         for ($i=1; $i<count($tags); $i++){
            if($i==1)
               $input_tags = $tags[$i];
            else
               $input_tags = $input_tags."_".$tags[$i];
         }
         $this->db->where('id_doc', $row->id_doc);
         $this->db->update('stki_data_kp',array('tags' => $input_tags));
      }

      //echo "Generate top tags All the time and per year";
      $this->db->empty_table('stki_top_tags');
      $this->db->empty_table('stki_tags_reference');
      //ALTER TABLE stki_top_tags AUTO_INCREMENT = 1
      $year_start = date("Y")-7;
      //echo $year_start."<br>";
      $year_finish = date("Y");
      for ($tahun=$year_start; $tahun<=$year_finish ; $tahun++) { 
         $this->db->empty_table('stki_terms_temp');
         $this->db->empty_table('stki_tf_temp');
         if ($tahun==$year_start)
            $sql=$this->db->get('stki_data_kp');
         else
            $sql=$this->db->get_where('stki_data_kp', array('tahun' => $tahun));
         foreach ($sql->result() as $row){
            $tag = explode("_", $row->tags);
            foreach ($tag as $key) {
               $sql2=$this->db->get_where('stki_terms_temp', array('term' => $key));
               if ($sql2->num_rows()==0) {
                  $this->db->insert('stki_terms_temp',array('term' => $key));
                  $sql3=$this->db->get_where('stki_terms_temp', array('term' => $key))->row();
                  $id_term=$sql3->id_term;
                  $this->db->insert('stki_tf_temp',array('id_term' => $id_term,'id_doc'=>$row->id_doc,'tf' => 1));
               }
               else{
                  $sql3=$this->db->get_where('stki_terms_temp', array('term' => $key))->row();
                  $id_term=$sql3->id_term;
                  $sql4 = $this->db->get_where('stki_tf_temp', array('id_term' => $id_term,'id_doc'=>$row->id_doc));
                  if($sql4->num_rows()==0)
                     $this->db->insert('stki_tf_temp',array('id_term' => $id_term,'id_doc'=>$row->id_doc,'tf' => 1));
                  //echo $id_term."-".$row->id_doc;
                  $sql4 = $this->db->get_where('stki_tf_temp', array('id_term' => $id_term,'id_doc'=>$row->id_doc))->row();
                  //var_dump($sql4);
                  $frequency = ($sql4->tf)+1;
                  $id = $sql4->id;
                  $data = array('id_term' => $id_term,'id_doc'=>$row->id_doc,'tf' => $frequency);
                  $this->db->where('id', $id);
                  $this->db->update('stki_tf_temp',array('tf' => $frequency));
               }
               //$sql3=$this->db->get_where('stki_tf', array('id_doc' => $row->id_doc,'id_term'=>$sql2->id_term));
            }
         }
         //echo "string";
         $query=$this->db->get('stki_terms_temp');
         foreach ($query->result() as $row){
            $id_term=$row->id_term;
            $query2 = $this->db->get_where('stki_tf_temp', array('id_term' => $id_term));
            $df=$query2->num_rows();
            $this->db->where('id_term', $id_term);
            $this->db->update('stki_terms_temp',array('df' => $df)); 
         }
         $this->db->order_by("df", "desc");
         $this->db->limit(20);
         $sql5=$this->db->get('stki_terms_temp');
         if ($tahun==$year_start)
            $year=9999;
         else
            $year=$tahun;
         foreach ($sql5->result() as $row2) {
            $data = array('tags' => $row2->term,
                        'df' => $row2->df,
                        'tahun' => $year);
            $this->db->insert('stki_top_tags', $data);
         }
         //echo $tahun;
      }


      $mtime = microtime(); 
      $mtime = explode(" ",$mtime); 
      $mtime = $mtime[1] + $mtime[0]; 
      $endtime = $mtime; 
      $totaltime = ($endtime - $starttime);
      echo $totaltime;
   }

   public function search($query)
   {
      $mtime = microtime(); 
      $mtime = explode(" ",$mtime); 
      $mtime = $mtime[1] + $mtime[0]; 
      $starttime = $mtime; 
      require_once __DIR__.'/sastrawi/vendor/autoload.php';
      $tokenizerFactory  = new \Sastrawi\Tokenizer\TokenizerFactory();
      $tokenizer = $tokenizerFactory->createDefaultTokenizer();
      $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
      $stemmer  = $stemmerFactory->createStemmer();
      $tokens = $tokenizer->tokenize($this->stopword($this->correct_stem($stemmer->stem($this->get_compound_word(strtolower ($query))))));
      $this->db->empty_table('stki_search_results');
      $search_results[] = NULL;
      //Mencari term frequency
      $i=1;$count=0;
      foreach ($tokens as $token) {
         $double=0;
         for ($x=$i-1; $x>0 ; $x--) { 
            if($token==$qterm[$x]){
               $qtf[$x]++;
               $double=1;
            }
         }
         if($double==0){
            $qterm[$i]=$token;
            $qtf[$i]=1;
            $i++;
         }
         $sql=$this->db->get_where('stki_terms', array('term' => $token));
         foreach ($sql->result() as $row){
            $count++;
         }
      }
      $total_term=$i;
      //Scoring Document
      $sql=$this->db->get('stki_data_kp');
      $y=1;
      if($count!=0){
      foreach ($sql->result() as $row){
         $total_qtfidf=0;$total_dtfidf=0;$dot_product=0;
         for ($x=1; $x<$total_term; $x++) { 
            //Query Vector
            $normalized_qtf[$x]=$qtf[$x]/$total_term;
            //echo "<h3>".$qterm[$x]."</h3>tf : ".$qtf[$x]."<br>ntf : ".$normalized_qtf[$x]."<br>idf : ";
            $sql1=$this->db->get_where('stki_terms', array('term' => $qterm[$x]));
            $count=0;
            foreach ($sql1->result() as $row1){
               $idf[$x]=$row1->idf;$count++;$id_term=$row1->id_term;}
            if ($count==0)
               $idf[$x]=0;
            $qtfidf[$x]=$normalized_qtf[$x]*$idf[$x];
            //echo $idf[$x]."<br>tf*idf : ".$qtfidf[$x];
            $total_qtfidf=$total_qtfidf+($qtfidf[$x]*$qtfidf[$x]);

            //Document Vector
            $sql2=$this->db->get_where('stki_tf', array('id_doc' => $row->id_doc,'id_term' => $id_term));
            $count=0;
            foreach ($sql2->result() as $row2){
               $normalized_dtf[$x]=$row2->normalized_tf;$count++;
            }
            if ($count==0)
               $normalized_dtf[$x]=0;
            $dtfidf[$x]=$normalized_dtf[$x]*$idf[$x];
            $total_dtfidf+=($dtfidf[$x]*$dtfidf[$x]);
            $dot_product+=$dtfidf[$x]*$qtfidf[$x];
         }
         $dquery = sqrt($total_qtfidf);
         $ddocument = sqrt($total_dtfidf);
         if($dquery==0 || $ddocument==0){
            $score[$y]=$dot_product/0.001;
         }
         else
            $score[$y]=$dot_product/($dquery * $ddocument);
         if($score[$y]>0){
            $search_results[]=array('id_doc' => $row->id_doc,'judul' => $row->judul,'tags' => $row->tags,'penulis' => $row->penulis,'tahun' => $row->tahun,'score'=> $score[$y]);
            //$search_results[$row->id_doc]=$data;
         }
         $y++;
      }}
      foreach ($search_results as $key => $row)
          $scores[$key]  = $row['score'];
      array_multisort($scores, SORT_DESC, $search_results);
      //var_dump($search_results);
      $mtime = microtime(); 
      $mtime = explode(" ",$mtime); 
      $mtime = $mtime[1] + $mtime[0]; 
      $endtime = $mtime; 
      $totaltime = ($endtime - $starttime);
      //echo $totaltime."<br>";
      $data = array('totaltime' => $totaltime,'search_results'=> $search_results);
      return $data;
   }
   
   public function calculate_tfidf()
   {
      //Fungsi ini digunakan untuk preprocessing data kp
      ini_set('max_execution_time', 3600);
      require_once __DIR__.'/sastrawi/vendor/autoload.php';
      $tokenizerFactory  = new \Sastrawi\Tokenizer\TokenizerFactory();
      $tokenizer = $tokenizerFactory->createDefaultTokenizer();
      $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
      $stemmer  = $stemmerFactory->createStemmer();
      $mtime = microtime(); 
      $mtime = explode(" ",$mtime); 
      $mtime = $mtime[1] + $mtime[0]; 
      $starttime = $mtime; 
      $this->load->database('kp');
      $this->db->empty_table('stki_tf'); 
      $this->db->empty_table('stki_terms'); 
      $sql = $this->db->get('stki_data_kp');
      $n = $sql->num_rows();
      //Menghitung term frequency tiap term pada judul kp
      foreach ($sql->result() as $row)
      {       
         $id_doc = $row->id_doc;
         $tokens = $tokenizer->tokenize($this->stopword($this->correct_stem($stemmer->stem($this->get_compound_word(strtolower ($row->judul))))));
         foreach ($tokens as $token) {
            if(strlen($token)!==0){
               $sql2=$this->db->get_where('stki_terms', array('term' => $token));
               if($sql2->num_rows()==0){
                  $this->db->insert('stki_terms', array('term' => $token));
                  $term=$this->db->get_where('stki_terms', array('term' => $token))->row();
                  $id_term=$term->id_term;
                  $this->db->insert('stki_tf', array('id_term' => $id_term,'id_doc'=>$id_doc,'tf' => 1,'normalized_tf'=> 1/count($tokens)));
               }
               else{
                  $term=$this->db->get_where('stki_terms', array('term' => $token))->row();
                  $id_term=$term->id_term;
               }
               $sql3 = $this->db->get_where('stki_tf', array('id_term' => $id_term,'id_doc'=>$id_doc));
               if($sql3->num_rows()==0)
                  $this->db->insert('stki_tf', array('id_term' => $id_term,'id_doc'=>$id_doc,'tf' => 1,'normalized_tf'=> 1/count($tokens)));
               else{
                  $sql4 = $this->db->get_where('stki_tf', array('id_term' => $id_term,'id_doc'=>$id_doc))->row();
                  $frequency = $sql4->tf;
                  $id = $sql4->id;
                  $this->db->where('id', $id);
                  $this->db->update('stki_tf',array('id_term' => $id_term,'id_doc'=>$id_doc,'tf' => ++$frequency,'normalized_tf'=> ++$frequency/count($tokens))); 
               }
            }
         }
         //echo 'Selesai mengolah : "'.$judul.'"(id_doc : '.$id_doc.')<br>';
      }
      //Menghitung df dan idf
      $sql=$this->db->get('stki_terms');
      foreach ($sql->result() as $row){
         $sql2 = $this->db->get_where('stki_tf', array('id_term' => $row->id_term));
         //echo "id_term : ".$id_term."<br>";
         $this->db->where('id_term', $row->id_term);
         $this->db->update('stki_terms', array('df' => $sql2->num_rows(),'idf' => log($n/$sql2->num_rows()))); 
      }
      /*$sql=$this->db->get('stki_data_kp');
      foreach ($sql->result() as $row) {
         //echo "<h1>update normalized_tf for id_doc : ".$row->id_doc."</h1><br>";
         $sql2=$this->db->get_where('stki_tf', array('id_doc' => $row->id_doc));
         foreach ($sql2->result() as $row2) {
            $this->db->where('id', $row2->id);
            $this->db->update('stki_tf',array('normalized_tf' => $row2->tf/$sql2->num_rows()));
            //echo "id_term : ".$row2->id_term."<br>";
         }
      }*/
      $mtime = microtime(); 
      $mtime = explode(" ",$mtime); 
      $mtime = $mtime[1] + $mtime[0]; 
      $endtime = $mtime; 
      $totaltime = ($endtime - $starttime);
      echo $totaltime;
   }

   public function stopword($kalimat)
   {
      $liststopword = array(" 2010 "," - "," it ","tbk"," n ","ii "," ru "," com "," e ","3 "," is "," v "," bas ","pt ","guna "," and "," untuk ","berbasis ","adanya ","adalah ","adapun ","agak ","agaknya ","agar ","akan ","akankah ","akhirnya ","akulah ","amat ","amatlah ","anda ","andalah ","antar ","diantaranya ","antara ","antaranya ","diantara ","apaan ","mengapa ","apabila ","apakah ","apalagi ","apatah ","atau ","ataukah ","ataupun ","bagai ","bagaikan ","sebagai ","sebagainya ","bagaimana ","bagaimanapun ","sebagaimana ","bagaimanakah ","bagi ","bahkan ","bahwa ","bahwasanya ","sebaliknya ","banyak ","sebanyak ","beberapa ","seberapa ","begini ","beginian ","beginikah ","beginilah ","sebegini ","begitu ","begitukah ","begitulah ","begitupun ","sebegitu ","belum ","belumlah ","sebelum ","sebelumnya ","sebenarnya ","berapa ","berapakah ","berapalah ","berapapun ","betulkah ","sebetulnya ","biasa ","biasanya ","bila ","bilakah ","bisa ","bisakah ","sebisanya ","boleh ","bolehkah ","bolehlah ","buat ","bukan ","bukankah ","bukanlah ","bukannya ","cuma ","percuma ","dahulu ","dalam ","dan ","dapat ","dari ","daripada ","dekat ","demi ","demikian ","demikianlah ","sedemikian ","dengan ","depan ","di ","dia ","dialah ","dini ","diri ","dirinya ","terdiri ","dong ","dulu ","enggak ","enggaknya ","entah ","entahlah ","terhadap ","terhadapnya ","hal ","hampir ","hanya ","hanyalah ","harus ","haruslah ","harusnya ","seharusnya ","hendak ","hendaklah ","hendaknya ","hingga ","sehingga ","ialah ","ibarat ","ingin ","inginkah ","inginkan ","ini ","inikah ","inilah ","itu ","itukah ","itulah ","jangan ","jangankan ","janganlah ","jika ","jikalau ","juga ","justru ","kala ","kalau ","kalaulah ","kalaupun ","kalian ","kami ","kamilah ","kamu ","kamulah ","kapan ","kapankah ","kapanpun ","dikarenakan ","karena ","karenanya ","kecil ","kemudian ","kenapa ","kepada ","kepadanya ","ketika ","seketika ","khususnya ","kinilah ","kiranya ","sekiranya ","kita ","kitalah ","lagi ","lagian ","selagi ","lain ","lainnya ","melainkan ","selaku ","lalu ","melalui ","terlalu ","lama ","lamanya ","selama ","selama ","selamanya ","lebih ","terlebih ","bermacam ","macam ","semacam ","maka ","makanya ","makin ","malah ","malahan ","mampu ","mampukah ","mana ","manakala ","manalagi ","masih ","masihkah ","semasih ","masing ","maupun ","semaunya ","memang ","mereka ","merekalah ","meski ","meskipun ","semula ","mungkin ","mungkinkah ","namun ","nanti ","nantinya ","nyaris ","oleh ","olehnya ","seorang ","seseorang ","pada ","padanya ","padahal ","paling ","sepanjang ","pantas ","sepantasnya ","sepantasnyalah ","pasti ","pastilah ","pernah ","pula ","merupakan ","rupanya ","serupa ","saat ","saatnya ","sesaat ","saja ","sajalah ","saling ","bersama ","sama ","sesama ","sambil ","sampai ","sana ","sangat ","sangatlah ","saya ","sayalah ","sebab ","sebabnya ","sebuah ","tersebut ","tersebutlah ","sedang ","sedangkan ","sedikit ","sedikitnya ","segala ","segalanya ","segera ","sesegera ","sejak ","sejenak ","sekali ","sekalian ","sekalipun ","sesekali ","sekaligus ","sekarang ","sekarang ","sekitar ","sekitarnya ","sela ","selain ","selalu ","seluruh ","seluruhnya ","semakin ","sementara ","sempat ","semua ","semuanya ","sendiri ","sendirinya ","seolah ","seperti ","sepertinya ","sering ","seringnya ","serta ","siapa ","siapakah ","siapapun ","disini ","disinilah ","sini ","sinilah ","sesuatu ","sesuatunya ","suatu ","sesudah ","sesudahnya ","sudah ","sudahkah ","sudahlah ","supaya ","tadi ","tadinya ","tanpa ","setelah ","telah ","tentang ","tentu ","tentulah ","tentunya ","tertentu ","seterusnya ","tapi ","tetapi ","setiap ","tiap ","setidaknya ","tidak ","tidakkah ","tidaklah ","waduh ","wahai ","sewaktu ","walau ","walaupun ","yaitu ","yakni ","yang ",". ",",");
      $hasil = str_ireplace($liststopword, "", $kalimat);
      return $hasil;
   }

   public function get_compound_word($phrase)
   {
      $tokens = array("pln(persero)","sistem informasi", "rancang bangun", "sms gateway","jawa timur","teknologi informasi", "sistem manajemen","human resource");
      $compounds   = array("pln","sisteminformasi", "rancangbangun", "smsgateway","jawatimur","teknologiinformasi","sistemmanajemen","humanresource");
      return str_replace($tokens, $compounds, $phrase);
   }

   public function correct_stem($phrase)
   {
      $tokens = array("bal","mitra","jaring","langgan"," net ","lapor","kembang");
      $compounds   = array("bali","mitrais","jaringan","pelanggan"," dotnet ","laporan","pengembangan");
      return str_replace($tokens, $compounds, $phrase);
   }

   public function tes($phrase)
   {
      require_once __DIR__.'/sastrawi/vendor/autoload.php';
      $tokenizerFactory  = new \Sastrawi\Tokenizer\TokenizerFactory();
      $tokenizer = $tokenizerFactory->createDefaultTokenizer();
      $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
      $stemmer  = $stemmerFactory->createStemmer();
      echo strtolower($phrase)."<br>".$this->get_compound_word(strtolower ($phrase))."<br>".$stemmer->stem($this->get_compound_word(strtolower ($phrase)))."<br>";
      echo "(stopword)".$this->stopword($this->correct_stem($stemmer->stem($this->get_compound_word(strtolower ($phrase)))))."<br>";
      $tokens = $tokenizer->tokenize($this->stopword($this->correct_stem($stemmer->stem($this->get_compound_word(strtolower ($phrase))))));
         foreach ($tokens as $token)
            echo $token."<br>";
   }
}
?>