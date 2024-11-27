<?php

function flexform_get_form_columns($form){
    //check if the form is connected to any Table, it yes, then we can show mapped columns
    $fields = [];
    if($connected_to = $form['type']){
        //it means it is connected to a table
        switch ($connected_to){
            case 'leads':
                $fields    = [
                    'name'=>'name',
                    'title'=>'title',
                    'email'=>'email',
                    'phonenumber'=>'phonenumber',
                    'lead_value'=>'lead_value',
                    'company'=>'company',
                    'address'=>'address',
                    'city'=>'city',
                    'state'=>'state',
                    'country'=>'country',
                    'zip'=>'zip',
                    'description'=>'description',
                    'website'=>'website',
                ];
                $fields = hooks()->apply_filters('lead_form_available_database_fields', $fields);
                $custom_fields    = get_custom_fields('leads', 'type != "link"');
                $cfields = format_external_form_custom_fields($custom_fields);
                foreach ($cfields as $field) {
                    $fields[$field->name] = $field->label;
                }
                break;
            case 'customers':
                $fields    = [
                    'company'=>'company',
                    'address'=>'address',
                    'city'=>'city',
                    'state'=>'state',
                    'country'=>'country',
                    'zip'=>'zip',
                    'phonenumber'=>'phonenumber',
                    'website'=>'website',
                    'vat'=>'vat',
                ];
                //we will turn off custom fields for now for customers
                break;
            default:
                break;
        }
    }
    return $fields;
}

