<?php
class module_services_jq_controller_index extends  main_jq_extends{

    private function access($function)
    {
        $data = new main_model_user_category();
        $category = $data->get_category_id_by_id_sh($_SESSION['id_sh']);
        if (empty($category))
            return false;
        else
            return true;
    }
    public function start($function, $arguments)
    {
        if ($this->access($function)) {
            $this->$function($arguments);
        } else
            parent::echo_access_no();
    }

    private function module($pa){
        $view=new module_services_jq_view_index();
        $view->module($pa['lang'],$pa['id_page']);
    }
    private function module_add($pa){
        if(strlen($pa['text'])==0)
            $msg=12;
        else {
            $data = new module_services_model_main();
            $msg = $data->admin_add($pa['text'],$pa['lang'],$pa['id_page']);
            unset($data);
        }
        $view=new module_services_jq_view_index();
        $view->module_add($msg);
    }
    private function module_data($pa){
        $str='';
        if(isset($pa['text']))
            $str=$pa['text'];


        $data=new module_services_model_main();
        $admin_main=false;
        if(isset($pa['id_module']))
        {
            $val=$data->get_id($pa['id_module']);
            $val=array($val);
            $admin_main=true;
        }
        else
            $val=$data->admin_get($pa['id_page']);

        unset($data);
        $view=new module_services_jq_view_index();
        $view->module_data($val,$admin_main);
    }
    private function module_load($pa){
        $data=new module_services_model_main();
        $val=$data->get_id($pa['id']);
        unset($data);
        $view=new module_services_jq_view_index();
        $view->module_load($val);
    }
    private function module_update($pa){
        $content=false;
        if(isset($pa['content']))
        {
            $content=true;
            unset($pa['content']);
        }


        $data=new module_services_model_main();
        $msg=$data->setAll($data->table,$pa);
        unset($data);
        $view=new main_jq_view_extends();
        if(!$content)
             $view->add_js_text(';module_data();');
        $view->set_msg($msg);
    }


    private function module_box($pa){
        $view=new module_services_jq_view_index();
        $view->module_box($pa['id_page'],$pa['lang']);
    }
    private function module_box_add($pa){
        if(strlen($pa['text'])==0)
            $msg=12;
        else {
            $data = new module_services_model_box();
            $msg = $data->admin_add($pa['text'],$pa['id_page']);
            unset($data);
        }
        $view=new module_services_jq_view_index();
        $view->module_box_add($msg);
    }
    private function module_box_data($pa){
        $str='';
        if(isset($pa['text']))
            $str=$pa['text'];
        $data=new module_services_model_box();

        $admin_main=false;
        if(isset($pa['id_box']))
        {
            $val=$data->get_id($pa['id_box']);
            $val=array($val);
            $admin_main=true;
        }
        else
            $val=$data->admin_get($str,$pa['id_page']);
        unset($data);
        $view=new module_services_jq_view_index();
        $view->module_box_data($val,$pa['lng'],$admin_main);
    }
    private function module_box_load($pa){
        $data=new module_services_model_box();
        $val=$data->get_id_admin($pa['id']);
        unset($data);
        $view=new module_services_jq_view_index();
        $view->module_box_load($val,$pa['lang']);
    }
    private function module_box_content($pa){
        $data=new module_services_model_box();
        $val=$data->get_id_admin($pa['id']);
        unset($data);
        $view=new module_services_jq_view_index();
        $view->module_box_content($val,$pa['lang']);
    }
    private function module_box_update($pa){
        if(isset($pa['html_text'])){
            $pa['text']=$pa['html_text'];
            $pa['text']=strip_tags($pa['text'],'<a><b><br>');
            unset($pa['html_text']);
        }
        $data=new module_services_model_box();
        $msg=$data->setAll($data->table,$pa);
        unset($data);
        $view=new main_jq_view_extends();
        $view->add_js_text(';module_box_data();');
        $view->set_msg($msg);
    }
    private function del($pa){
        $data=new module_services_model_main();
        $data2=new module_services_model_box();
        $data_page=new main_model_menu_page();
        $value=$data->admin_get($pa['id_page'],'');
        foreach($value as $val){
            $value2=$data2->admin_get('',$val['id']);
            foreach($value2 as $val2){
                $data2->delete($val2['id']);
            }
            $data->delete($val['id']);
        }
        $msg=$data_page->delete($pa['id_page']);

        unset($data);unset($data2);unset($data_page);
        $view=new main_jq_view_extends();
        $view->add_js_text('page_data();');
        $view->set_msg($msg);
    }


}