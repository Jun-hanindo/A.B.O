<!-- ALert BOx -->
@if (session()->get('error'))
<div class="alert alert-danger clearfix alert-notif-box" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    @if (is_array(session()->get('error')))
        {{ head(session()->get('error')) }}
    @else
    {{ session()->get('error') }}
    @endif
</div>
@endif
@if (session()->get('notice'))
<div class="alert alert-success clearfix alert-notif-box" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Success:</span>
    {{ session()->get('notice') }}
</div>
@endif
 <!-- ALert BOx -->
