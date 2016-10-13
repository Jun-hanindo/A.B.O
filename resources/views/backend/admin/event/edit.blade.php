@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.events') }} - {{ trans('general.add') }} {{ trans('general.event') }}
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
        .input-group[class*=col-]{
            padding: 0 15px;
        }
        #date_at, #start_date, #end_date{
            border-radius: 0;
        }
        img[src=""] {
            display: none;
        }
        #discount-percent, #discount-nominal{
            margin-left: 10px;
        }
        .discount .bootstrap-switch{
            float: left;
        }
    </style>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.event') }} {{ trans('general.registration') }} </h3>
                </div>
                {!! Form::open(array('url' => route('admin-update-event',$data->id),'files'=>'true','method'=>'POST','id'=>'form-event')) !!}
                    <div class="box-body">
                        <div class="error"></div>
                        <div class="col-md-9">
                            <input type="hidden" name="event_id" class="form-control" id="event_id" value={{ $data->id }}>
                            <input type="hidden" name="count_schedule" class="form-control" id="count_schedule">
                            <div class="form-group{{ Form::hasError('title') }} title">
                                {!! Form::label('title', trans('general.title').' *') !!}
                                {!! Form::text('title', $data->title, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.title')]) !!}
                                {!! Form::errorMsg('title') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('slug') }} slug">
                                {!! Form::label('slug', trans('general.slug').' *') !!}
                                {!! Form::text('slug', $data->slug, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.slug')]) !!}
                                {!! Form::errorMsg('slug') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::label('description', trans('general.description').' *') !!}
                                {!! Form::textarea('description', $data->description, ['class' => 'form-control tinymce', 'rows'=> '12', 'placeholder' => trans('general.description')]) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('admission') }} admission">
                                {!! Form::label('admission', trans('general.admission')) !!}
                                {!! Form::textarea('admission', $data->admission, ['class' => 'form-control tinymce', 'rows'=> '7', 'placeholder' => trans('general.admission')]) !!}
                                {!! Form::errorMsg('admission') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('schedule_info') }} schedule_info">
                                {!! Form::label('schedule_info', trans('general.schedule_info')) !!}
                                {!! Form::textarea('schedule_info', $data->schedule_info, ['class' => 'form-control tinymce', 'rows'=> '7', 'placeholder' => trans('general.schedule_info')]) !!}
                                {!! Form::errorMsg('schedule_info') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('price_info') }} price_info">
                                {!! Form::label('price_info', trans('general.price_info')) !!}
                                {!! Form::textarea('price_info', $data->price_info, ['class' => 'form-control tinymce', 'rows'=> '7', 'placeholder' => trans('general.price_info')]) !!}
                                {!! Form::errorMsg('price_info') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('schedule_and_price_detail') }} schedule_and_price_detail">
                                {!! Form::label('schedule_and_price_detail', trans('general.schedule_and_price_detail').' *') !!}
                                {!! Form::hidden('schedule_and_price_detail', null, ['class' => 'form-control', 'id' => 'schedule_and_price_detail','maxlength'=>'255', 'placeholder' => trans('general.schedule_and_price_detail')]) !!}
                                {!! Form::errorMsg('schedule_and_price_detail') !!}
                                <table id="event-schedule-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                                    <thead>
                                        <tr>
                                            <th class="center-align"></th>
                                            <th>{{ trans('general.date') }}</th>
                                            <th>{{ trans('general.time') }}</th>
                                            <!-- <th class="center-align">{{ trans('general.info') }}</th>
                                            <th>{{ trans('general.price') }}</th> -->
                                        </tr>
                                    </thead>
                                </table>
                                <a class="actAdd add-underline" data-name="schedule" href="javascript:void(0)" title="{{ trans('general.add_more_schedules_and_prices') }}"><u>+ {{ trans('general.add_more_schedules_and_prices') }}</u></a>
                            </div>
                            <div class="form-group{{ Form::hasError('promotion') }} promotion">
                                {!! Form::label('promotion', trans('general.promotion')) !!}
                                <table id="event-promotion-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                                    <thead>
                                        <tr>
                                            <th class="center-align"></th>
                                            <th>{{ trans('general.title') }}</th>
                                            <th>{{ trans('general.date') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                                <a class="addPromotion add-underline" data-name="promotion" href="javascript:void(0)" title="{{ trans('general.add_more_promotion') }}"><u>+ {{ trans('general.add_more_promotion') }}</u></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('featured_image1') }} featured_image1">
                                {!! Form::label('featured_image1', trans('general.featured_image1').'(2880px x 1000px) *') !!}
                                <input id="featured_image1" name="featured_image1" class="form-control image" data-name="image1" type="file" value="{{$data->featured_image1}}">
                                {!! Form::errorMsg('featured_image1') !!}
                            </div>
                            <div class="form-group preview" id="div-preview_image1" data-name="image1">
                                <img src="{{ (!empty($data->featured_image1)) ? file_url('events/'.$data->featured_image1, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_image1" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image2') }} featured_image2">
                                {!! Form::label('featured_image2', trans('general.featured_image2').'(1125px x 762px) *') !!}
                                <input id="featured_image2" name="featured_image2" class="form-control image" data-name="image2" type="file" value="{{$data->featured_image2}}">
                                {!! Form::errorMsg('featured_image2') !!}
                                
                            </div>
                            <div class="form-group preview" id="div-preview_image2" data-name="image2">
                                <img src="{{ (!empty($data->featured_image2)) ? file_url('events/'.$data->featured_image2, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_image2" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image3') }} featured_image3">
                                {!! Form::label('featured_image3', trans('general.featured_image3').'(300px x 200px) *') !!}
                                <input id="featured_image3" name="featured_image3" class="form-control image" data-name="image3" type="file" value="{{$data->featured_image3}}">
                                {!! Form::errorMsg('featured_image3') !!}
                            </div>
                            <div class="form-group preview" id="div-preview_image3" data-name="image3">
                                <img src="{{ (!empty($data->featured_image3)) ? file_url('events/'.$data->featured_image3, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_image3" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('share_image') }} share_image">
                                <label for="share_image">Social Media Sharing Image<br>(1200px x 630px) *</label>
                                <input id="share_image" name="share_image" class="form-control image" data-name="share_image" type="file" value="{{$data->share_image}}">
                                {!! Form::errorMsg('share_image') !!}
                            </div>
                            <div class="form-group preview" id="div-preview_share_image" data-name="share_image">
                                <img src="{{ (!empty($data->share_image)) ? file_url('events/'.$data->share_image, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_share_image" height="50%" width="50%">
                            </div>
                            <div class="form-group{{ Form::hasError('event_type') }} event_type">
                                {!! Form::label('event_type', trans('general.event_type').' *', array('class' => 'full-width')) !!}
                                {!! Form::select('event_type', array('1' => 'General',
                                        '0' => 'Seated'), $data->event_type, ['class' => 'form-control event_type', 'id' => 'event_type']) !!}
                                
                            </div>
                            <div id="seat_image-div" style="display:{{ ($data->event_type == false) ? 'block' : 'none' }}">
                                <div class="form-group{{ Form::hasError('seat_image') }} seat_image">
                                    {!! Form::label('seat_image', trans('general.seat_image').' *') !!}
                                    <input id="seat_image" name="seat_image" class="form-control image" data-name="seat_image" type="file" value="{{$data->seat_image}}">
                                    {!! Form::errorMsg('seat_image') !!}
                                </div>
                                <div class="form-group preview" id="div-preview_seat_image" data-name="seat_image">
                                    <img src="{{ (!empty($data->seat_image)) ? file_url('events/'.$data->seat_image, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_seat_image" height="50%" width="50%">
                                </div>

                                <div class="form-group{{ Form::hasError('seat_image2') }} seat_image2">
                                    {!! Form::label('seat_image2', trans('general.seat_image2')) !!} {!! (!empty($data->seat_image2)) ? '<a href="javascript:void(0)" data-id="seat_image2" data-value="'.$data->seat_image2.'" class="btn btn-danger btn-xs delete-seat_image2" title="Delete Seat Image 2"><i class="fa fa-trash-o fa-fw"></i></a>' : '' !!}
                                    <input id="seat_image2" name="seat_image2" class="form-control image" data-name="seat_image2" type="file" value="{{$data->seat_image2}}">
                                    {!! Form::errorMsg('seat_image2') !!}
                                </div>
                                <div class="form-group preview" id="div-preview_seat_image2" data-name="seat_image2">
                                    <img src="{{ (!empty($data->seat_image2)) ? file_url('events/'.$data->seat_image2, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_seat_image2" height="50%" width="50%">
                                </div>

                                <div class="form-group{{ Form::hasError('seat_image3') }} seat_image3">
                                    {!! Form::label('seat_image3', trans('general.seat_image3')) !!} {!! (!empty($data->seat_image3)) ? '<a href="javascript:void(0)" data-id="seat_image3" data-value="'.$data->seat_image3.'" class="btn btn-danger btn-xs delete-seat_image3" title="Delete Seat Image 3"><i class="fa fa-trash-o fa-fw"></i></a>' : '' !!}
                                    <input id="seat_image3" name="seat_image3" class="form-control image" data-name="seat_image3" type="file" value="{{$data->seat_image3}}">
                                    {!! Form::errorMsg('seat_image3') !!}
                                </div>
                                <div class="form-group preview" id="div-preview_seat_image3" data-name="seat_image3">
                                    <img src="{{ (!empty($data->seat_image3)) ? file_url('events/'.$data->seat_image3, env('FILESYSTEM_DEFAULT')) : '' }}" name="preview" id="preview_seat_image3" height="50%" width="50%">
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('venue') }} venue">
                                {!! Form::label('venue_id', trans('general.venue').' *') !!}
                                {!! Form::select('venue_id', $data['dropdown'], $data->venue_id, array('class' => 'form-control','data-option' => old('venue_id'))) !!}
                                {!! Form::errorMsg('venue_id') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('buylink') }} buylink">
                                {!! Form::label('buylink', trans('general.buylink').' *') !!}
                                {!! Form::text('buylink', $data->buylink, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.buylink')]) !!}
                                {!! Form::errorMsg('buylink') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('video_link') }} video_link">
                                {!! Form::label('video_link', trans('general.video_link').' ('.trans('general.embed').')') !!}
                                {!! Form::text('video_link', $data->video_link, ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.video_link')]) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('categories') }} category">
                                {!! Form::label('category', trans('general.category').' *') !!} <a href="javascript:void(0)" class="btn btn-primary btn-xs addCategory" title="Edit"><i class="fa fa-plus fa-fw"></i></a>
                                {!! Form::select('categories[]', $data['categories'], $data['selected'], ['class' => 'form-control categories', 'multiple' => 'multiple', 'id' => 'categories']) !!}
                                {!! Form::errorMsg('categories') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('background_color') }} background_color">
                                {!! Form::label('background_color', trans('general.background_color').' *') !!}
                                {!! Form::text('background_color', $data->background_color, ['id' => 'background_color', 'class' => 'form-control colorpicker','maxlength'=>'255', 'placeholder' => trans('general.background_color')]) !!}
                                {!! Form::errorMsg('background_color') !!}
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('admin-index-event') }}" class="btn btn-default">{{ trans('general.button_back') }}</a>
                                <button type="button" id="button_draft" class="btn btn-warning" title="{{ trans('general.button_draft') }}">{{ trans('general.button_draft') }}</button>
                                <input class="btn btn-primary pull-right" title="{{ trans('general.button_save') }}" type="submit" value="{{ trans('general.button_publish') }}" id="button_submit">
                                <a id="button_preview" class="btn btn-success btn-preview" title="{{ trans('general.button_preview') }}">{{ trans('general.button_preview') }}</a>
                            </div>
                        </div>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form-schedule" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalLabel"><span id="title-create-schedule" style="display:none">{{ trans('general.add_schedule_and_price') }}</span><span id="title-update-schedule" style="display:none">{{ trans('general.edit') }}</span></h4>
                </div>
                <div class="modal-body">
                    <div class="error-modal"></div>
                    <form class="form-horizontal" id="form-event-schedule">
                        <input type="hidden" name="id" class="form-control" id="schedule_id">
                        <div class="form-group date_at">
                            {!! Form::label('date_at', trans('general.date').' *', array('class' => 'col-sm-3 control-label pull-left')) !!}
                            <div class="col-sm-4">
                                <input type="text" name="date_at" class="form-control datepicker" id="date_at" maxlength="255">
                            </div>
                        </div>
                        <div class="form-group time">
                            {!! Form::label('time', trans('general.time').' *', array('class' => 'col-sm-3 control-label')) !!}
                            <div class="col-sm-3">
                                <input type="text" name="start_time" class="form-control timepicker" id="start_time" maxlength="255" placeholder = {{trans('general.start_time')}}>
                            </div>
                            {!! Form::label('end_time', '-', array('class' => 'col-sm-1 control-label')) !!}
                            <div class="col-sm-3">
                                <input type="text" name="end_time" class="form-control timepicker" id="end_time" maxlength="255" placeholder = {{trans('general.end_time')}}>
                            </div>
                        </div>
                        <div class="form-group description_schedule">
                            {!! Form::label('description_schedule', trans('general.description'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                            <div class="col-sm-9">
                                <input type="text" name="description_schedule" class="form-control" id="description_schedule" maxlength="255">
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('price_detail') }} price_detail">
                            {!! Form::label('schedule_info', trans('general.price_detail'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                        </div>
                        <table id="event-schedule-category-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                            <thead>
                                <tr>
                                    <th width="20%" class="center-align"></th>
                                    <th width="40%" class="center-align">{{ trans('general.price_name') }}</th>
                                    <th width="20%">{{ trans('general.price') }}</th>
                                    <th width="15%">{{ trans('general.seat_color') }}</th>
                                </tr>
                            </thead>
                        </table>
                        <a class="actAddCategory add-underline" href="javascript:void(0)" title="{{ trans('general.add_schedule_category') }}"><u>+ {{ trans('general.add_schedule_category') }}</u></a>
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" id="button_save_schedule" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
                <button type="button" id="button_update_schedule" class="btn btn-primary" title="{{ trans('general.button_update') }}">{{ trans('general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-form-category" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalLabel"><span id="title-create-category" style="display:none">{{ trans('general.add_schedule_and_price') }}</span><span id="title-update-category" style="display:none">{{ trans('general.edit') }}</span></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form-event-category">
                        <input type="hidden" name="id" class="form-control" id="category_id">
                        <div class="form-group">
                            {!! Form::label('additional_info', trans('general.price_name').' *', array('class' => 'col-sm-3 control-label pull-left')) !!}
                            <div class="col-sm-9">
                                {!! Form::text('additional_info', old('additional_info'), ['class' => 'form-control', 'rows'=> '5', 'placeholder' => trans('general.price_name')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', trans('general.price'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                            <div class="col-sm-9 input-group currency-value">
                                {!! Form::select('currency_id', $data['currencies'], $data['currency_sel'], array('data-default' => $data['currency_sel'], 'id' => 'currency_id', 'class' => 'form-control','data-option' => old('currency_id'))) !!}
                                {!! Form::text('price', old('price'), ['class' => 'form-control number-only','maxlength'=>'255']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('seat_color', trans('general.seat_color'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                            <div class="col-sm-4">
                                {!! Form::text('seat_color', old('seat_color'), ['class' => 'form-control colorpicker', 'rows'=> '5', 'placeholder' => trans('general.seat_color')]) !!}
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="col-sm-4  col-sm-offset-3">
                                {!! Form::select('price_cat', array('/person' => '/person'), old('role'), array('class' => 'form-control','data-option' => old('price_cat'))) !!}
                            </div>
                        </div> --}}
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" id="button_save_category" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
                <button type="button" id="button_update_category" class="btn btn-primary" title="{{ trans('general.button_update') }}">{{ trans('general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="modal-form-promotion" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalLabel"><span id="title-create-promotion" style="display:none">{{ trans('general.add_promotion') }}</span><span id="title-update-promotion" style="display:none">{{ trans('general.edit') }}</span></h4>
                </div>
                <div class="modal-body">
                    <div class="error-modal"></div>
                    <form id="form-event-promotion">
                        <input type="hidden" name="id" class="form-control" id="promotion_id">
                            <div class="form-group{{ Form::hasError('title_promo') }} title_promo">
                                {!! Form::label('title_promo', trans('general.title').' *') !!}
                                {!! Form::text('title_promo', old('title_promo'), ['id' => 'title_promo', 'class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.title')]) !!}
                                {!! Form::errorMsg('title_promo') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description_promo') }} description_promo">
                                {!! Form::label('description_promo', trans('general.description').' *') !!}
                                {!! Form::textarea('description_promo', old('description_promo'), ['id' => 'description_promo', 'class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('general.description')]) !!}
                                {!! Form::errorMsg('description_promo') !!}
                            </div>


                            <div class="form-group{{ Form::hasError('discount') }} discount {{ Form::hasError('discount_nominal') }} discount_nominal full-width">
                                {!! Form::label('discount', trans('general.discount').' *', array('class' => 'full-width ')) !!}
                                {!! Form::checkbox('discount_type', '1', null, ['class' => 'form-control pull-left discount_type-check', 'data-animate' => 'false', 'data-on-text' => 'Percent',  'data-off-color' => 'success', 'data-off-text' => 'Nominal']) !!}
                                <div id="discount-percent" class="pull-left col-sm-3">
                                    <div class="input-group ">
                                        {!! Form::text('discount', old('discount'), ['id' => 'discount', 'class' => 'form-control number-only percent','maxlength'=>'255', 'placeholder' => trans('general.discount')]) !!}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                    {!! Form::errorMsg('discount') !!}
                                </div>
                                <div id="discount-nominal" class="pull-left col-sm-4" style="display:none">
                                    <div class="input-group currency-value">
                                        {!! Form::select('currency_id', $data['currencies'], $data['currency_sel'], array('data-default' => $data['currency_sel'], 'id' => 'currency_id', 'class' => 'form-control','data-option' => old('currency_id'))) !!}
                                        {!! Form::text('discount_nominal', old('discount_nominal'), ['id' => 'discount_nominal', 'class' => 'form-control number-only nominal','maxlength'=>'255', 'placeholder' => trans('general.discount')]) !!}
                                    </div>
                                    {!! Form::errorMsg('discount_nominal') !!}
                                </div>
                            </div>

                            <div class="form-group{{ Form::hasError('discount_period') }} discount_period full-width">
                                {!! Form::label('discount_period', trans('general.discount_period').' *', array('class' => 'full-width ')) !!}
                                <div class="col-sm-3 row form-group{{ Form::hasError('start_date') }} start_date">
                                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control  datepicker', 'id' => 'start_date', 'maxlength'=>'255', 'placeholder' => trans('general.start_date')]) !!}
                                    {!! Form::errorMsg('start_date') !!}
                                </div>
                                {!! Form::label('to', trans('general.to'), array('class' => 'col-sm-1 control-label')) !!}
                                <div class="col-sm-3 row form-group{{ Form::hasError('end_date') }} end_date">
                                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control  datepicker', 'id' => 'end_date','maxlength'=>'255', 'placeholder' => trans('general.end_date')]) !!}
                                    {!! Form::errorMsg('end_date') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('promotion_code') }} promotion_code full-width">
                                {!! Form::label('promotion_code', trans('general.promotion_code'), array('class' => 'full-width ')) !!}
                                <div class="col-sm-4 row">
                                    {!! Form::text('promotion_code', old('promotion_code'), ['id' => 'promotion_code', 'class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('general.promotion_code')]) !!}
                                    {!! Form::errorMsg('promotion_code') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('featured_image') }} featured_image">
                                {!! Form::label('featured_image', trans('general.featured_image').'(50px x 30px) *') !!}
                                <input id="featured_image" name="featured_image" class="form-control image" data-name="image" type="file" value="">
                                {!! Form::errorMsg('featured_image') !!}
                            </div>
                            <div class="form-group privew" id="div-preview_image" data-name="image" style="display:none">
                                <img src="" name="preview" id="preview_image" height="20%" width="20%">
                            </div>
                            <div class="form-group{{ Form::hasError('category') }} category">
                                {!! Form::label('category', trans('general.category')) !!}
                                {!! Form::select('category', array('discounts' => 'Discounts',
                                                                'lucky-draws' => 'Lucky Draws', 
                                                                'early-bird' => 'Early Bird'), old('category'), ['class' => 'form-control category', 'id' => 'category']) !!}
                                {!! Form::errorMsg('category') !!}
                            </div>
                    </form>
                </div>
            <div class="modal-footer">
                <button type="button" id="button_save_promotion" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
                <button type="button" id="button_update_promotion" class="btn btn-primary" title="{{ trans('general.button_update') }}">{{ trans('general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-form-cat" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ModalLabel"><span id="title-create-cat" style="display:none">{{ trans('general.create_new') }}</span></h4>
          </div>
          <div class="modal-body">
            <div class="error-modal-cat"></div>
            <form id="form-cat">
                <input type="hidden" name="id" class="form-control" id="id-cat">
                <div class="form-group name">
                    <label for="event" class="control-label">{{ trans('general.name') }} *</label>
                    {!! Form::text('name-cat', old('name'), array('id' => 'name-cat', 'class' => 'form-control')) !!}
                </div>
                <div class="form-group icon">
                    <label for="event" class="control-label">{{ trans('general.icon') }} *</label>

                    <select name="icon" id="icon-cat" class="form-control selectpicker" data-live-search="true">
                        @if(!empty($data['icons']))
                            @foreach ($data['icons'] as $icon)
                                <optgroup label="{!! $icon['name'] !!}">
                                    @if (isset($icon['child']))
                                        @foreach($icon['child'] as $child)
                                            <option value="{!! $child['name'] !!}" data-icon="fa fa-{!! $child['name'] !!}">icon-{!! $child['name'] !!}</option>
                                        @endforeach
                                    @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group description">
                    <label for="event" class="control-label">{{ trans('general.description') }}  *</label>
                    {!! Form::textarea('description-cat', old('description'), array('id' => 'description-cat', 'class' => 'form-control tinymce')) !!}
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="button_save-cat" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
          </div>
        </div>
      </div>
    </div>



    <div id="delete-modal-schedule" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-schedule" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="delete-modal-category" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-category" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div id="delete-modal-promotion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-promotion" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div id="delete-modal-seat-image" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('general.confirmation_delete') }} <strong id="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'destroy', 'method' => 'DELETE']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;
                        <a id="delete-modal-seat-image" href="#" class="continue-delete btn btn-default" data-dismiss="modal">Continue</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.event.script.create_script')