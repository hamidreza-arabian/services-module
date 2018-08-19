<?php
class module_services_jq_controller_color extends  main_jq_extends{

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

    private function color($pa){
        $data = new module_services_model_main();
        $val=$data->get_id($pa['id']);
        $view=new module_services_jq_view_color();
        $view->color($val,$pa['id']);
    }
    private function update_color($pa){
        $data = new module_services_model_main();
        $msg=$data->setAll($data->table,$pa);
        unset($data);
        $view=new main_jq_view_extends();
        $view->set_msg($msg);
    }

}