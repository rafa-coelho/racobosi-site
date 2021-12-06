<?php


class Rest{

    private $url, $method;

    public function __construct($url, $method = "POST"){
        $this->url = API.$url;
        $this->method = $method;
    }

    public static function parseJson($obj){
        $json = '';
        if(is_array($obj) or is_object($obj)){
            $json .= '{';
            $json .= self::loop($obj);
            $json .= '}';
        }
        return $json;
    }

    private static function loop($obj, $sub = false){
        $json = '';
        $c = 1;

        foreach($obj as $k => $v){
            $val = (is_array($obj)) ? $obj[$k] : $obj->{$k};

            if(!is_array($v) and !is_object($v)){
                $json .= '"'. $k . '": "'.$v.'"';
            }else{
                if(!$sub)
                    $json .= '"'.$k.'": ';

                if(is_array($v)){
                    $json .= '[';
                    $json .= self::loop($v, true);
                    $json .= ']';
                }else{
                    $json .= '{';
                    $json .= self::loop($v);
                    $json .= '}';
                }
            }

            if($c < objCount($obj))
                $json .= ',';

            $c++;
        }
        return $json;
    }

    public function Request($j = false){
        $curl = curl_init();
        $data = array();
        $url = $this->url;

        foreach($this as $k => $v){
            if($k != "url" and $k != "method")
                $data[$k] = $v;
        }

        

        switch ($this->method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return ($j) ? $result : json_decode($result);
    }

}
