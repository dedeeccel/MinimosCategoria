<?php
class MinimosCategoria extends Module
{
    public function __construct()
    {
        $this->name = 'MinimosCategoria';
        $this->tab = 'other';
        $this->version = '0.1.0';
        $this->author = 'Andre Eccel';
        parent::__construct();
        $this->displayName = $this->l('Minimos categoria');
        $this->description = $this->l('Define um valor ou quantidade mínima para alguma categoria.');
    }

    public function install()
    {
        if (!parent::install() Or !$this->criarColunas())
            return false;
        return true;
    }
    private function criarColunas(){
        $sql = "ALTER TABLE "._DB_PREFIX_."category
        ADD COLUMN quantidademinima INT,
        ADD COLUMN minimos INT,
        ADD COLUMN precominimo FLOAT(8,2)";
        Db::getInstance()->execute($sql);
        return true;
    }
    public function uninstall()
    {

        if (!parent::uninstall() Or !$this->excluirColunas())
            return false;
        return true;
    }
    private function excluirColunas(){
        $sql = "ALTER TABLE "._DB_PREFIX_."category
        DROP COLUMN quantidademinima,
        DROP COLUMN minimos,
        DROP COLUMN precominimo";
        Db::getInstance()->execute($sql);
        return true;
    }
}