<?php
namespace Arafath57\BlogPackage;


class Calculator
{
    private $result;

    public function __construct()
    {
        $this->result = 0;
    }

    function add(int $value): Calculator
    {
        $this->result+=$value;
        return $this;
    }

    function subtract(int $value) : Calculator
    {
        $this->result-=$value;
        return  $this;
    }

    function clear() : Calculator{
        $this->result = 0;
        return $this;
    }

    function getResult() :int{
        return $this->result;
    }
}