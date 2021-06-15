<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Card extends Component
{
    public $productTitle=false, $productInfoLabel=false, $productInfoData=false, $productLabel=false, $productImgSrc=false, $productImgAlt=false;
    public $productPrice=false, $productInput=false, $productBtnBuy=false, $productBtnSell=false, $productBtnUnsell=false, $productBtnScheduleCard=false, $productBtnScheduleBundle=false, $productBtnDelete=false;
    public $product, $options, $productNotAvailable=false, $productInsufficientFunds=false, $productIndex=0, $productPriceVisible=false;

    public function mount()
    {
        $this->productTitle=$this->options['productTitle'];

        $this->productLabel=$this->options['productLabel'];
        $this->productInfoLabel=$this->options['productInfoLabel'];
        $this->productInfoData=$this->options['productInfoData'];
        
        $this->productImgSrc=$this->options['productImgSrc'];
        $this->productImgAlt=$this->options['productImgAlt'];
        
        $this->productPrice=$this->options['productPrice'];
        $this->productPriceVisible=$this->options['productPriceVisible'];
        $this->productInput=$this->options['productInput'];

        $this->productInsufficientFunds=$this->options['productInsufficientFunds'];
        $this->productNotAvailable=$this->options['productNotAvailable'];
        
        $this->productBtnBuy=$this->options['productBtnBuy'];
        
        $this->productBtnSell=$this->options['productBtnSell'];
        $this->productBtnUnsell=$this->options['productBtnUnsell'];
        
        $this->productBtnScheduleCard=$this->options['productBtnScheduleCard'];
        $this->productBtnScheduleBundle=$this->options['productBtnScheduleBundle'];
        
        $this->productBtnDelete=$this->options['productBtnDelete'];
        $this->product=$this->options['product'];    
        $this->productIndex=$this->options['productIndex'];    
    }

    public function render()
    {
        return view('livewire.card');
    }
}
