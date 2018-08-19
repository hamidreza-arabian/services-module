<?php
class module_services_jq_view_index extends  main_jq_view_extends{

    public function module($lang,$id_page){
        $add="
              ajax {
                id_load:'msg_add_mm',
                class_name: 'index',module:'module_services',
                function_name:'module_add',
                load_in_new : false,
                text:jq('#text_add_mm').val(),
                lang:$lang,
                id_page:$id_page
              }
            ";

        $str='
            <input style="width: 170px" id="text_add_mm" lang="fa" style="width: 100px" data-click="module_search_mm"  class="p_text admin_click" value=""  type="text" />

            <input style="width: 150px"   type="button" value="اضافه شود " class="p_button '.$add.'" />
            <div id="msg_add_mm"></div>
            <div id="body_data_mm"></div>
        ';

        $ajax ="{
             id_load : 'body_data_mm',
             class_name: 'index',module:'module_services',
             function_name : 'module_data',
             text:'',
             lang:$lang,
             id_page:$id_page,
             load_in_new : false
            }
            ";
        parent::add_js_text('
        function module_data(){
            var req = '.$ajax.';
            load(JSON.stringify(req));
        }
        module_data();
        ');

        parent::add_html($str);
        parent::create(__CLASS__.'_'.__FUNCTION__);
    }
    public function module_add($msg){
        if($msg==0){
            parent::add_js_text(';module_data();');
            parent::add_html('');
            parent::create(__CLASS__.'_'.__FUNCTION__);
        }
        else{
            parent::set_msg($msg);
        }
    }
    public function module_data($value,$admin_main){

        $str='';
        foreach($value as $i=>$val){
            $id=$val['id'];
            $lang=$val['lang'];
            $title="'  ویرایش  ".$val['title_admin']."'";
            $update="
              ajax {
                id_load:'div_module_load',
                class_name: 'index',module:'module_services',
                function_name:'module_load',
                he:'600px',wh:'900px',
                title: $title,
                id:$id
              }
            ";
            $title="' باکس های ".$val['title_admin']."'";
            $box="
              ajax {
                id_load:'div_module_box',
                class_name: 'index',
                module:'module_services',
                function_name:'module_box',
                he:'590px',wh:'900px',
                title:$title,
                id_page:$id,
                lang:$lang
              }
            ";

            $title='رنگ'.$val['title_admin'];
            $color="
                ajax {
                    id_load:'div_color_en',
                    class_name: 'color',
                    module:'module_services',
                    function_name:'color',
                    id:$id,
                    title: '$title',
                    he:'500px',wh:'1000px',
                  }
               ";
            $title='اندازه '.$val['title_admin'];
            $size="
                ajax {
                    id_load:'div_color_en',
                    class_name: '1000px_public',
                    id:$id,
                    table:'module_services_main',
                    function_name:'size',
                    title: '$title',
                    he:'500px',wh:'1000px',
                  }
               ";


            $active='noactive';
            if($val['active']) $active='active';
            $str.='
            <div class="tr">
                <span class="'.$active.'" ></span>
                <span class="admin_span w25 cre" >'.$val['score'].'</span>
                <span class="admin_span w300">'.$val['title_admin'].'</span>
                <span class="admin_span2 w75'.$update.'" >ویرایش</span>
                <span class="admin_span2 w75'.$color.'" >رنگ</span>
                <span class="admin_span2 w150'.$size.'" >اندازه و فواصل</span>
                <span class="admin_span2 w75'.$box.'" >باکس ها</span>
            </div>';

            if($admin_main){
                $str='
                      <span class="admin_span_m admin_update'.$update.'" ></span>
                      <span class="admin_span_m admin_color'.$color.'" ></span>
                      <span class="admin_span_m admin_size'.$size.'" ></span>
                      <span class="admin_span_m admin_box'.$box.'" > </span>
                    ';
            }

        }
        parent::add_html($str);
        parent::create(__CLASS__.'_'.__FUNCTION__);
    }
    public function module_load($val){
        $id=$val['id'];
        $lang=$val['lang'];
        $set="
              ajax {
                id_load:'module_update',
                class_name: 'index',module:'module_services',
                function_name:'module_update',
                load_in_new : false,
                id:$id,
                title_admin:jq('#title_admin').val(),
                score:jq('#score').val(),
                active:jq('#active').val()
              }
            ";

        $active1='selected="selected"';$active2="";
        if($val['active']==1){
            $active1='';$active2='selected="selected"';
        }

        $h3='selected="selected"';$h2='';$h1='';$h4='';$h5='';$h6='';
        if($val['html_tag_title']==1){
            $h1='selected="selected"';$h2='';$h3='';$h4='';$h5='';$h6='';
        }
        elseif($val['html_tag_title']==2){
            $h2='selected="selected"';$h1='';$h3='';$h4='';$h5='';$h6='';
        }
        elseif($val['html_tag_title']==3){
            $h3='selected="selected"';$h2='';$h1='';$h4='';$h5='';$h6='';
        }
        elseif($val['html_tag_title']==4){
            $h4='selected="selected"';$h2='';$h3='';$h1='';$h5='';$h6='';
        }
        elseif($val['html_tag_title']==5){
            $h5='selected="selected"';$h2='';$h3='';$h4='';$h1='';$h6='';
        }
        elseif($val['html_tag_title']==6){
            $h6='selected="selected"';$h2='';$h3='';$h4='';$h5='';$h1='';
        }

        if($lang)
            $class_lang='p_en';
        else
            $class_lang='';

        $str='
         <div id="admin_load_page">
            <label>امتیاز </label><input style="width:40px;" id="score" lang="fa" class="p_text_number" value="'.$val['score'].'"  type="text" /><br />
            <label>نام مدیریتی </label><input id="title_admin" lang="fa" maxlength="50" class="p_text '.$class_lang.'" value="'.$val['title_admin'].'"  type="text" /><br />
            <label>عنوان</label><input id="title_main"  maxlength="100" class="p_text '.$class_lang.'" value="'.$val['title_main'].'"  type="text" /><br />
            <label>نوع تگ عنوان اصلی </label>
            <select class="p_select" id="html_tag_title">
                   <option '.$h1.' value="1" >h1</option>
                   <option '.$h2.' value="2" >h2</option>
                   <option '.$h3.' value="3" >h3</option>
                   <option '.$h4.' value="4" >h4</option>
                   <option '.$h5.' value="5" >h5</option>
                   <option '.$h6.' value="6" >h6</option>
            </select><br />
            <label>فعال</label>
            <select class="p_select" id="active">
                   <option '.$active1.' value="0" >خیر</option>
                   <option '.$active2.' value="1" >بلی</option>
            </select><br />
            <div style="line-height: 45px;" class="p_error">
                    <input style="width: 150px"   type="button" value="ثبت شود" class="p_button '.$set.'" />
                    <input style="width: 150px"  onclick="reload_cache();" type="button" value="نمایش صفحه" class="p_button" />
                    <div id="module_update"></div><br/><br/><br/>
             </div>
         </div>
        ';
        parent::add_html($str);
        parent::create(__CLASS__.'_'.__FUNCTION__);
    }


