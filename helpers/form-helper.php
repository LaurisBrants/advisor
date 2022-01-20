<?php

    $form = '<form action="" id="advisor-form">';
        $form .= '<fieldset id="category" class="advisor-fieldset" data-order="1">';
        $form.= '<label for="category">Category</label>';
            $form .=
            '<select class="category" name="category">
                <option value="solo" class="default-select" selected>---Please Select---</option>
                <option value="solo">Solo</option>
                <option value="pair">Pair</option>
                <option value="dancing">Dancing</option>
                <option value="syncro">Synchro</option>
            </select>';
        $form .= '</fieldset>';

        $form .= '<fieldset id="skill" class="advisor-fieldset set_2" data-order="2" disabled>';
        $form.= '<label for="skill">Skill</label>';
        $form .=
            '<select class="skill" name="skill">
                <option value="0" class="default-select" selected>---Please Select---</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>';
        $form .= '</fieldset>';

        $form .= '<fieldset id="gender" class="advisor-fieldset set_3" data-order="3" disabled>';
        $form.= '<label for="gender">Gender</label>';
        $form .=
            '<select class="gender" name="gender">
                <option value="male" class="default-select" selected>---Please Select---</option>
                <option value="male">Male</option>
                <option value="male">Female</option>
            </select>';
        $form .= '</fieldset>';

        $form .= '<fieldset id="size" class="advisor-fieldset set_4" data-order="4" disabled>';
        $form.= '<label for="size">Footsize</label>';
        $form .='<select class="size" name="size">';
            $form .= '<option value="25" class="default-select" selected>---Please Select---</option>';
            for ($x = 25; $x <= 47; $x++){
                $form .='<option value="'.$x.'">'.$x.'</option>';
          }
        $form .='</select>';
        $form .= '</fieldset>';
        $form .= '<fieldset id="height" class="advisor-fieldset set_5" data-order="5" disabled>';
            $form.= '<label for="height">Height</label>';
            $form .='<select name ="height" class="height">';
                $form .= '<option value="100" class="default-select" selected>---Please Select---</option>';
                 for ($x = 100; $x <= 200; $x+=5){
                        $form .='<option value="'.$x.'">'.$x.'</option>';
                  }
            $form .='</select>';
        $form .= '</fieldset>';
        $form .= '<fieldset id="weight" class="advisor-fieldset set_6" data-order="6" disabled>';
            $form.= '<label for="weight">Weight</label>';
            $form .='<select class="weight">';
            $form .= '<option value="0" class="default-select" selected>---Please Select---</option>';
                 for ($x = 10; $x <= 105; $x+=5){
                        $form .='<option value="'.$x.'">'.$x.'</option>';
                  }
            $form .='</select>';
        $form .= '</fieldset>';
        $form .= '<div id="call_changer"></div>';
    $form.= '</form>';

return $form;