<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Template extends Model {

    /**
     * foreign key with users table
     * @return type
     */
    public function templateCreatedBy() {
        return $this->belongsTo(User::class, 'createdBy');
    }

    /**
     * foreign key to template fields
     * @return type
     */
    public function templateField() {
        return $this->hasMany(TemplateField::class, 'templateId');
    }

    /**
     * save the template 
     * @param type $templateType
     * @param type $request
     * @return type
     */
    function add($templateType = 'demographic', $request) {
        $this->templateType = $templateType;
        $this->templateTitle = $request->templateTitle;
        $this->companyId = Auth::user()->companyId;
        $this->createdBy = Auth::user()->id;
        $this->templateStatus = '1';
       
        $this->save();
        return $this->id;
    }

}
