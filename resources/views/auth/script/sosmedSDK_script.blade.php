<script type="text/javascript">

//SDK Facebook
window.fbAsyncInit = function() {
    FB.init({
        appId      : "{{ env('APP_FB_ID') }}",
        xfbml      : true,
        version    : 'v2.6'
    });

    FB.getLoginStatus(function(response){
        // console.log(response);
    });

};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function loginFB(){
    FB.login(function(response){
        if(response.status === 'connected') {
            var token = response.authResponse.accessToken;
            getInfoFB(token);
        } else if(response.status === 'not_authorized' ) {
            $('.error').addClass('alert alert-danger').html('Login failed');
        } else {
            $('.error').addClass('alert alert-danger').html('Login failed');
        }
    },{scope:'email'});
}

function getInfoFB(accessToken) {
    FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,email'},function(response){
        var type_sosmed = 'facebook';
        sendToServer(response,accessToken,type_sosmed);
    });
}

function sendToServer(data,accessToken,type_sosmed){
    data.token = accessToken;
    data.type_sosmed = type_sosmed;

    modal_loader();
    openLoginModal();
    $.ajax({
        url: "{{ route('auth-social-media') }}",
        type: "POST",
        dataType: 'json',
        data: data,
        success: function (data) {
            HoldOn.close();
            location.replace("{{ route('/') }}");
            
        },
        error: function(response){
            HoldOn.close();
            $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
            shakeModal();
        }
    });
}

//Google Plus SDK
var auth2 = {};
var helper = (function() {
  return {
    /**
     * Hides the sign in button and starts the post-authorization operations.
     *
     * @param {Object} authResult An Object which contains the access token and
     *   other authentication information.
     */
    onSignInCallback: function(authResult) {
        if (authResult.isSignedIn.get()) {
            helper.profile();
        } else {
            if (authResult['error'] || authResult.currentUser.get().getAuthResponse() == null) {
            // There was an error, which means the user is not signed in.
            // As an example, you can handle by writing to the console:
                alert('There was an error: ' + authResult['error']);
            }
        }
    },

    /**
     * Calls the OAuth2 endpoint to disconnect the app for the user.
     */
    disconnect: function() {
      // Revoke the access token.
      auth2.disconnect();
    },

    /**
     * Gets and renders the currently signed in user's profile data.
     */
    profile: function(){
      gapi.client.plus.people.get({
        'userId': 'me'
      }).then(function(res) {
        var profile = res.result;
        
        var username = '';
        var email = '';
        var first_name = profile.name.givenName;
        var last_name = profile.name.familyName;
        var accessToken = '';
        var id = profile.id;
        var type_sosmed = 'google';
        var token_secret = '';
        var image_url = profile.image.url;
        
        if (profile.emails) {
          $('#profile').append('<br/>Emails: ');
          for (var i=0; i < profile.emails.length; i++){
            email = profile.emails[i].value;
          }
        }

        var dataUser = {'username':email,'email':email,'first_name':first_name,'last_name':last_name,'id':id,'token_secret':accessToken,'image_url':image_url};
        // console.log(dataUser);
        sendToServer(dataUser,accessToken,type_sosmed);
        auth2.signOut();

        
      }, function(err) {
        var error = err.result;
        $('#profile').empty();
        $('#profile').append(error.message);
      });
    }
  };
})();

/**
 * jQuery initialization
 */
$(document).ready(function() {
  $('#disconnect').click(helper.disconnect);
  $('#loaderror').hide();
  if ($('meta')[0].content == 'YOUR_CLIENT_ID') {
    alert('This sample requires your OAuth credentials (client ID) ' +
        'from the Google APIs console:\n' +
        '    https://code.google.com/apis/console/#:access\n\n' +
        'Find and replace YOUR_CLIENT_ID with your client ID.'
    );
  }

  // $(".abcRioButton").html('');
  // $(".abcRioButton").addClass();

});

