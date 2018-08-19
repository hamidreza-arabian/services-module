<?php
class module_services_controller_index extends module_extends {

    function   __construct($id_page,$parent,$temp,$sx){
        $data=new module_services_model_main();
        $module=$data->get_index_module($id_page);
        unset($data);
        if(!$module) return false;
        $data=new module_services_model_box();
        foreach($module as $i=>$val){
            $module[$i]['sx']=parent::set_color($sx,$val,$temp);
            ///////////////////////////////////////////////////////
            $module[$i]['box']=$data->get_index_box($val['id']);
        }
        unset($data);
        $vi='module_services_view_'.$temp;
        new $vi($module,$parent,$sx);
    }


}