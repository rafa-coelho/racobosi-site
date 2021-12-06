<?php

class DB
{
    private $host = "127.0.0.1", $db = DATABASE_NAME, $user = "root", $pass = "", $con;
    public $tabela, $where = "", $limit = "", $order = "";
    
    
    public function __construct($tabela){
        $this->tabela = $tabela;
        
        $this->con = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->con->connect_error)
            die("Connection failed: " . $this->con->connect_error);
    }
    
    public static function construct($tabela){
        return new self($tabela);
    }
    
    public function where($where = ""){
        $this->where = $where;
//        $this->where = $this->con->real_escape_string($where);
    }
    
    public function Count(){
        $where = (!empty($this->where)) ? "WHERE $this->where" : "";
        $rows = $this->con->query("SELECT * FROM $this->tabela $where");
        return (isset($rows->num_rows)) ? $rows->num_rows : 0;
    }
    
    public function order(){
		$args = func_get_args();
		$cmd = implode(', ', $args);
		$this->order = sprintf("ORDER BY %s",$cmd);
		return $this;
	}
    
    public function insert(){
        $colunas = "(";
        $valores = "(";
        $where = "";
        $c = 1;
        foreach($this as $k => $v){
            if($k == "host" or $k == "db" or $k == "user" or $k == "pass" or $k == "con" or $k == "tabela")
                continue;
            
            $c++;
            
            if($k == "where" or $k == "limit" or $k == "order")
                continue;
            
            
            $colunas .= $k;
            $valores .= "'" . htmlentities($v) . "'";
            
            
            $colunas .= ($c < objCount($this)) ? ", " : ")";
            $valores .= ($c < objCount($this)) ? ", " : ")";
        }
        
        $sql = "INSERT INTO $this->tabela $colunas VALUES $valores";
        return ($this->con->query($sql) === TRUE) ? true : false;
    }
    
    public function update(){
        $where = (!empty($this->where)) ? "WHERE $this->where" : "";
        $campos = "";
        $c = 0;
        foreach($this as $k => $v){
            
            if($k == "host" or $k == "db" or $k == "user" or $k == "pass" or $k == "con")
                continue;
            
            $c++;
            
            if($k == "where" or $k == "limit" or $k == "order" or $k == "tabela")
                continue;
            
            $campos .= "$k = '" . htmlentities((string) $v) . "'";
            $campos .= ($c < objCount($this)) ? ", " : "";
        }
        
        $sql = trim("UPDATE `$this->tabela` SET $campos $where");
        
        return ($this->con->query($sql) === TRUE) ? true : false;
    }
    
    public function delete(){
        $where = (!empty($this->where)) ? "WHERE $this->where" : "";
        $sql = "DELETE FROM $this->tabela $where";
        return ($this->con->query($sql) === TRUE) ? true : false;
    }
    
    public function all($campo = "*"){
        $where = (!empty($this->where)) ? "WHERE $this->where" : "";
        
        $query = "SELECT $campo FROM $this->tabela $where ";
        $query.= (!empty($this->limit)) ? "LIMIT $this->limit " : "";
        $query.= (!empty($this->order)) ? "$this->order " : "";
        
        $a = $this->con->query($query);
        $r = new stdClass();
        $c = 0;
        
        if(isset($a->num_rows) and $a->num_rows > 0)
            return $this->fetchObject($a);
        
        return $r;
    }
    
    public function get($campo = "*"){
        $where = (!empty($this->where)) ? "WHERE $this->where" : "";
        
        $query = "SELECT $campo FROM $this->tabela $where ";
        $query.= (!empty($this->limit)) ? "LIMIT $this->limit " : "";
        $query.= (!empty($this->order)) ? "$this->order " : "";
        $res = $this->con->query($query);
        
        if(is_array($res) and array_key_exists("0", $res)){
			return $res[0];
		} else {
			$o = $this->fetchObject($res);
			return (isset($o[0])) ? $o[0] : false;
		}
    }
    
    public function fetchObject($res){
		$oarray = array();

        while($o = mysqli_fetch_object($res)){
			$auxObject = new stdClass;
			foreach($o as $property => $value)
				$auxObject->{$property} = stripslashes(str_replace(array('\\r', '\\n'), array("\r", "\n"), $value));
							
			$oarray[] = $auxObject;
		}

        return $oarray;
	}
}