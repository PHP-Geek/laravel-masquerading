<div class="row">
    @foreach($templateFields as $template)
    <div class="col-sm-4">
        <div class="form-group">
            <label>{{$template->templateFieldLabel}}</label>
            <input type="hidden" name="col_names[]" value="{{$template->id}}" {{$template->required == '1'?'required':''}}/>
            <?php $valueArray = json_decode($template->templateFieldValue);
            ?>
            <?php
            switch ($template->templateFieldControl) {
                case 'text':
                    ?>
                    <input type="text" class="form-control" name="{{$template->id}}" placeholder="{{$template->templateFieldLabel}}"  {{$template->required == '1'?'required':''}}/>
                    <?php
                    break;
                case 'checkbox': echo '<br/>';
                    if (count($valueArray) > 0) {
                        foreach ($valueArray as $value) {
                            ?>
                            <input value="{{$value}}" name="{{$template->id}}[]" type='checkbox'  {{$template->required == '1'?'required':''}}/> {{$value}} &nbsp; &nbsp;
                            <?php
                        }
                    }
                    break;
                case 'radio':
                    echo '<br/>';
                    if (count($valueArray) > 0) {
                        foreach ($valueArray as $value) {
                            ?>
                            <input value="{{$value}}" name="{{$template->id}}" type='radio'  {{$template->required == '1'?'required':''}}/> {{$value}} &nbsp; &nbsp;
                            <?php
                        }
                    }
                    break;
                case 'select':
                    ?>
                    <select  name="{{$template->id}}" class="form-control"  {{$template->required == '1'?'required':''}}>
                        <option disabled="disabled" selected='selected'>{{$template->templateFieldLabel}}</option>
                        <?php
                        if (count($valueArray) > 0) {
                            foreach ($valueArray as $value) {
                                ?>
                                <option value='{{$value}}'> {{$value}}</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                <?php
            }
            ?>
        </div>
    </div>
    @endforeach
</div>
