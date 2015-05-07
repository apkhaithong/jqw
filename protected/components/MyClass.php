<?php

class MyClass extends CApplicationComponent {
    public $myvar = array();
    public function convertDate($myvar) {
        $date = DateTime::createFromFormat('d/m/Y', $myvar);
        return $date->format('Y-m-d');
    }

    public function convertDatetime($myvar) {
        $date = DateTime::createFromFormat('d/m/Y', $myvar);
        return $date->format('Y-m-d H:i:s');
    } 

}
