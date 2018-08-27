<style>
    #gridView{
        table-layout: fixed !important;
    }
</style>
<div class="table-responsive"> 
    <?php
    $requestArray = [];
    if (\Session::has('error')) {
        $requestArray = \Session::get('error')['dataArray'];
        \Session::forget('error');
    }
    ?>
    <input type="hidden" name="projectId" id="projectId" value="{{$sessionArray->projectId}}"/>
    <input type="hidden" name="sessionId" id="sessionId" value="{{$sessionArray->id}}"/>
    <input type="hidden" name="templateId" id="templateId" value="{{$templateId}}"/>
    <table class="table table-striped" id="gridView">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                @foreach($templateFieldArray as $template)
                <th>
                    <input type="hidden" name="col_names[]" value="{{$template->id}}">
                    {{$template->templateFieldLabel}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($traitGrid as $key => $gridRow)
            <?php
            $participantId = $gridRow['participantDetail']->id;
            $traitValueArray = $gridRow['traitArray'];
            ?>
            <tr>
                <td>{{$gridRow['participantDetail']->participant->firstName}}
                    <input type="hidden" name="listUserId[]" id="listUserId" value="{{$participantId}}"/></td>
                <td>{{$gridRow['participantDetail']->participant->lastName}}</td>
                <?php
                array_shift($gridRow);
                array_shift($gridRow);
                ?>
                @foreach($gridRow as $key1 => $gridColumn)
                <td>  
                    <div class="form-group">                       
                        <?php
                        $valueArray = [];
                        if ($gridColumn->templateFieldValue != null) {
                            $valueArray = json_decode($gridColumn->templateFieldValue);
                        }
                        ?>
                        <?php
                        $colName = $gridColumn->id . '_' . $participantId;
                        switch ($gridColumn->templateFieldControl) {
                            case 'text':
                                $ValueDB = '';
                                if (isset($traitValueArray[$gridColumn->id])) {
                                    if (\DateTime::createFromFormat('Y-m-d H:i:s', $traitValueArray[$gridColumn->id]) == TRUE) {
                                        $ValueDB = date('Y-m-d', strtotime($traitValueArray[$gridColumn->id]));
                                    } else {
                                        $ValueDB = $traitValueArray[$gridColumn->id];
                                    }
                                }
                                ?>
                                <input type="text" class="form-control"  value="{{isset($requestArray[$colName]) ? $requestArray[$colName] : $ValueDB}}" name="{{$gridColumn->id.'_'.$participantId}}" placeholder="{{$gridColumn->templateFieldLabel}}"  {{$gridColumn->required == '1'?'required':''}}/>
                                <?php
                                break;
                            case 'checkbox':
                                if (count($valueArray) > 0) {
                                    foreach ($valueArray as $value) {
                                        ?>
                                        <input value="{{$value}}" name="{{$gridColumn->id.'_'.$participantId}}" type='checkbox'  {{$gridColumn->required == '1'?'required':''}}/> {{$value}}<br/>
                                        <?php
                                    }
                                }
                                break;
                            case 'radio':
                                if (count($valueArray) > 0) {
                                    foreach ($valueArray as $value) {
                                        ?>
                                        <input {{(isset($requestArray[$colName]) && $requestArray[$colName] == $value) ? 'checked="checked"' : ((isset($traitValueArray[$gridColumn->id]) && $value == $traitValueArray[$gridColumn->id])? 'checked="checked"':'')}} value="{{$value}}" name="{{$gridColumn->id.'_'.$participantId}}" type='radio'  {{$gridColumn->required == '1'?'required':''}}/> {{$value}} <br/>
                                        <?php
                                    }
                                }
                                break;
                            case 'select':
                                ?>
                                <select  name="{{$template->id.'_'.$participantId}}" class="form-control"  {{$gridColumn->required == '1'?'required':''}}>
                                    <option disabled="disabled" selected='selected'>{{$gridColumn->templateFieldLabel}}</option>
                                    <?php
                                    if (count($valueArray) > 0) {
                                        foreach ($valueArray as $value) {
                                            ?>
                                            <option {{(isset($requestArray[$colName]) && $requestArray[$colName] == $value) ? 'selected="selected"' : ((isset($traitValueArray[$gridColumn->id]) && $value == $traitValueArray[$gridColumn->id])?'selected="selected"':'')}} value='{{$value}}'> {{$value}}</option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            <?php
                        }
                        ?>
                    </div>
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<hr/>
<div class="">
    <button type="submit" class="btn btn-orange" id="saveTraitButton">Save Edited Template</button>
</div>