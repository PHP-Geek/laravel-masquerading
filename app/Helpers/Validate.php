<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

/**
 * Description of Validate
 *
 * @author birendra
 */
class Validate {

    /**
     * validate the current date and time
     * @param type $dateTime
     */
    function validateSessionDate($dateTime) {
        if (strtotime($dateTime) > strtotime('+30 minutes')) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * validate the template field data for valid column and data
     * @param type $templateFieldColumn
     * @param type $templateColumnArray
     */
    function validateTemplateFieldData($templateFieldColumn, $validationNumber, $dataArray) {
        //check for template validation fields
        $errors = [];
        foreach ($dataArray as $key => $data) {
            //check for the template field money and currency
            switch ($validationNumber) {
                case '1':
                case 1:
                case '2':
                case 2:
                    //check for digit for the column
                    if (!is_numeric($data[$templateFieldColumn])) {
                        $errors[] = $templateFieldColumn . ' must be digit in row ' . ($key + 1);
                    }
                    break;
                case '3':
                case 3:
                    //check for valid date 
                    if (!$data[$templateFieldColumn] instanceof \DateTime) {
                        $errors[] = $templateFieldColumn . ' must be a valid date (yyyy-mm-dd) in row ' . ($key + 1);
                    }
                    break;
            }
        }
        return $errors;
    }

    /**
     * validate the template field value as per the validation stored in database
     * @param type $templateValidation
     * @param \DateTime $value
     * @return boolean
     */
    function validateTemplateFieldValue($templateValidation, $value, $columnName, $row) {
        switch ($templateValidation) {
            case '1':
            case 1:
            case '2':
            case 2:
                //check for digit for the column
                if (!is_numeric($value)) {
                    return $columnName . ' must be a valid number in row ' . $row;
                }
                break;
            case '3':
            case 3:
                //check for valid date 
                if (\DateTime::createFromFormat('Y-m-d', $value) == FALSE) {
                    return $columnName . ' must be a valid date time value (YYYY-MM-DD) in row ' . $row;
                }
                break;
        }
        return TRUE;
    }

}
