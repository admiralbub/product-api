<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column gap-3">
    <form method="post">
        
        @foreach($settings as $setting)
            @csrf
            @if($setting->type=="field")
                <div class="position-relative">
                    <label class="form-label">{{$setting->name}}</label>

                    <input class="form-control"  name="setting[{{$setting->key}}]" value="{{$setting->value}}">

                </div>
            @endif
            @if($setting->type=="text")
                <div class="position-relative">
                    <label class="form-label">{{$setting->name}}</label>

                    <textarea class="form-control" name="setting[{{$setting->key}}]"  rows="3">{{$setting->value}}</textarea>
                </div>
            @endif
            @if($setting->type=="picture")
                <div class="form-group">
                    <label for="field-productimage-9c7c11177efc1f6324289cdeac3110f5946a182a" class="form-label">
                        {{$setting->name}}
                        
                    </label>
                
                    <div data-controller="picture"
                        data-picture-value="{{$setting->value}}"
                        data-picture-storage="images_site"
                        data-picture-target="url"
                        data-picture-url=""
                        data-picture-max-file-size="2"
                        data-picture-accepted-files="image/*"
                        data-picture-groups=""
                        data-picture-path="">
                        <div class="border-dashed text-end p-3 picture-actions">

                            <div class="fields-picture-container">
                                <img src="#" class="picture-preview img-fluid img-full mb-2 border" alt="">
                            </div>

                            <span class="mt-1 float-start">{{__('Upload image from your computer:')}}</span>

                            <div class="btn-group">
                                <label class="btn btn-default m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="me-2" viewBox="0 0 16 16" role="img" id="field-productimage-9c7c11177efc1f6324289cdeac3110f5946a182a" path="bs.cloud-arrow-up" componentName="orchid-icon">
                                        <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708z"></path>
                                        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"></path>
                                    </svg>


                                    {{__('Review')}}
                                    <input type="file"
                                        accept="image/*"
                                        data-picture-target="upload"
                                        data-action="change->picture#upload"
                                        class="picture-input d-none">
                                </label>

                                <button type="button" class="btn btn-outline-danger picture-remove"
                                    data-action="picture#clear">Удалить</button>
                            </div>

                            <input type="file"
                                accept="image/*"
                                class="d-none">
                        </div>

                        <input class="picture-path d-none"
                            type="text"
                            value="{{$setting->value}}"
                            data-picture-target="source"
                            target="url" name="setting[{{$setting->key}}]" title="Основное изображения" id="field-productimage-9c7c11177efc1f6324289cdeac3110f5946a182a"
                        >
                    </div>

                </div>
            @endif

            @if($setting->type=="edit")
                <div class="form-group">
                    <label class="form-label">
                        {{$setting->name}}
                        
                    </label>
                
                    <div data-controller="ckeditor"
                        data-ckeditor-id-value="field-productdescription-ua-0f6a88b6c640aa41386250cf3cc53f716a969930"
                        data-ckeditor-options-value="{&quot;filebrowserImageBrowseUrl&quot;:&quot;\/filemanager?type=Images&quot;,&quot;filebrowserImageUploadUrl&quot;:&quot;\/filemanager\/upload?type=Images&amp;_token=&quot;,&quot;filebrowserBrowseUrl&quot;:&quot;\/filemanager?type=Files&quot;,&quot;filebrowserUploadUrl&quot;:&quot;\/filemanager\/upload?type=Files&amp;_token=&quot;}"
                        data-ckeditor-editor-url-value="//cdn.ckeditor.com/4.16.2/full/ckeditor.js">
                        <div data-ckeditor-target="editor"></div>

                        <input id="field-productdescription-ua-0f6a88b6c640aa41386250cf3cc53f716a969930"
                            data-ckeditor-target="input"
                            name="setting[{{$setting->key}}]"
                            type="hidden"
                            class="form-control"
                            value="{{$setting->value}}"
                        />
                    </div>
                </div>

            @endif
            @if($setting->type=="checkbox")
                <div class="form-check">
                    <input hidden="" name="setting[{{$setting->key}}]" value="0">
                    <input value="1" novalue="0" yesvalue="1" type="checkbox" class="form-check-input"  name="setting[{{$setting->key}}]" title="setting[{{$setting->value}}]" id="field-productis-publish-d2fcc4210a2eda3cc1b106b913f96ad0eb1e6e1d" {{$setting->value ? 'checked' : ''}}>
                    <label class="form-check-label" for="field-productis-publish-d2fcc4210a2eda3cc1b106b913f96ad0eb1e6e1d">{{$setting->name}}</label>
                </div>
            @endif
            
        @endforeach
    </form>
</div>
