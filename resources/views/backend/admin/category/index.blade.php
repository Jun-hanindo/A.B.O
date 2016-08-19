@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('general.homepages') }}
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.event_categories') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary actAdd" href="javascript:void(0)" title="{{ trans('general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <table id="event-categories-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">Name</th>
                        <th class="center-align">Description</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ModalLabel"><span id="title-create" style="display:none">{{ trans('general.create_new') }}</span><span id="title-update" style="display:none">{{ trans('general.edit') }}</span></h4>
          </div>
          <div class="modal-body">
            <div class="error-modal"></div>
            <form id="form">
                <input type="hidden" name="id" class="form-control" id="id">
                <div class="form-group name">
                    <label for="event" class="control-label">{{ trans('general.name') }} :</label>
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control')) !!}
                    {!! Form::errorMsg('name') !!}
                </div>
                <div class="form-group icon">
                    <label for="event" class="control-label">{{ trans('general.icon') }} :</label>
                    <select name="icon" id="icon" class="form-control selectpicker">
                        <optgroup label="Web Application Icons">
                            <option value="adjust" data-icon="fa fa-adjust">icon-adjust</option>
                            <option value="asterisk" data-icon="fa fa-asterisk">icon-asterisk</option>
                            <option value="ban" data-icon="fa fa-ban">icon-ban</option>
                            <option value="bar-chart" data-icon="fa fa-bar-chart">icon-bar-chart</option>
                            <option value="barcode" data-icon="fa fa-barcode">icon-barcode</option>
                            <option value="beer" data-icon="fa fa-beer">icon-beer</option>
                            <option value="bell" data-icon="fa fa-bell">icon-bell</option>
                            <option value="bell-o" data-icon="fa fa-bell-o">icon-bell-o</option>
                            <option value="birthday-cake" data-icon="fa fa-birthday-cake">icon-birthday-cake</option>
                            <option value="bolt" data-icon="fa fa-bolt">icon-bolt</option>
                            <option value="book" data-icon="fa fa-book">icon-book</option>
                            <option value="bookmark" data-icon="fa fa-bookmark">icon-bookmark</option>
                            <option value="bookmark-o" data-icon="fa fa-bookmark-o">icon-bookmark-o</option>
                            <option value="briefcase" data-icon="fa fa-briefcase">icon-briefcase</option>
                            <option value="bullhorn" data-icon="fa fa-bullhorn">icon-bullhorn</option>
                            <option value="calendar" data-icon="fa fa-calendar">icon-calendar</option>
                            <option value="camera" data-icon="fa fa-camera">icon-camera</option>
                            <option value="camera-retro" data-icon="fa fa-camera-retro">icon-camera-retro</option>
                            <option value="certificate" data-icon="fa fa-certificate">icon-certificate</option>
                            <option value="check" data-icon="fa fa-check">icon-check</option>
                            <option value="check-circle" data-icon="fa fa-check-circle">icon-check-circle</option>
                            <option value="child" data-icon="fa fa-child">icon-child</option>
                            <option value="circle" data-icon="fa fa-circle">icon-circle</option>
                            <option value="circle-o" data-icon="fa fa-circle-o">icon-circle-o</option>
                            <option value="cloud" data-icon="fa fa-cloud">icon-cloud</option>
                            <option value="cloud-download" data-icon="fa fa-cloud-download">icon-cloud-download</option>
                            <option value="cloud-upload" data-icon="fa fa-cloud-upload">icon-cloud-upload</option>
                            <option value="coffee" data-icon="fa fa-coffee">icon-coffee</option>
                            <option value="cog" data-icon="fa fa-cog">icon-cog</option>
                            <option value="cogs" data-icon="fa fa-cogs">icon-cogs</option>
                            <option value="comment" data-icon="fa fa-comment">icon-comment</option>
                            <option value="comment-o" data-icon="fa fa-comment-o">icon-comment-o</option>
                            <option value="comments" data-icon="fa fa-comments">icon-comments</option>
                            <option value="comments-o" data-icon="fa fa-comments-o">icon-comments-o</option>
                            <option value="credit-card" data-icon="fa fa-credit-card">icon-credit-card</option>
                            <option value="cutlery" data-icon="fa fa-cutlery">icon-cutlery</option>
                            <option value="dashboard" data-icon="fa fa-dashboard">icon-dashboard</option>
                            <option value="desktop" data-icon="fa fa-desktop">icon-desktop</option>
                            <option value="download" data-icon="fa fa-download">icon-download</option>
                            <option value="edit" data-icon="fa fa-edit">icon-edit</option>
                            <option value="envelope" data-icon="fa fa-envelope">icon-envelope</option>
                            <option value="envelope-o" data-icon="fa fa-envelope-o">icon-envelope-o</option>
                            <option value="exchange" data-icon="fa fa-exchange">icon-exchange</option>
                            <option value="exclamation" data-icon="fa fa-exclamation">icon-exclamation</option>
                            <option value="external-link" data-icon="fa fa-external-link">icon-external-link</option>
                            <option value="eye" data-icon="fa fa-eye">icon-eye</option>
                            <option value="eye-slash" data-icon="fa fa-eye-slash">icon-eye-slash</option>
                            <option value="fighter-jet" data-icon="fa fa-fighter-jet">icon-fighter-jet</option>
                            <option value="film" data-icon="fa fa-film">icon-film</option>
                            <option value="filter" data-icon="fa fa-filter">icon-filter</option>
                            <option value="fire" data-icon="fa fa-fire">icon-fire</option>
                            <option value="flag" data-icon="fa fa-flag">icon-flag</option>
                            <option value="folder" data-icon="fa fa-folder">icon-folder</option>
                            <option value="folder-o" data-icon="fa fa-folder-o">icon-folder-o</option>
                            <option value="folder-open" data-icon="fa fa-folder-open">icon-folder-open</option>
                            <option value="folder-open-o" data-icon="fa fa-folder-open-o">icon-folder-open-o</option>
                            <option value="gift" data-icon="fa fa-gift">icon-gift</option>
                            <option value="glass" data-icon="fa fa-glass">icon-glass</option>
                            <option value="globe" data-icon="fa fa-globe">icon-globe</option>
                            <option value="group" data-icon="fa fa-group">icon-group</option>
                            <option value="hdd-o" data-icon="fa fa-hdd-o">icon-hdd-o</option>
                            <option value="headphones" data-icon="fa fa-headphones">icon-headphones</option>
                            <option value="heart" data-icon="fa fa-heart">icon-heart</option>
                            <option value="heart-o" data-icon="fa fa-heart-o">icon-heart-o</option>
                            <option value="home" data-icon="fa fa-home">icon-home</option>
                            <option value="inbox" data-icon="fa fa-inbox">icon-inbox</option>
                            <option value="info" data-icon="fa fa-info">icon-info</option>
                            <option value="key" data-icon="fa fa-key">icon-key</option>
                            <option value="leaf" data-icon="fa fa-leaf">icon-leaf</option>
                            <option value="laptop" data-icon="fa fa-laptop">icon-laptop</option>
                            <option value="legal" data-icon="fa fa-legal">icon-legal</option>
                            <option value="lemon-o" data-icon="fa fa-lemon-o">icon-lemon-o</option>
                            <option value="lightbulb-o" data-icon="fa fa-lightbulb-o">icon-lightbulb-o</option>
                            <option value="lock" data-icon="fa fa-lock">icon-lock</option>
                            <option value="unlock" data-icon="fa fa-unlock">icon-unlock</option>
                            <option value="magic" data-icon="fa fa-magic">icon-magic</option>
                            <option value="magnet" data-icon="fa fa-magnet">icon-magnet</option>
                            <option value="map-marker" data-icon="fa fa-map-marker">icon-map-marker</option>
                            <option value="microphone" data-icon="fa fa-microphone">icon-microphone</option>
                            <option value="microphone-slash" data-icon="fa fa-microphone-slash">icon-microphone-slash</option>
                            <option value="minus" data-icon="fa fa-minus">icon-minus</option>
                            <option value="minus-circle" data-icon="fa fa-minus-circle">icon-minus-circle</option>
                            <option value="mobile-phone" data-icon="fa fa-mobile-phone">icon-mobile-phone</option>
                            <option value="money" data-icon="fa fa-money">icon-money</option>
                            <option value="music" data-icon="fa fa-music">icon-music</option>
                            <option value="pencil" data-icon="fa fa-pencil">icon-pencil</option>
                            <option value="photo " data-icon="fa fa-photo ">icon-photo </option>
                            <option value="plane" data-icon="fa fa-plane">icon-plane</option>
                            <option value="plus" data-icon="fa fa-plus">icon-plus</option>
                            <option value="plus-circle" data-icon="fa fa-plus-circle">icon-plus-circle</option>
                            <option value="print" data-icon="fa fa-print">icon-print</option>
                            <option value="puzzle-piece" data-icon="fa fa-puzzle-piece">icon-puzzle-piece</option>
                            <option value="qrcode" data-icon="fa fa-qrcode">icon-qrcode</option>
                            <option value="question" data-icon="fa fa-question">icon-question</option>
                            <option value="quote-left" data-icon="fa fa-quote-left">icon-quote-left</option>
                            <option value="quote-right" data-icon="fa fa-quote-right">icon-quote-right</option>
                            <option value="random" data-icon="fa fa-random">icon-random</option>
                            <option value="refresh" data-icon="fa fa-refresh">icon-refresh</option>
                            <option value="remove" data-icon="fa fa-remove">icon-remove</option>
                            <option value="reorder" data-icon="fa fa-reorder">icon-reorder</option>
                            <option value="reply" data-icon="fa fa-reply">icon-reply</option>
                            <option value="retweet" data-icon="fa fa-retweet">icon-retweet</option>
                            <option value="road" data-icon="fa fa-road">icon-road</option>
                            <option value="rss" data-icon="fa fa-rss">icon-rss</option>
                            <option value="search" data-icon="fa fa-search">icon-search</option>
                            <option value="share" data-icon="fa fa-share">icon-share</option>
                            <option value="share-alt" data-icon="fa fa-share-alt">icon-share-alt</option>
                            <option value="shopping-cart" data-icon="fa fa-shopping-cart">icon-shopping-cart</option>
                            <option value="signal" data-icon="fa fa-signal">icon-signal</option>
                            <option value="sign-in" data-icon="fa fa-sign-in">icon-sign-in</option>
                            <option value="sign-out" data-icon="fa fa-sign-out">icon-sign-out</option>
                            <option value="sitemap" data-icon="fa fa-sitemap">icon-sitemap</option>
                            <option value="smile-o" data-icon="fa fa-smile-o">icon-smile-o</option>
                            <option value="sort" data-icon="fa fa-sort">icon-sort</option>
                            <option value="sort-down" data-icon="fa fa-sort-down">icon-sort-down</option>
                            <option value="sort-up" data-icon="fa fa-sort-up">icon-sort-up</option>
                            <option value="spinner" data-icon="fa fa-spinner">icon-spinner</option>
                            <option value="star" data-icon="fa fa-star">icon-star</option>
                            <option value="star-o" data-icon="fa fa-star-o">icon-star-o</option>
                            <option value="star-half" data-icon="fa fa-star-half">icon-star-half</option>
                            <option value="suitcase" data-icon="fa fa-suitcase">icon-suitcase</option>
                            <option value="tablet" data-icon="fa fa-tablet">icon-tablet</option>
                            <option value="tag" data-icon="fa fa-tag">icon-tag</option>
                            <option value="tags" data-icon="fa fa-tags">icon-tags</option>
                            <option value="tasks" data-icon="fa fa-tasks">icon-tasks</option>
                            <option value="thumbs-down" data-icon="fa fa-thumbs-down">icon-thumbs-down</option>
                            <option value="thumbs-up" data-icon="fa fa-thumbs-up">icon-thumbs-up</option>
                            <option value="times" data-icon="fa fa-times">icon-times</option>
                            <option value="tint" data-icon="fa fa-tint">icon-tint</option>
                            <option value="trash" data-icon="fa fa-trash">icon-trash</option>
                            <option value="trophy" data-icon="fa fa-trophy">icon-trophy</option>
                            <option value="truck" data-icon="fa fa-truck">icon-truck</option>
                            <option value="umbrella" data-icon="fa fa-umbrella">icon-umbrella</option>
                            <option value="upload" data-icon="fa fa-upload">icon-upload</option>
                            <option value="user" data-icon="fa fa-user">icon-user</option>
                            <option value="users" data-icon="fa fa-users">icon-users</option>
                            <option value="volume-off" data-icon="fa fa-volume-off">icon-volume-off</option>
                            <option value="volume-down" data-icon="fa fa-volume-down">icon-volume-down</option>
                            <option value="volume-up" data-icon="fa fa-volume-up">icon-volume-up</option>
                            <option value="warning" data-icon="fa fa-warning">icon-warning</option>
                            <option value="wrench" data-icon="fa fa-wrench">icon-wrench</option>
                        <optgroup label="Video Player Icons">
                            <option value="play-circle" data-icon="fa fa-play-circle">icon-play-circle</option>
                            <option value="play" data-icon="fa fa-play">icon-play</option>
                            <option value="pause" data-icon="fa fa-pause">icon-pause</option>
                            <option value="stop" data-icon="fa fa-stop">icon-stop</option>
                            <option value="step-backward" data-icon="fa fa-step-backward">icon-step-backward</option>
                            <option value="fast-backward" data-icon="fa fa-fast-backward">icon-fast-backward</option>
                            <option value="backward" data-icon="fa fa-backward">icon-backward</option>
                            <option value="forward" data-icon="fa fa-forward">icon-forward</option>
                            <option value="fast-forward" data-icon="fa fa-fast-forward">icon-fast-forward</option>
                            <option value="step-forward" data-icon="fa fa-step-forward">icon-step-forward</option>
                            <option value="eject" data-icon="fa fa-eject">icon-eject</option>
                            <option value="youtube-play" data-icon="fa fa-youtube-play">icon-youtube-play</option>
                        <optgroup label="Social Icons">
                            <option value="facebook" data-icon="fa fa-facebook">icon-facebook</option>
                            <option value="facebook-official" data-icon="fa fa-facebook-official">icon-facebook-official</option>
                            <option value="github" data-icon="fa fa-github">icon-github</option>
                            <option value="github-square" data-icon="fa fa-github-square">icon-github-square</option>
                            <option value="google-plus" data-icon="fa fa-google-plus">icon-google-plus</option>
                            <option value="google-plus-square" data-icon="fa fa-google-plus-square">icon-google-plus-square</option>
                            <option value="linkedin" data-icon="fa fa-linkedin">icon-linkedin</option>
                            <option value="linkedin-square" data-icon="fa fa-linkedin-square">icon-linkedin-square</option>
                            <option value="phone" data-icon="fa fa-phone">icon-phone</option>
                            <option value="phone-square" data-icon="fa fa-phone-square">icon-phone-square</option>
                            <option value="pinterest" data-icon="fa fa-pinterest">icon-pinterest</option>
                            <option value="pinterest-p" data-icon="fa fa-pinterest-p">icon-pinterest-p</option>
                            <option value="twitter" data-icon="fa fa-twitter">icon-twitter</option>
                            <option value="twitter-square" data-icon="fa fa-twitter-square">icon-twitter-square</option>
                    </select>
                    {{-- Form::text('icon', old('icon'), array('id' => 'icon', 'class' => 'form-control')) --}}
                    {!! Form::errorMsg('icon') !!}
                </div>
                <div class="form-group description">
                    <label for="event" class="control-label">{{ trans('general.description') }} :</label>
                    {!! Form::textarea('description', old('description'), array('id' => 'description', 'class' => 'form-control tinymce')) !!}
                    {!! Form::errorMsg('description') !!}
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="button_save" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
            <button type="button" id="button_update" class="btn btn-primary" title="{{ trans('general.button_update') }}">{{ trans('general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>

@endsection
@include('backend.admin.category.script.index_script')