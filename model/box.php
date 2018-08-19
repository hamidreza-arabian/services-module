<?php
class module_services_model_box extends  main_model_main{

    public  $table='module_services_box';

    public $id='id';
    public $title_admin='title_admin';
    public $title_main='title_main';
    public $text='text';
    public $ok='ok';
    public $bg_color='bg_color';
    public $text_color='text_color';
    public $link='link';
    public $link_text='link_text';
    public $active='active';
    public $score='score';
    public $id_module='id_module';

    public function __construct($model_main=true,$db=false){
        if($model_main)
            parent::__construct($db);
    }


    public function get_id($id){
        return parent::select($this->table,array(':id'=>$id),'',"{$this->id}=:id")->fetch(2);
    }
    public function get_id_admin($id){
       return parent::select($this->table,array(':id'=>$id),'','id=:id')->fetch(2);
    }
    public function admin_get($str='',$id_module){
        $where="{$this->id_module}=:id_module ";
        $pa=array(':id_module'=>$id_module);
        if($str)
        {
            $where.=" and {$this->title_admin} like :str";
            $pa=array_merge($pa,array(':str'=>"%$str%"));
        }
        return parent::select($this->table,$pa,'',$where,M::order_score_id,'',false)->fetchAll(2);
    }
    public function admin_add($text,$id_module){
        return parent::insert($this->table,"{$this->title_admin},{$this->title_main},{$this->id_module}",
            ':text,:text2,:id_module',array(':text'=>$text,':text2'=>$text,':id_module'=>$id_module));
    }
    public function get_index_box($id_module){
        $where="{$this->id_module}=:id_module and {$this->active}=1 ";
        $pa=array(':id_module'=>$id_module);
        return parent::select($this->table,$pa,'',$where,M::order_score_id,'',false)->fetchAll(2);
    }
    public function delete($id){
        return parent::del($this->table,'id=:id',array(':id'=>$id));
    }


}