/**
 * Handler for when the sign-in state changes.
 *
 * @param {boolean} isSignedIn The new signed in state.
 */
var updateSignIn = function() {
  if (auth2.isSignedIn.get()) {
    console.log('signed in');
    helper.onSignInCallback(gapi.auth2.getAuthInstance());
  }else{
    helper.onSignInCallback(gapi.auth2.getAuthInstance());
  }
}

/**
 * This method sets up the sign-in listener after the client library loads.
 */
function startApp() {
  gapi.load('auth2', function() {
    gapi.client.load('plus','v1').then(function() {
      gapi.signin2.render('google_login_1', {
          scope: 'https://www.googleapis.com/auth/plus.login',
          fetch_basic_profile: false });
      gapi.signin2.render('google_login_2', {
          scope: 'https://www.googleapis.com/auth/plus.login',
          fetch_basic_profile: false ,
          theme: 'none',
          width: 'auto'});
      gapi.auth2.init({fetch_basic_profile: false,
          scope:'https://www.googleapis.com/auth/userinfo.email'}).then(
            function (){
              auth2 = gapi.auth2.getAuthInstance();
              auth2.isSignedIn.listen(updateSignIn);
              auth2.then(updateSignIn);
            });
    });
  });

}

window.onbeforeunload = function(e){
    auth2.signOut();
};


//Twitter SDK
/*
 Twitter client app
 */

// var OAuth = require('oauth').OAuth;
// var qs = require('qs');

function Twitter() {
    this.consumerKey = 'KB7jl8SHzBJU5CnGX4JeqHs8i';
    this.consumerSecret = '7MfVgQrBbL9z7arlLV4GqFtOxBwvPnEOf2rkvtunykaoXSb4jQ';
    // this.accessToken = config.accessToken;
    // this.accessTokenSecret = config.accessTokenSecret;
    this.callBackUrl = "{{ env('APP_URL') }}"+"/callback-twitter";
    this.baseUrl = 'https://api.twitter.com/1.1';
    this.oauth = new OAuth(
        'https://api.twitter.com/oauth/request_token',
        'https://api.twitter.com/oauth/access_token',
        this.consumerKey,
        this.consumerSecret,
        '1.0',
        this.callBackUrl,
        'HMAC-SHA1'
    );
}

Twitter.prototype.getOAuthRequestToken = function (next) {
    this.oauth.getOAuthRequestToken(function (error, oauth_token, oauth_token_secret, results) {
        if (error) {
            console.log('ERROR: ' + error);
            next();
        }
        else {
            var oauth = {};
            oauth.token = oauth_token;
            oauth.token_secret = oauth_token_secret;
            console.log('oauth.token: ' + oauth.token);
            console.log('oauth.token_secret: ' + oauth.token_secret);
            next(oauth);
        }
    });
};

Twitter.prototype.getOAuthAccessToken = function (oauth, next) {
    this.oauth.getOAuthAccessToken(oauth.token, oauth.token_secret, oauth.verifier,
        function (error, oauth_access_token, oauth_access_token_secret, results) {
            if (error) {
                console.log('ERROR: ' + error);
                next();
            } else {
                oauth.access_token = oauth_access_token;
                oauth.access_token_secret = oauth_access_token_secret;

                console.log('oauth.token: ' + oauth.token);
                console.log('oauth.token_secret: ' + oauth.token_secret);
                console.log('oauth.access_token: ' + access_token.token);
                console.log('oauth.access_token_secret: ' + oauth.access_token_secret);
                next(oauth);
            }
        }
    );
};

Twitter.prototype.postMedia = function (params, error, success) {
    var url = 'https://upload.twitter.com/1.1/media/upload.json';
    this.doPost(url, params, error, success);
};

Twitter.prototype.postTweet = function (params, error, success) {
    var path = '/statuses/update.json';
    var url = this.baseUrl + path;
    this.doPost(url, params, error, success);
};