    public function module_box($id_page,$lang){
        $add="
              ajax {
                id_load:'msg_add_box',
                class_name: 'index',module:'module_services',
                function_name:'module_box_add',
                load_in_new : false,
                text:jq('#text_box_add').val(),
                id_page:$id_page
              }
            ";

        $str='
            <input style="width: 170px" id="text_box_add" lang="fa" style="width: 100px" data-click="module_box_search"  class="p_text admin_click" value=""  type="text" />

            <input style="width: 150px"   type="button" value="اضافه شود " class="p_button '.$add.'" />
            <div id="msg_add_box"></div>
            <div id="body_data_box"></div>
        ';

        $ajax ="{
             id_load : 'body_data_box',
             class_name: 'index',module:'module_services',
             function_name : 'module_box_data',
             load_in_new : false,
             id_page:$id_page,
             lng:$lang
            }
            ";
        parent::add_js_text('
        function module_box_data(){
            var req = '.$ajax.';
            load(JSON.stringify(req));
        }
        module_box_data();
        ');

        parent::add_html($str);
        parent::create(__CLASS__.'_'.__FUNCTION__);
    }
    public function module_box_add($msg){
        if($msg==0){
            parent::add_js_text(';module_box_data();');
            parent::add_html('');
            parent::create(__CLASS__.'_'.__FUNCTION__);
        }
        else{
            parent::set_msg($msg);
        }
    }
    public function module_box_data($value,$lang,$admin_main){

        $str='';
        foreach($value as $i=>$val){
            $id=$val['id'];
            $title="'  ویرایش  ".$val['title_admin']."'";
            $update="
              ajax {
                id_load:'div_module_box_load',
                class_name: 'index',
                module:'module_services',
                function_name:'module_box_load',
                he:'600px',wh:'1000px',
                title: $title,
                id:$id,
                lang:$lang
              }
            ";
            $content="
              ajax {
                id_load:'div_module_box_load',
                class_name: 'index',
                module:'module_services',
                function_name:'module_box_content',
                he:'600px',wh:'1000px',
                title: $title,
                id:$id,
                lang:$lang
              }
            ";

            $active='noactive';
            if($val['active']) $active='active';
            $str.='
            <div class="tr">
                <span class="'.$active.'" ></span>
                <span class="admin_span w25 cre" >'.$val['score'].'</span>
                <span class="admin_span w200">'.$val['title_admin'].'</span>
                <span class="admin_span2 w75'.$update.'" >ویرایش</span>
                <span class="admin_span2 w75'.$content.'" >محتوا</span>
            </div>
            ';

            if($admin_main){
                $str='
                      <span class="admin_span_m admin_update'.$update.'" ></span>
                      <span class="admin_span_m admin_content'.$content.'" ></span>
                    ';
            }
        }
        parent::add_html($str);
        parent::create(__CLASS__.'_'.__FUNCTION__);
    }
    public function module_box_load($val,$lang){
        $id=$val['id'];

        $set="
              ajax {
                id_load:'module_box_update',
                class_name: 'index',module:'module_services',
                function_name:'module_box_update',
                load_in_new : false,
                id:$id,
                title_admin:jq('#title_admin').val(),
                score:jq('#score').val(),
                active:jq('#active').val(),
              }
            ";

        if($lang)
            $class_lang='p_en';
        else
            $class_lang='';

        $active1='selected="selected"';$active2="";
        if($val['active']==1){
            $active1='';$active2='selected="selected"';
        }
        $str='
         <div id="admin_load_page">
            <label>امتیاز </label><input style="width:40px;" id="score" lang="fa" class="p_text_number" value="'.$val['score'].'"  type="text" /><br />
            <label>نام مدیریتی </label><input id="title_admin" lang="fa" maxlength="50" class="p_text '.$class_lang.'" value="'.$val['title_admin'].'"  type="text" /><br />

            <label>فعال</label>
            <select class="p_select" id="active">
                   <option '.$active1.' value="0" >خیر</option>
                   <option '.$active2.' value="1" >بلی</option>
            </select><br />
            <div style="line-height: 45px;" class="p_error">
                    <input style="width: 150px"   type="button" value="ثبت شود" class="p_button '.$set.'" />
                    <input style="width: 150px"  onclick="reload_cache();" type="button" value="نمایش صفحه" class="p_button" />
                    <div id="module_box_update"></div><br/><br/><br/>
             </div>
         </div>
        ';
        parent::add_html($str);
        parent::create(__CLASS__.'_'.__FUNCTION__);
    }
    public function module_box_content($val,$lang){
        $id=$val['id'];
        $set="
              ajax {
                id_load:'module_box_update',
                class_name: 'index',module:'module_services',
                function_name:'module_box_update',
                load_in_new : false,
                id:$id,
                title_main:jq('#title_main').val(),
                html_tag_title:jq('#html_tag_title').val(),
                html_text:jq('#richText_text').html(),
                ok:jq('#ok').val()
              }
            ";

        if($lang)
            $class_lang='p_en';
        else
            $class_lang='';



        $h3='';$h2='';$h1='selected="selected"';
        if($val['ok']==1){
            $h1='';$h2='selected="selected"';$h3='';
        }
        elseif($val['ok']==2){
            $h2='';$h1='';$h3='selected="selected"';
        }

        parent::add_js__files("main/folder/js/1000px/editor2.js");
        parent::add_css__files("main/folder/css/1000px/editor-css.css");
        parent::add_js_text("
        jq(function(){
            jq('.editor1').createEditor();
        });");



        $str='
         <div id="admin_load_page">
            <label>عنوان</label><input id="title_main"  maxlength="100" class="p_text '.$class_lang.'" value="'.$val['title_main'].'"  type="text" /><br />
            <label >متن</label>
            <textarea id="text"  lang="fa"  class="p_text'.$class_lang.' editor1" >'.$val['text'].'</textarea><br/>

            <label>دارد ندارد</label>
            <select class="p_select" id="active">
                   <option '.$h1.' value="0" >هیچ کدام</option>
                   <option '.$h2.' value="1" >دارد</option>
                   <option '.$h3.' value="2" >ندارد</option>
            </select><br />
            <div style="line-height: 45px;" class="p_error">
                    <input style="width: 150px"   type="button" value="ثبت شود" class="p_button '.$set.'" />
                    <input style="width: 150px"  onclick="reload_cache();" type="button" value="نمایش صفحه" class="p_button" />
                    <div id="module_box_update"></div><br/><br/><br/>
             </div>
         </div>
        ';
        parent::add_html($str);
        parent::create(__CLASS__.'_'.__FUNCTION__);
    }
}