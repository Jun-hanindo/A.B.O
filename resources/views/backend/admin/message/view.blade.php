@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('backend/general.inbox') }} - {{ trans('backend/general.message') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('backend/general.message_detail') }} </h3>
                    <span class="date pull-right">{{ short_text_date_time($data->created_at) }}</span>
                </div>
                <div class="box-body">
                    <div class="error"></div>
                    <div class="form-group">
                        {!! Form::label('subject', trans('backend/general.subject'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            <div class="form-control no-border nopadding">: {{ $data->subject }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', trans('backend/general.name'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            <div class="form-control no-border nopadding">: {{ $data->name }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', trans('backend/general.email'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            <div class="form-control no-border nopadding">: {{ $data->email }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('contact_number', trans('backend/general.contact_number'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            <div class="form-control no-border nopadding">: {{ $data->contact_number }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('message', trans('backend/general.message'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            <div class="form-control no-border nopadding">: {{ $data->message }}</div>
                        </div>
                    </div>
                </div>
                <div class="list-reply">
                    @if(isset($replies))
                        @foreach($replies as $key => $reply)
                            <div class="box-footer">
                                <div class="date text-right">{{ short_text_date_time($reply->created_at) }}</div>
                                {!! Form::label('reply_by', trans('backend/general.reply_by'), ['class' => 'col-sm-3 control-label']) !!}
                                @php
                                    $user_name = $reply->user;
                                @endphp
                                <div class="col-sm-9">
                                    <div class="form-control no-border nopadding">: {{ $user_name->first_name.' '.$user_name->last_name }}</div>
                                </div>
                                {!! Form::label('message', trans('backend/general.message'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    <div class="form-control no-border nopadding">: {{ $reply->message }}</div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="box-footer" id="reply-message" style="display:none">
                    {!! Form::open(array('url' => route('admin-post-reply-message'),'method'=>'POST','id'=>'form-reply')) !!}
                        {!! Form::hidden('message_id', $data->id, array('id' => 'message_id', 'class' => 'form-control')) !!}
                        {!! Form::hidden('message_email', $data->email, array('id' => 'message_email', 'class' => 'form-control')) !!}
                        {!! Form::hidden('message_subject', 'Reply '.$data->subject, array('id' => 'message_subject', 'class' => 'form-control')) !!}
                        {!! Form::hidden('message_name', $data->name, array('id' => 'message_name', 'class' => 'form-control')) !!}
                        <div class="form-group{{ Form::hasError('message') }} message">
                            {!! Form::textarea('message', old('message'), ['class' => 'form-control', 'rows'=> '5', 'placeholder' => trans('backend/general.message')]) !!}
                            {!! Form::errorMsg('message') !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="box-footer">
                    <a href="{{ route('admin-index-message') }}" class="btn btn-default">{{ trans('backend/general.button_back') }}</a>
                    <button type="button" id="button_reply" class="btn btn-primary pull-right" title="{{ trans('backend/general.button_reply') }}">{{ trans('backend/general.button_reply') }}</button>
                    <button type="button" id="button_send" class="btn btn-primary pull-right" title="{{ trans('backend/general.button_send') }}" style="display:none">{{ trans('backend/general.button_send') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.message.script.view_script')