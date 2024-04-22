<? 
class Query_Encoder{

    private $parts_genre = ["cpu", "cpuc", "ram", "mb", "gpu", "ssd", "ssd2", "hdd", "psu", "pccase", "os"];

    public function query_encoding($query,$pcs){
        return $this -> query_encode($query,$pcs);

    }

    private function query_encode($query,$pcs){
        return "a";
    }

}



?>