Twitter.prototype.postFavoritesCreate = function (params, error, success) {
    var path = '/favorites/create.json';
    var url = this.baseUrl + path;
    this.doPost(url, params, error, success);
};

Twitter.prototype.postCreateFriendship = function (params, error, success) {
    var path = '/friendships/create.json';
    var url = this.baseUrl + path;
    this.doPost(url, params, error, success);
};

Twitter.prototype.getUserTimeline = function (params, error, success) {
    var path = '/statuses/user_timeline.json' + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.getMentionsTimeline = function (params, error, success) {
    var path = '/statuses/mentions_timeline.json' + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.getHomeTimeline = function (params, error, success) {
    var path = '/statuses/home_timeline.json' + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.getFavorites = function (params, error, success) {
    var path = '/favorites/list.json' + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.getReTweetsOfMe = function (params, error, success) {
    var path = '/statuses/retweets_of_me.json' + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.getTweet = function (params, error, success) {
    var path = '/statuses/show.json' + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.getSearch = function (params, error, success) {
    var encodedQuery = encodeURIComponent(params.q);
    delete params.q;
    var path = '/search/tweets.json?q=' + encodedQuery +'&'+ qs.stringify(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

//molina code
Twitter.prototype.getUser = function (params, error, success) {
    var path = '/users/show.json' + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.getFollowersList = function (params, error, success) {
    var path = '/followers/list.json' + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.getFollowersIds = function (params, error, success) {
    var path = '/followers/ids.json' + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.getCustomApiCall = function (url, params, error, success) {
    var path =  url + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doRequest(url, error, success);
};

Twitter.prototype.postCustomApiCall = function (url, params, error, success) {
    var path =  url + this.buildQS(params);
    var url = this.baseUrl + path;
    this.doPost(url, params, error, success);
};

Twitter.prototype.doRequest = function (url, error, success) {
    // Fix the mismatch between OAuth's  RFC3986's and Javascript's beliefs in what is right and wrong ;)
    // From https://github.com/ttezel/twit/blob/master/lib/oarequest.js
    url = url.replace(/\!/g, "%21")
        .replace(/\'/g, "%27")
        .replace(/\(/g, "%28")
        .replace(/\)/g, "%29")
        .replace(/\*/g, "%2A");

    this.oauth.get(url, this.accessToken, this.accessTokenSecret, function (err, body, response) {
        console.log('URL [%s]', url);
        if (!err && response.statusCode == 200) {
            limits = {
                "x-rate-limit-limit": response.headers['x-rate-limit-limit'],
                "x-rate-limit-remaining": response.headers['x-rate-limit-remaining'],
                "x-rate-limit-reset": response.headers['x-rate-limit-reset'],
            };
            success(body, limits);
        } else {
            error(err, response, body);
        }
    });
};

Twitter.prototype.doPost = function (url, post_body, error, success) {
    // Fix the mismatch between OAuth's  RFC3986's and Javascript's beliefs in what is right and wrong ;)
    // From https://github.com/ttezel/twit/blob/master/lib/oarequest.js
    url = url.replace(/\!/g, "%21")
        .replace(/\'/g, "%27")
        .replace(/\(/g, "%28")
        .replace(/\)/g, "%29")
        .replace(/\*/g, "%2A");
    //(url, oauth_token, oauth_token_secret, post_body, post_content_type, callback 
    this.oauth.post(url, this.accessToken, this.accessTokenSecret, post_body, "application/x-www-form-urlencoded", function (err, body, response) {
        console.log('URL [%s]', url);
        if (!err && response.statusCode == 200) {
            success(body);
        } else {
            error(err, response, body);
        }
    });
};

Twitter.prototype.buildQS = function (params) {
    if (params && Object.keys(params).length > 0) {
        return '?' + qs.stringify(params);
    }
    return '';
};

if (!(typeof exports === 'undefined')) {
    exports.Twitter = Twitter;
}

</script>

<script src="https://apis.google.com/js/client:platform.js?onload=startApp"></script>