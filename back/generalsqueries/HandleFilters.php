<?php
namespace GeneralsQueries;
class HandleFilters {
    public function type_data ($value) {
        $type = '';
        //var_dump(intval($value));
        if ($value == '') {
            $type = " NULL ";
        }else if ($value === true || $value === false) {
            $type = " ".$value."";
        }else if (is_numeric($value)) {
            $type = " ".intval($value)."";
        }else if (is_string($value)) {
                $type = " '".$value."'";
        }
        return $type;
    }
}