<?php 
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

    private static $default_pcs = [1,1,1,1,1,1,1,1,1,1,1];

    public function encode($old_query,$pcs=0)
    {
        return $this -> query_encode($old_query,$pcs);
    }

    public function decode($new_query)
    {
        return $this -> query_decode($new_query);
    }

    public function edit_query($input_query,$select_query,$query_id=0,$query_pcs=1)
    {
        return $this -> query_editor($input_query,$select_query,$query_id,$query_pcs);
    }

    private function query_encode($query,$pcs){
        //in=array query,array pcs. out=str output.
        echo("<br>Q_ENC-1st varDump:");
        var_dump($query);
        //echo("<br>");
        //var_dump($pcs);
        //echo("<br>");

        $output = "";
        $n=0;
        if($query){

            if(!is_array($query)){parse_str($query,$query);}

            //var_dump ($query);
            if($pcs===0){
                $pcs = [1,1,1,1,1,1,1,1,1,1,1];
            }
            if(array_key_exists("genre",$query)){
                unset($query["genre"]);
            }

            foreach(self::$parts_genre as &$genre){
                if(array_key_exists($genre,$query)){
                    $output= $output . (intval($query[$genre])+1)."_".$pcs[$n]."|";
                }
                else{
                    $output= $output . "0_".$pcs[$n]."|";
                }
            $n++;
            }
            $output = rtrim($output,"|");
    }        
        //echo "<script>console.log('.json_encode({$output})');</script>";
        return $output;
    }

    private function query_decode($query){
        //input= str query[ex. query=22_1|20_...] output= array[1->query 2->pcs]
        if(!is_array($query))
        {
            try{
                parse_str($query,$query);
            }catch (Exception $ex)
            {
                return $ex;
            }
        }

        $n=0;
        $output_query = self::$parts_array;
        $genre_pcs = [1,1,1,1,1,1,1,1,1,1,1];
        $genre = self::$parts_genre;

        if(array_key_exists("query",$query)){
            $query_text = $query["query"];
            $split_query_text = explode("|",$query_text);

            foreach($split_query_text as &$split){
                $id_pcs_split = explode("_",$split);
                $genre_pcs[$n] = intval($id_pcs_split[1]);
                $output_query[$genre[$n]] = intval($id_pcs_split[0])-1;
                $n++;
            }
            $string_genre_pcs = strval($genre_pcs);
            //echo "<script>console.log('.json_encode(outQ={$output_query},outPCS={$string_genre_pcs})');</script>";
            return [$output_query,$genre_pcs];
        }
        else
        {
            return [$query,$genre_pcs];
        }
    }

    private function query_editor($encoded_query,$parts_genre,$input_parts_id=0,$input_parts_pcs = 1) 
    //in:Str encoded_query(ex,??_??|??_??|),Str genre(ex.cpu cpuc...),int ID,intPCS
    {
        $decoded_query=$this -> query_decode($encoded_query);
        $parts_array = $decoded_query[0];
        $parts_pcs=$decoded_query[1];

        $parts_array[$parts_genre] = $input_parts_id;
        $parts_pcs[array_search($parts_genre,self::$parts_genre)] = $input_parts_pcs;

        $output = $this -> query_encode($parts_array,$parts_pcs);
        return $output;
    }
}
?>