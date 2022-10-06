<?php
namespace App\Custom;

class Item  
{
    private $producto;
    private $cantidad;
    private $precio;
    private $total;

    public function __construct($producto = '', $cantidad = '',$precio = '', $total = '')
    {
        $this -> producto = $producto;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> total = $total;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 60;
        //if ($this -> dollarSign) {
            $leftCols = $leftCols / 4 - $rightCols / 4;
        //}
        $left = str_pad($this -> producto, $leftCols) ;
        $left1 = str_pad($this -> cantidad, $leftCols) ;
        $left2 = str_pad($this -> precio, $leftCols, ' ', STR_PAD_LEFT) ;
        $right = str_pad($this -> total, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$left1$left2$right\n";
    }
}
