<?php

namespace App\Lib;

class CompositeProject implements IComposite
{
    private $el = null;
    private $subList = null;

    public function __construct($el)
    {
        $this->el = $el;
        $this->subList = collect();
    }
    public function add($key, $el)
    {
        $this->subList[$key] = $el;
    }
    public function save()
    {

    }
    public function isValid()
    {

    }
    public function getJson()
    {

    }

    public function toArray()
    {
        $a = null;
        if(is_array($this->el))
        {
             $a = $this->el;
        }
        else {
            $a = $this->el->toArray();
        }

        $a['subList'] = [];

        foreach($this->subList as $key => $values){
            $t = [];
            foreach($values as $k=>$v)
            {
                dump($v);
                $t[$k] = $v->toArray();
            }
            $a['subList'][$key] = $t;
        }
        return $a;
    }
}