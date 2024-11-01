<?php

class OC_RS_SRGF_Field_Rating extends GF_Field {

    public $type = 'ocRating';

    public function get_form_editor_field_title() { return esc_attr__( 'Rating', 'gravityforms' ); }

    public function get_form_editor_button() {
        return array(
            'group' => 'advanced_fields',
            'text'  => $this->get_form_editor_field_title(),
            'onclick'   => "StartAddField('".$this->type."');",
        );
    }
    function get_form_editor_field_settings() {
        return array(
        	'label_setting',
            'max_star',
            'star_icon',
            'write_a_notice',
            'select_star_color',
            'select_hover_color',
            'select_active_color',
        );
    }
    function is_conditional_logic_supported() { return true; }

    function get_value_submission( $field_values, $get_from_post=true ) {
        if(!$get_from_post) {
            return $field_values;
        }
        return $_POST;
    } 
    function get_field_input( $form, $value = '', $entry = null ) { 

        ob_start();

        $is_entry_detail = $this->is_entry_detail();
        $is_form_editor  = $this->is_form_editor();
        $form_id  = $form['id'];
        $id       = intval( $this->id );
        $field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";
        $atts['type'] = 'hidden';


        $max_star = "5";
        $star_icon = "icon_1";
        $label2 = $this->label;
        $label = str_replace(' ','-',$label2);
        $lables = '#'.$label.'';
        $star_color = $this->select_star_color;
        $write_a_notice = $this->write_a_notice;

        if (!empty($value)) {
            $valueee1 = $value["input_".$id];
            $valueee2 = $value[$label];
        }else{
            $valueee1 = '';
            $valueee2 = '';
        }

        if ("icon_1" === $star_icon) {
            return "
            <div class='ginput_container rateit_field_color".$id."'>
                <input type='hidden' value='".$valueee2."' name='".$label."' id='".$label."' >
                <div class='rateit' data-rateit-backingfld='".$lables."' data-rateit-resetable='true' data-rateit-ispreset='true' data-rateit-min='0' data-rateit-max='".$max_star."' data-rateit-icon='★' data-rateit-mode='font'>
                    <input class='rating_val'  name='input_".$id."' value='".$valueee1."' id='". $form_id."' type='".$atts['type']."'  />
                </div>
            </div>
            <div class='Notice_for_ratting'>
                ".$write_a_notice."
            </div>
            <style type='text/css'>
                    .rateit_field_color".$id." .rateit-font .rateit-empty {
                        color: ".$star_color.";
                    }
                    .rateit_field_color".$id." .rateit .rateit-hover {
                        color: #fbff00;
                    }
                    .rateit_field_color".$id." .rateit .rateit-selected {
                        color: #bf4242;
                    }
            </style>";
        }
    }
}
GF_Fields::register(new OC_RS_SRGF_Field_Rating() );




