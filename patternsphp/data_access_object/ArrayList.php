<?php

declare(strict_types=1);

class ArrayList
{
    private $list = array();

    public function Add($obj)
    {
        array_push($this->list, $obj);
    }

    public function Remove($key)
    {
        if (array_key_exists($key, $this->list)) {
            unset($this->list[$key]);
        }
    }

    public function Size()
    {
        return count($this->list);
    }

    public function IsEmpty()
    {
        return empty($this->list);
    }

    public function GetObj($key)
    {
        if (array_key_exists($key, $this->list)) {
            return $this->list[$key];
        } else {
            return NULL;
        }
    }

    public function GetKey($obj)
    {
        $arrKeys = array_keys($this->list, $obj);

        if (empty($arrKeys)) {
            return -1;
        } else {
            return $arrKeys[0];
        }
    }  
}
