<?php
class module_services_view_1200px {
    function   __construct($dat,$parent,$sx){
//  var_dump($dat);exit;
        $str='';

        foreach($dat as $i=>$box){
            $id=$box['id'];
            $data=$box['sx'];
            $parent->add_css_text('
                <style>
                #title_'.$id.'{
                    color:'.$sx['color_title'].';
                }
                #services-box_'.$id.'{
                    background-color:'.$box['color_bg'].';
                    padding:'.$box['padding_1200'].'px;

                }
                #description-title_'.$id.'{
                    font-size: '.$data['font_size'].'px;
                    color:'.$box['color_box_title'].';


                }
                #description-text_'.$id.'{
                    color:'.$box['color_box_text'].';
                }
                #servicesBox_container_'.$id.'{
                    margin-top:'.$box['margin_top'].'px;
                    margin-bottom:'.$box['margin_bottom'].'px;
                }
            ');
            $box2=$box['box'];
            $str2='';
            foreach($box2 as $boxitemes){
                $str2 .= '
                            <div class="services_box-line">
                                <h5 id="description-title_'.$id.'" class="description-title">'.$boxitemes['title_main'].'</h5>
                                <p id="description-text_'.$id.'" class="description-text">'.$boxitemes['text'].'</p>
                            </div>';
            }
            $str.='<div class="servicesBox_container" id="servicesBox_container_'.$id.'">
                <div  class="servicesBox_header">
                    <h3 id="title_'.$id.'">'.$box['title_main'].'</h3>
                </div>
                <div id="services-box_'.$id.'">
                    '.$str2.'
                </div>
                </div>
            </div>
                ';
        }

        $parent->add_center($str);
        $parent->add_css_text('
            <style>
            .servicesBox_container{
                width: 1000px;
                margin: auto;

            }
            .servicesBox_header{
                margin-bottom: 5px;
            }
            .services_box-line{
                display:block;
                line-height: 4;
            }
            .description-title{
                display: table-cell;
                text-align: left;
                padding-left: 50px;
                width: 200px;
            }
            .description-text{
                display: table-cell;
                text-align: justify;

            }
        ');
        
    }

}