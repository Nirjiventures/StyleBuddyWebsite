<html>
  <body>
      <script src="https://accounts.google.com/gsi/client" async defer></script>
      <script>
        var YOUR_GOOGLE_CLIENT_ID = '87048310229-rq4f1d6t2nf6lv0b9sg1vgl31pfgguho.apps.googleusercontent.com';
         
        window.onload = function () {
          google.accounts.id.initialize({
            client_id: YOUR_GOOGLE_CLIENT_ID,
            callback: handleCredentialResponse,
          });
          google.accounts.id.renderButton(
            document.getElementById("onSignin"),
            { theme: "outline", size: "large" }  // customization attributes
          );
          //google.accounts.id.prompt(); // also display the One Tap dialog
        }
        function handleCredentialResponse(response) {
            console.log("Encoded JWT ID token: " + response.credential);
            const responsePayload = decodeJwtResponse(response.credential);
            
            console.log("response: " + JSON.stringify(responsePayload));
            
            console.log("ID: " + responsePayload.sub);
            console.log('Full Name: ' + responsePayload.name);
            console.log('Given Name: ' + responsePayload.given_name);
            console.log('Family Name: ' + responsePayload.family_name);
            console.log("Image URL: " + responsePayload.picture);
            console.log("Email: " + responsePayload.email);
            window.location.reload();
        }
        function decodeJwtResponse(token) {
            var base64Url = token.split(".")[1];
            var base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
            var jsonPayload = decodeURIComponent(
              atob(base64)
                .split("")
                .map(function (c) {
                  return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
                })
                .join("")
            );
        
            return JSON.parse(jsonPayload);
        }
        function onSignout() {
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "https://mail.google.com/mail/u/0/?logout&hl=en"; 
            document.getElementsByTagName("head")[0].appendChild(script);
            document.querySelector('#test').innerHTML = '<h3>Please Wait...</h3>';
            setTimeout(yes, 3000)
            //setTimeout(function () { location.reload(true); }, 5000);
        }
        function show_login_status(network, status){
            if(status == false){
                document.getElementById('onSignout').style.display='none';
            }
            if(status == true){
                document.getElementById('onSignin').style.display='none';
            }
        }
        
        
        function yes() {
           location.reload(true);
        };
        function onSignout1() {
          google.accounts.id.disableAutoSelect();
        };
        
         
    </script>
    
     <div id="g_id_onload"
         data-client_id="87048310229-rq4f1d6t2nf6lv0b9sg1vgl31pfgguho.apps.googleusercontent.com"
         data-login_uri="https://www.stylebuddy.in/login.php"
         data-auto_prompt="false">
      </div>
      <div class="g_id_signin"
         data-type="standard"
         data-size="large"
         data-theme="outline"
         data-text="sign_in_with"
         data-shape="rectangular"
         data-logo_alignment="left">
      </div>
      
      
    <div class="g_id_signout" onclick="onSignout1()">Sign Out</div>
    <button onclick="onSignout()" id="onSignout">Sign Out</button>
    <p id="test"></p>
    <div id="onSignin"></div>
    <img style="display:none;" onload="show_login_status('Google', true)" onerror="show_login_status('Google', false)" src="https://accounts.google.com/CheckCookie?continue=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&followup=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&chtml=LoginDoneHtml&checkedDomains=youtube&checkConnection=youtube%3A291%3A1"/>
  </body>
</html>
<!--

