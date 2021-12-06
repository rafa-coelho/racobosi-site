<?php

class Classes
{
    
    
    public function __construct($w = null){
        if(is_string($w)){
            $this->where = $w;
            return $this->Get();
        }

        if(!is_null($w))
            $this->construct($w);

    }
        
}