add_action( 'gform_field_standard_settings', 'SRGV_rating_GF_add_custom_field' , 10,  2);
function SRGV_rating_GF_add_custom_field( $position, $form_id )
{
    if ($position == 50) {
    ?> 
    	<li class="max_star field_setting">
            <label for="max_star" class="section_label"><?php  echo esc_html( __( 'Max Star', 'gravityforms' ) );?></label>
            <input type="number" id="max_star"  name="Max star" min="1"  value="5" disabled/>
            <label class="ocwma_pro_link">Only available in pro version <a href="https://oceanwebguru.com/shop/star-rating-gravity-forms-pro/" target="_blank">link</a></label>
        </li>

        <li class="star_icon field_setting">
            <label for="select_star" class="section_label"><?php  echo esc_html( __( 'Select Star', 'gravityforms' ) );?></label>
            <input type="radio" name="icon" id="field_icon1" onchange="SetFieldProperty('star_icon', this.value);" value="icon_1" checked>
            <label for="field_icon1" class="inline" style="margin-bottom: 10px !important;">★</label><br>

            <input type="radio" name="icon" id="field_icon2" onchange="SetFieldProperty('star_icon', this.value);" value="icon_2" disabled>
            <label for="field_icon2" class="inline" style="margin-bottom: 10px !important;">✰</label>
            <label class="ocwma_pro_link">Only available in pro version <a href="https://oceanwebguru.com/shop/star-rating-gravity-forms-pro/" target="_blank">link</a></label>

            <input type="radio" name="icon" id="field_icon3" onchange="SetFieldProperty('star_icon', this.value);" value="icon_3" disabled>
            <label for="field_icon3" class="inline" style="margin-bottom: 10px !important;">⍟</label>
            <label class="ocwma_pro_link">Only available in pro version <a href="https://oceanwebguru.com/shop/star-rating-gravity-forms-pro/" target="_blank">link</a></label>
            
            <input type="radio" name="icon" id="field_icon4" onchange="SetFieldProperty('star_icon', this.value);" value="icon_4" disabled>
            <label for="field_icon4" class="inline" style="margin-bottom: 10px !important;">✪</label>
            <label class="ocwma_pro_link">Only available in pro version <a href="https://oceanwebguru.com/shop/star-rating-gravity-forms-pro/" target="_blank">link</a></label>
            
            <input type="radio" name="icon" id="field_icon5" onchange="SetFieldProperty('star_icon', this.value);" value="icon_5" disabled>
            <label for="field_icon5" class="inline" style="margin-bottom: 10px !important;">✤</label>
            <label class="ocwma_pro_link">Only available in pro version <a href="https://oceanwebguru.com/shop/star-rating-gravity-forms-pro/" target="_blank">link</a></label>
            
            <input type="radio" name="icon" id="field_icon6" onchange="SetFieldProperty('star_icon', this.value);" value="icon_6" disabled>
            <label for="field_icon6" class="inline" style="margin-bottom: 10px !important;">⊛</label>
            <label class="ocwma_pro_link">Only available in pro version <a href="https://oceanwebguru.com/shop/star-rating-gravity-forms-pro/" target="_blank">link</a></label>
            
            <input type="radio" name="icon" id="field_icon7" onchange="SetFieldProperty('star_icon', this.value);" value="icon_7" disabled>
            <label for="field_icon7" class="inline" style="margin-bottom: 10px !important;">⍣</label>
            <label class="ocwma_pro_link">Only available in pro version <a href="https://oceanwebguru.com/shop/star-rating-gravity-forms-pro/" target="_blank">link</a></label>
            
        </li>

        <li class="write_a_notice field_setting">
            <label for="write_a_notice" class="section_label"><?php  echo esc_html( __( 'Write A Note :', 'gravityforms' ) );?></label>
            <textarea id="write_a_notice" name="Write A Note :" onchange="SetFieldProperty('write_a_notice', this.value);"></textarea>
        </li>

        <li class="select_star_color field_setting">
            <label for="select_star_color" class="section_label"><?php  echo esc_html( __( 'Star Default Color', 'gravityforms' ) );?></label>
            <input type="color" id="select_star_color" name="Star Default Color" onchange="SetFieldProperty('select_star_color', this.value);"/>
        </li>

        <li class="select_hover_color field_setting">
            <label for="select_hover_color" class="section_label"><?php  echo esc_html( __( 'Star Hover Color', 'gravityforms' ) );?></label>
            <input type="color" id="select_hover_color" name="Star Hover Color" value="#fbff00" disabled />
            <label class="ocwma_pro_link">Only available in pro version <a href="https://oceanwebguru.com/shop/star-rating-gravity-forms-pro/" target="_blank">link</a></label>
        </li>

        <li class="select_active_color field_setting">
            <label for="select_active_color" class="section_label"><?php  echo esc_html( __( 'Star Active Color', 'gravityforms' ) );?></label>
            <input type="color" id="select_active_color" name="Star Active Color" value="#bf4242" disabled />
            <label class="ocwma_pro_link">Only available in pro version <a href="https://oceanwebguru.com/shop/star-rating-gravity-forms-pro/" target="_blank">link</a></label>
        </li>

    <?php 
    }      
}

add_action('gform_editor_js', 'rating_GF_editor_script', 11, 2);
function rating_GF_editor_script() {
  	?>
    <script type='text/javascript'>
    jQuery(document).ready(function($) {
        jQuery(document).bind("gform_load_field_settings", function(event, field, form){
            jQuery("#write_a_notice").val(field["write_a_notice"]);
            jQuery("#select_star_color").val(field["select_star_color"]);
            jQuery("input[name=icon][value=" + field["star_icon"] + "]").prop('checked', true);
        });
    });
   	</script>
 	<?php
}

add_action( 'gform_editor_js_set_default_values', 'OC_SRGF_default_values' );
function OC_SRGF_default_values(){
    ?>
   
    case "ocRating" :
        field.label = "Star Ratings";
        field.write_a_notice = "Rate Us";
        field.select_star_color = "#cfcfcf";
    break;
    
    <?php
}

