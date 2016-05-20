<?php
class OrderController extends OrderControllerCore{
    public function init(){
        parent::init();
        $id_product = (int)(Tools::getValue('id_product'));
        $produtos=$this->context->cart->getProducts();
        $currency = Currency::getCurrent();
        foreach($produtos as $produto){
            $categoria = new Category($produto['id_category_default']);
            if($categoria->minimos != 0){
                $categoria_definicao[$produto['id_category_default']]['nome'] = $categoria->getName();
                $categoria_definicao[$produto['id_category_default']]['minimo'] = $categoria->minimos;
            }
            if($categoria->minimos==1) {
                $categoria_definicao[$produto['id_category_default']]['valorminimo'] = $categoria->quantidademinima;
                $categoria_definicao[$produto['id_category_default']]['valoracumulado'] += $produto['quantity'];
            }elseif($categoria->minimos==2) {
                $categoria_definicao[$produto['id_category_default']]['valorminimo'] = $categoria->precominimo;
                $categoria_definicao[$produto['id_category_default']]['valoracumulado'] += ($produto['total_wt']);
            }
        }
        foreach($categoria_definicao as $definicao){
            if($definicao['valoracumulado'] < $definicao['valorminimo']){
                $this->step = 0;
                $this->errors[] = sprintf(Tools::displayError("Para comprar %1s o pedido mínimo é %2s %3s"),$definicao['nome'],(($definicao['minimo']==2)?$currency->sign:''),$definicao['valorminimo']);
            }
        }
    }
}