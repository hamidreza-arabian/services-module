<?php
class module_services_jq_view_color extends  main_jq_view_extends{
    public function color($val,$id){
        $set="
              ajax {
                id_load:'msg_site_public_update',
                class_name: 'color',
                module:'module_services',
                function_name:'update_color',
                load_in_new : false,
                id:$id,
                color_tem1:jq('#color_tem1').val(),
                color_tem2:jq('#color_tem2').val(),
                color_title:jq('#color_title').val(),
                color_text:jq('#color_text').val(),
                color_bg:jq('#color_bg').val(),
                color_1200_bg:jq('#color_1200_bg').val(),
                color_link:jq('#color_link').val(),
                color_link_hover:jq('#color_link_hover').val(),
                color_b_text:jq('#color_b_text').val(),
                color_b_bg:jq('#color_b_bg').val(),
                color_b_h_text:jq('#color_b_h_text').val(),
                color_b_h_bg:jq('#color_b_h_bg').val(),
                color_box_text:jq('#color_box_text').val(),
                color_box_title:jq('#color_box_title').val()
              }
            ";
        parent::add_js_text('palet');
            $str='
             <label>رنگ تم 1</label><input id="color_tem1"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_tem1'].'"  type="text" /><br />
             <label>رنگ تم 2</label><input id="color_tem2"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_tem2'].'"  type="text" /><br />
             <label>رنگ عناوین</label><input id="color_title"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_title'].'"  type="text" /><br />
             <label>رنگ متن ها</label><input id="color_text"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_text'].'"  type="text" /><br />
             <label>رنگ بک گراند</label><input id="color_bg"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_bg'].'"  type="text" /><br />
             <label>رنگ بک گراند 1200 پیکسل</label><input id="color_1200_bg"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_1200_bg'].'"  type="text" /><br />
             <label>رنگ لینک</label><input id="color_link"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_link'].'"  type="text" /><br />
             <label>رنگ هاور</label><input id="color_link_hover"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_link_hover'].'"  type="text" /><br />
             <br/>
             <label>رنگ متن دکمه</label><input id="color_b_text"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_b_text'].'"  type="text" /><br />
             <label>رنگ بک گراند دکمه</label><input id="color_b_bg"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_b_bg'].'"  type="text" /><br />
             <label>رنگ هاور متن دکمه</label><input id="color_b_h_text"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_b_h_text'].'"  type="text" /><br />
             <label>رنگ بک گراند هاور دکمه</label><input id="color_b_h_bg"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_b_h_bg'].'"  type="text" /><br />
             <br/>
             <label>رنگ متن باکس</label><input id="color_box_text"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_box_text'].'"  type="text" /><br />
             <label>رنگ عنوان باکس</label><input id="color_box_title"  style="width:100px;"  class="p_text p_en ghcolor" value="'.$val['color_box_title'].'"  type="text" /><br />

        ';
        $str='
           <div id="footer_main">
            '.$str.'
          <div style="line-height: 45px;" class="p_error">
                    <input style="width: 150px"   type="button" value="ثبت شود" class="p_button '.$set.'" />
                    <input style="width: 150px"  onclick="reload_cache();" type="button" value="نمایش صفحه" class="p_button" />
                    <div id="msg_site_public_update"></div><br/><br/><br/><br/>
             </div>

          </div>
        ';
        parent::add_css_text('
        #footer_main label {
          display:inline-block;
          width:200px;
          text-align:left;
          margin-left:5px;
        }
        #footer_main img {
           height:50px;
        }
        #footer_main input {
           width:500px;
        }
        #footer_main .text_w {
           width:700px;
        }
        #footer_main textarea {
           width:700px;
           height:50px;
        }
        ');
        parent::add_html($str);
        parent::create(__CLASS__.'_'.__FUNCTION__);
    }
}