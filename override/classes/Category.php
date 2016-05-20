<?php
class Category extends CategoryCore
{
    public $minimos;
    public $quantidademinima;
    public $precominimo;

    public function __construct($id_category = null, $id_lang = null, $id_shop = null) {

        $definition = self::$definition;
        $definition['fields']['minimos']   = array('type' => ObjectModelCore::TYPE_INT);
        $definition['fields']['quantidademinima']      = array('type' => ObjectModelCore::TYPE_INT);
        $definition['fields']['precominimo']   = array('type' => ObjectModelCore::TYPE_FLOAT);

        self::$definition = $definition;

        parent::__construct($id_category, $id_lang, $id_shop);
    }
}