<html>
  <body>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script>
        window.onload = function () {
            google.accounts.id.initialize({
              client_id: '87048310229-rq4f1d6t2nf6lv0b9sg1vgl31pfgguho.apps.googleusercontent.com',
              callback: handleCredentialResponse,
              state_cookie_domain: 'https://www.stylebuddy.in/',
            });
            console.log("response: " + JSON.stringify(google.accounts));
            const parent = document.getElementById('google_btn');
            //google.accounts.id.renderButton(parent, {theme: "filled_blue"});
            
            google.accounts.id.renderButton(parent, { theme: 'outline', size: 'small' } );
              
           // google.accounts.id.prompt();
           
           google.accounts.id.disableAutoSelect();
        }
        function handleCredentialResponse(response) {
             // decodeJwtResponse() is a custom function defined by you
             // to decode the credential response.
             console.log("response: " + JSON.stringify(response));
             console.log("response: " + response.credential);
             const responsePayload = decodeJwtResponse(response.credential);
            
             console.log("response: " + JSON.stringify(responsePayload));
             
             console.log("ID: " + responsePayload.sub);
             console.log('Full Name: ' + responsePayload.name);
             console.log('Given Name: ' + responsePayload.given_name);
             console.log('Family Name: ' + responsePayload.family_name);
             console.log("Image URL: " + responsePayload.picture);
             console.log("Email: " + responsePayload.email);
        }
        function decodeJwtResponse(token) {
            var base64Url = token.split(".")[1];
            var base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
            var jsonPayload = decodeURIComponent(
              atob(base64)
                .split("")
                .map(function (c) {
                  return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
                })
                .join("")
            );
        
            return JSON.parse(jsonPayload);
          }
    </script>
    <script>
        
    </script>    
    
   
    <button onclick="onSignout()">Sign Out</button>
    <div id="google_btn"></div>
    
    
    
<script type="text/javascript">


</script>
 

<img style="display:none;" onload="show_login_status('Google', true)" onerror="show_login_status('Google', false)" src="https://accounts.google.com/CheckCookie?continue=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&followup=https%3A%2F%2Fwww.google.com%2Fintl%2Fen%2Fimages%2Flogos%2Faccounts_logo.png&chtml=LoginDoneHtml&checkedDomains=youtube&checkConnection=youtube%3A291%3A1"
/>

  </body>
</html>
-->
 
<!--
<!DOCTYPE html>
<html lang="en">
<head>
  <title>CSS Template</title>
  <meta charset="utf-8">
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <meta name="google-signin-client_id" content="87048310229-rq4f1d6t2nf6lv0b9sg1vgl31pfgguho.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
   
</head>
<body>
 <div class="g-signin2" data-onsuccess="onSignIn"></div>   

<div id="g_id_onload"
     data-client_id="87048310229-rq4f1d6t2nf6lv0b9sg1vgl31pfgguho.apps.googleusercontent.com"
     data-login_uri="https://www.stylebuddy.in/login.php"
     data-your_own_param_1_to_login="https://www.stylebuddy.in/login.php"
     data-your_own_param_2_to_login="https://www.stylebuddy.in/login.php">
</div>
 
</body>
<script type="text/javascript">
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    } 
 
  function handleCredentialResponse(response) {
     // decodeJwtResponse() is a custom function defined by you
     // to decode the credential response.
     const responsePayload = decodeJwtResponse(response.credential);

     console.log("ID: " + responsePayload.sub);
     console.log('Full Name: ' + responsePayload.name);
     console.log('Given Name: ' + responsePayload.given_name);
     console.log('Family Name: ' + responsePayload.family_name);
     console.log("Image URL: " + responsePayload.picture);
     console.log("Email: " + responsePayload.email);
  }
 

</script>
</html>-->
<!--<!DOCTYPE html>
<html lang="en">
<head>
  <title>CSS Template</title>
  <meta charset="utf-8">
   
  <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
  <meta name="google-signin-client_id" content="87048310229-9cl6lv5ov976k1g79ku11gohj74gsbvc.apps.googleusercontent.com">
</head>
<body>
    <div class="g-signin2" data-onsuccess="onSignIn"></div>
    
    <div id="g_id_onload"
       data-client_id="87048310229-9cl6lv5ov976k1g79ku11gohj74gsbvc.apps.googleusercontent.com"
       data-auto_select="true"
       data-login_uri="https://www.stylebuddy.in/login.php">
  </div>
  
  

  
</body>
<script type="text/javascript">
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  }
</script>
</html>

-->