<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

/**
 * Description of FileUpload
 *
 * @author developer-machine
 */
class FileUpload {

    /**
     * upload the file at desired destination
     * @param type $file
     * @param type $path
     * @param type $type
     * @return string
     */
    function uploadFile($file, $path, $mimeTypes = []) {
        if ($file != '') {
            if (!is_dir($path)) {
                mkdir($path, 0777, TRUE);
            }
            //check for dictionary file extension
            if (!in_array($file->getClientOriginalExtension(), $mimeTypes)) {
                return 'Please upload valid dictionary file';
            }
            if ($file->move($path, $file->getClientOriginalName())) {
                return '1';
            }
        }
        return '0';
    }

}
