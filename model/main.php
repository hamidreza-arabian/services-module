<?php
class module_services_model_main extends  main_model_main{

    public  $table='module_services_main';

    public $id='id';
    public $title_admin='title_admin';
    public $title_main='title_main';
    public $active='active';
    public $score='score';
    public $view='view';
    public $lang='lang';/// 0=>fa     1=>en
    public $id_page='id_page';


    public function __construct($model_main=true,$db=false){
        if($model_main)
            parent::__construct($db);
    }


    public function copy($id_page,$new_id_page){
        $data=new module_services_model_box(false);

        $val_main=parent::select($this->table,array(':id_page'=>$id_page),'','id_page=:id_page')->fetchAll(2);
        foreach($val_main as $main){
            $id_module=$main['id'];
            $main['id']=0;
            $main['id_page']=$new_id_page;
            parent::setAll($this->table,$main);
            $id_module_new=parent::end_id($this->table);

            $value=parent::select($data->table,array(':id_module'=>$id_module),'','id_module=:id_module','','',false)->fetchAll(2);
            foreach($value as $val){
                $val['id_module']=$id_module_new;
                $val['id']=0;
                parent::setAll($data->table,$val);
            }
        }
        unset($data);

    }

    public  function  get_id($id){
        return parent::select($this->table,array(':id'=>$id),'',"{$this->id}=:id")->fetch(2);
    }
    public function admin_get($id_page,$str=''){
        $where="{$this->id_page}=:id_page";
        $pa=array(':id_page'=>$id_page);
        if($str)
        {
            $where.=" and {$this->title_admin} like :str";
            $pa=array_merge($pa,array(':str'=>"%$str%"));
        }
        return parent::select($this->table,$pa,'',$where,M::order_score_id,'',false)->fetchAll(2);
    }
    public function admin_add($text,$lang,$id_page){
        return parent::insert($this->table,"{$this->title_admin},{$this->lang},{$this->id_page},{$this->title_main}",
            ':text,:lang,:id_page,:text2',array(':text'=>$text,':text2'=>$text,':lang'=>$lang,':id_page'=>$id_page));
    }
    public function get_index_module($id_page){
        $where="{$this->id_page}=:id_page and {$this->active}=1";
        $pa=array(':id_page'=>$id_page);
        return parent::select($this->table,$pa,'',$where,M::order_score_id,'',false)->fetchAll(2);
    }
    public function delete($id){
        return parent::del($this->table,'id=:id',array(':id'=>$id));
    }
    public function del_module($id_page){
        $box=new module_services_model_box(false);
        $val_main=parent::select($this->table,array(':id_page'=>$id_page),'','id_page=:id_page')->fetchAll(2);
        parent::del($this->table,'id_page=:id_page',array(':id_page'=>$id_page));
        foreach($val_main as $main)
            parent::del($box->table,'id_module=:id_module',array(':id_module'=>$main['id']));

        unset($box);
    }

}