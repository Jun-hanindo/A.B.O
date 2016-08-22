<h3>
    Hello {{$full_name}}
</h3>
@if($role_slug == 'cro')
    <p>
        Please install mobile apps eform and login using
        <br>
        email : {{$email}}
        <br>
        password : <b>{{$password}}</b>
    </p>
@else
    <p>
        Please login at {!! link_to_action('Auth\AuthController@getLogin', 'eform') !!} using password : <b>{{$password}}</b> for login.
    </p>
@endif
