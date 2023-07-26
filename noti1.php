<script src="https://www.gstatic.com/firebasejs/3.5.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.5.2/firebase-messaging.js"></script>
<script>
var config = {
   apiKey: "AIzaSyAnYSgp-CyTr64mWX8VJY8gR7SdD46ZOis",
	    authDomain: "stylebuddy-a5139.firebaseapp.com",
	    projectId: "stylebuddy-a5139",
	    databaseURL: 'https://stylebuddy-a5139.firebaseio.com',
	    storageBucket: "stylebuddy-a5139.appspot.com",
	    messagingSenderId: "230682717418",
	    appId: "1:230682717418:web:e243581d3e8132c056fb93",
	    measurementId: "G-91N4YCKCW4"
};
firebase.initializeApp(config);
const messaging = firebase.messaging();
messaging.onBackgroundMessage((payload) => {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
});

self.addEventListener('install', function (event) {
    event.waitUntil(skipWaiting());
});

self.addEventListener('activate', function (event) {
    event.waitUntil(clients.claim());
});

self.addEventListener('push', function (event) {
    var pushData = event.data.json();
    try {
        var notificationData = pushData.data;
        notificationData.data = JSON.parse(notificationData.data);
        console.log(notificationData);
        self.registration.showNotification(pushData.notification.title, notificationData);
    }
    catch (err) {
        console.log('Push error happened: ', err);
    }
});
</script>