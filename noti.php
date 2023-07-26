<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.1.3/firebase-messaging.js"></script>
<!--<button id="push-button" disabled>Subscribe</button>

<form action="#">
  <input id="input-title">
  <label for="input-title">Post Title</label>
  <button type="submit" id="add-post">Add Post</button>
</form>-->

<ul id="list"></ul>

<script type="text/javascript">
	firebase.initializeApp({
		apiKey: "AIzaSyAnYSgp-CyTr64mWX8VJY8gR7SdD46ZOis",
	    authDomain: "stylebuddy-a5139.firebaseapp.com",
	    projectId: "stylebuddy-a5139",
	    databaseURL: 'https://stylebuddy-a5139.firebaseio.com',
	    storageBucket: "stylebuddy-a5139.appspot.com",
	    messagingSenderId: "230682717418",
	    appId: "1:230682717418:web:e243581d3e8132c056fb93",
	    measurementId: "G-91N4YCKCW4"
    })
    const messaging = firebase.messaging(),
          database  = firebase.database(),
          pushBtn   = document.getElementById('push-button')
    
    let userToken    = null,
        isSubscribed = false

    window.addEventListener('load', () => {
    
        if ('serviceWorker' in navigator) {
            console.log('load');
            navigator.serviceWorker.register('/service-worker.js')
                .then(registration => {
    
                    messaging.useServiceWorker(registration)
    
                    initializePush()
                })
                .catch(err => console.log('Service Worker Error', err))
    
        } else {
            //pushBtn.textContent = 'Push not supported.'
        }
    
    })
    function initializePush() {
    
        userToken = localStorage.getItem('pushToken')
    
        isSubscribed = userToken !== null
        updateBtn()
    
        // pushBtn.addEventListener('click', () => {
        //    pushBtn.disabled = true
    
            if (isSubscribed) return unsubscribeUser()
    
            return subscribeUser()
        //})
    }
    function updateBtn() {
    
        if (Notification.permission === 'denied') {
            //pushBtn.textContent = 'Subscription blocked'
            return
        }
    
        //pushBtn.textContent = isSubscribed ? 'Unsubscribe' : 'Subscribe'
        //pushBtn.disabled = false
    }
    function subscribeUser() {
    
        messaging.requestPermission()
            .then(() => messaging.getToken())
            .then(token => {
    
                updateSubscriptionOnServer(token)
                isSubscribed = true
                userToken = token
                localStorage.setItem('pushToken', token)
                updateBtn()
            })
            .catch(err => console.log('Denied', err))
    
    }
    
    function updateSubscriptionOnServer(token) {
    
        if (isSubscribed) {
            return database.ref('device_ids')
                    .equalTo(token)
                    .on('child_added', snapshot => snapshot.ref.remove())
        }
    
        database.ref('device_ids').once('value')
            .then(snapshots => {
                let deviceExists = false
    
                snapshots.forEach(childSnapshot => {
                    if (childSnapshot.val() === token) {
                        deviceExists = true
                        return console.log('Device already registered.');
                    }
    
                })
    
                if (!deviceExists) {
                    console.log('Device subscribed');
                    return database.ref('device_ids').push(token)
                }
            })
    }
    function unsubscribeUser() {
    
        messaging.deleteToken(userToken)
            .then(() => {
                updateSubscriptionOnServer(userToken)
                isSubscribed = false
                userToken = null
                localStorage.removeItem('pushToken')
                updateBtn()
            })
            .catch(err => console.log('Error unsubscribing', err))
    }
</script>