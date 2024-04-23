<? 
class Query_Encoder{

    private static $parts_genre = ["cpu", "cpuc", "ram", "mb", "gpu", "ssd", "ssd2", "hdd", "psu", "pccase", "os"];
    private static $parts_array = array(
        "cpu" =>array(0,0),
        "cpuc" =>array(0,0),
        "ram" =>array(0,0),
        "mb" =>array(0,0),
        "gpu" =>array(0,0),
        "ssd" =>array(0,0),
        "ssd2" =>array(0,0),
        "hdd" =>array(0,0),
        "psu" =>array(0,0),
        "pccase" =>array(0,0),
        "os" =>array(0,0)
    );

    public function encode($old_query,$pcs)
    {
        return $this -> query_encoder($old_query,$pcs);
    }

    public function decode($new_query)
    {
        return $this -> query_decoder($new_query);
    }

    private function query_encoder($query,$pcs){
        $output = "";
        $n=0;
        if($query){

            if(!$pcs){
                $pcs = [1,1,1,1,1,1,1,1,1,1,1];
            }
            
            foreach(this::$parts_genre as &$genre){
                if(array_key_exists($genre,$query)){
                    $output+=$query[$genre]."-".$pcs[$n]."_";
                }
                else{
                    $output+="0-".$pcs[$n]."_";
                }
            $n++;
            }
    }        
        echo "<script>console.log('.json_encode({$output})');</script>";
        return $output;
    }

    private function query_decoder($query){


            if(array_key_exists($query,this::$parts_genre)){

            foreach(this::$parts_genre as &$genre){
                

            }
        }
    }

}



?>