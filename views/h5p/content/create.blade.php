@extends(config('laravel-h5p.layout'))

@section('h5p')
    <div class="container-fluid p-3">

        <div class="row">

            <div class="col-md-12">

                <form method="POST" action="{{ route('h5p.store') }}" class="form-horizontal" id="laravel-h5p-form"
                    enctype="multipart/form-data">
                    <input type="hidden" name="library" id="laravel-h5p-library" value="{{ $library }}">
                    <input type="hidden" name="parameters" id="laravel-h5p-parameters" value="{{ $parameters }}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="nonce" value="{{ $nonce }}">

                    <fieldset>

                        <div id="laravel-h5p-create" class="form-group {{ $errors->has('parameters') ? 'has-error' : '' }}">
                            <label for="inputParameters"
                                class="control-label">{{ trans('laravel-h5p.content.parameters') }}</label>
                            <div>
                                <div>
                                    <div id="laravel-h5p-editor">{{ trans('laravel-h5p.content.loading_content') }}</div>
                                </div>

                                @if ($errors->has('parameters'))
                                    <span class="help-block">
                                        {{ $errors->first('parameters') }}
                                    </span>
                                @endif

                            </div>
                        </div>



                        <div class="form-group laravel-h5p-upload-container">
                            <label for="inputUpload"
                                class="control-label col-md-3">{{ trans('laravel-h5p.content.upload') }}</label>
                            <div class="col-md-9">
                                <input type="file" name="h5p_file" id="h5p-file"
                                    class="laravel-h5p-upload form-control" />
                                <small class="h5p-disable-file-check helper-block">
                                    <label class="">
                                        <input type="checkbox" name="h5p_disable_file_check" id="h5p-disable-file-check" />
                                        {{ trans('laravel-h5p.content.upload_disable_extension_check') }}
                                    </label>
                                </small>

                                @if ($errors->has('library'))
                                    <span class="help-block">
                                        {{ $errors->first('upload') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--
                <div class="form-group {{ $errors->has('action') ? 'has-error' : '' }}">
                    <label for="inputAction" class="control-label col-md-3">{{ trans('laravel-h5p.content.action') }}</label>
                    <div class="col-md-6">

                        <label class="radio-inline">
                            <input type="radio" name="action" value="upload" class="laravel-h5p-type" >{{ trans('laravel-h5p.content.action_upload') }}
                        </label> --}}
                        <label class="radio-inline d-none">
                            <input type="radio" name="action" value="create" class="laravel-h5p-type"
                                checked="checked" />{{ trans('laravel-h5p.content.action_create') }}
                        </label>
                        {{--

                        @if ($errors->has('action'))
                        <span class="help-block">
                            {{ $errors->first('action') }}
                        </span>
                        @endif
                    </div>
                </div> --}}



                        @if (config('laravel-h5p.h5p_show_display_option'))
                            <div class="form-group h5p-sidebar">
                                <label class="control-label col-md-3">{{ trans('laravel-h5p.content.display') }}</label>
                                <div class="col-md-9">

                                    <div class="form-control-static">

                                        <ul class="list-unstyled">

                                            <li>
                                                <label>
                                                    <input type="checkbox" name="frame" id="laravel-h5p-frame" class="h5p-visibility-toggler" data-h5p-visibility-subject-selector=".h5p-action-bar-buttons-settings" value="1" {{ $display_options[H5PCore::DISPLAY_OPTION_FRAME] ? 'checked' : '' }}>
                                                    {{ trans('laravel-h5p.content.display_toolbar') }}
                                                </label>
                                            </li>

                                            @if (isset($display_options[H5PCore::DISPLAY_OPTION_DOWNLOAD]))
                                                <li>
                                                    <label>
                                                       <input type="checkbox" name="download" id="laravel-h5p-download" class="h5p-visibility-toggler" data-h5p-visibility-subject-selector=".h5p-action-bar-buttons-settings" value="1" {{ $display_options[H5PCore::DISPLAY_OPTION_DOWNLOAD] ? 'checked' : '' }}>

                                                        {{ trans('laravel-h5p.content.display_download_button') }}
                                                    </label>
                                                </li>
                                            @endif

                                            @if (isset($display_options[H5PCore::DISPLAY_OPTION_EMBED]))
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="embed" id="laravel-h5p-embed" class="h5p-visibility-toggler" data-h5p-visibility-subject-selector=".h5p-action-bar-buttons-settings" value="1" {{ $display_options[H5PCore::DISPLAY_OPTION_EMBED] ? 'checked' : '' }}>

                                                        {{ trans('laravel-h5p.content.display_embed_button') }}
                                                    </label>
                                                </li>
                                            @endif

                                            @if (isset($display_options[H5PCore::DISPLAY_OPTION_COPYRIGHT]))
                                                <li>
                                                    <label>
                                                        <input type="checkbox" name="copyright" id="laravel-h5p-copyright" class="h5p-visibility-toggler" data-h5p-visibility-subject-selector=".h5p-action-bar-buttons-settings" value="1" {{ $display_options[H5PCore::DISPLAY_OPTION_COPYRIGHT] ? 'checked' : '' }}>
                                                        {{ trans('laravel-h5p.content.display_copyright_button') }}
                                                    </label>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>

                                </div>

                            </div>
                        @endif


                        <div class="form-group">
                            <div class="d-flex justify-content-between w-100">
                                <div></div>

                                <div>
                                    <a href="{{ route('h5p.index') }}" class="btn btn-default"><i class="fa fa-reply"></i>
                                        {{ trans('laravel-h5p.content.cancel') }}</a>

                                    <button type="submit" class="btn btn-primary" id="save-button" data-loading-text="{{ trans('laravel-h5p.content.saving') }}">{{ trans('laravel-h5p.content.save') }}</button>

                                </div>

                            </div>

                        </div>


                    </fieldset>




                </form>

            </div>

        </div>

    </div>

@endsection

@push('h5p-header-script')
    {{--    core styles       --}}
    @foreach ($settings['core']['styles'] as $style)
       <link rel="stylesheet" href="{{ $style }}">

    @endforeach
@endpush

@push('h5p-footer-script')
    <script type="text/javascript">
        H5PIntegration = {!! json_encode($settings) !!};
    </script>

    {{--    core script       --}}
    @foreach ($settings['core']['scripts'] as $script)
        <script src="{{ $script }}"></script>
    @endforeach

    <script>
        H5P.jQuery(document).ready(function() {
            H5P.jQuery('#save-button').click(function() {
                setTimeout(() => {
                    H5P.jQuery(this).prop('disabled', 'disabled');
                    H5P.jQuery('.h5p-delete').prop('disabled', 'disabled');
                }, 50);
            })
        });
    </script>
@endpush
