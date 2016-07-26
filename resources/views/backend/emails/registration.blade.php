<h3>
    Hello {{$full_name}}
</h3>
@if($role_slug == 'cro')
    <p>
        Please install mobile apps eform and login using
        <br>
        username : {{$username}}
        <br>
        password : <b>{{$password}}</b>
    </p>
@else
    <p>
        Please login at <a href="{!URL::to('/')!}">eform</a> using password : <b>{{$password}}</b> for login.
    </p>
@endif
