<? 
class Query_Encoder{

    private static $parts_genre = 
    ["cpu", "cpuc", "ram", "mb", "gpu", "ssd", "ssd2", "hdd", "psu", "pccase", "os"];
    private static $parts_array = array(
        "cpu"       =>0,
        "cpuc"      =>0,
        "ram"       =>0,
        "mb"        =>0,
        "gpu"       =>0,
        "ssd"       =>0,
        "ssd2"      =>0,
        "hdd"       =>0,
        "psu"       =>0,
        "pccase"    =>0,
        "os"        =>0
    );

    public function encode($old_query,$pcs)
    {
        return $this -> query_encoder($old_query,$pcs);
    }

    public function decode($new_query)
    {
        return $this -> query_decoder($new_query);
    }

    public function add_query($input_query,$select_query,$query_id=0,$query_pcs=1)
    {
        return $this -> query_editor($input_query,$select_query,$query_id,$query_pcs);
    }

    private function query_encoder($query,$pcs){
        $output = "";
        $n=0;
        if($query){

            if(!$pcs){
                $pcs = [1,1,1,1,1,1,1,1,1,1,1];
            }
            if(array_key_exists("genre",$query)){
                unset($query["genre"]);
            }

            foreach(self::$parts_genre as &$genre){
                if(array_key_exists($genre,$query)){
                    $output+=(($query[$genre])+1)."_".$pcs[$n]."|";
                }
                else{
                    $output+="0_".$pcs[$n]."|";
                }
            $n++;
            }
    }        
        echo "<script>console.log('.json_encode({$output})');</script>";
        return $output;
    }

    private function query_decoder($query){

        $n=0;
        $output_query = self::$parts_array;
        $genre_pcs = [1,1,1,1,1,1,1,1,1,1,1];

        if(array_key_exists("query",$query)){
            $query_text = $query["query"];
            $split_query_text = explode("|",$query_text);

            foreach($split_query_text as &$split){
                $id_pcs_split = explode("_",$split);
                $genre_pcs[$n] = intval($id_pcs_split[1]);
                $output_query[$n] = intval($$id_pcs_split[0])-1;
                $n++;
            }
            $string_genre_pcs = strval($genre_pcs);
            echo "<script>console.log('.json_encode(outQ={$output_query},outPCS={$string_genre_pcs})');</script>";
            return [$output_query,$genre_pcs];
        }
        else
        {
            return [$query,$genre_pcs];
        }
    }

    /*
    query_editor

    input 
    str encoded_query,parts_genre
    int input_parts_id,input_parts_pcs

    output
    str encoded_query
    */
    private function query_editor($encoded_query,$parts_genre,$input_parts_id=0,$input_parts_pcs = 1)
    {
        $decoded_query=$this -> query_decoder($encoded_query);
        $parts_array = $decoded_query[0];
        $parts_pcs=$decoded_query[1];

        $parts_array[$parts_genre] = $input_parts_id;
        $parts_pcs[array_search($parts_genre,self::$parts_genre)] = $input_parts_pcs;

        $output = $this -> query_encoder($parts_array,$parts_pcs);
        return $output;
    }
}

?>