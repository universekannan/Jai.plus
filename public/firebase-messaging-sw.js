importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js');
firebase.initializeApp({
    apiKey: "AIzaSyDPF4E8KHU2ZLCvrB8Q9zMcUbHyWc5GYdQ",
    authDomain: "mimart-5e4a1.firebaseapp.com",
    projectId: "mimart-5e4a1",
    storageBucket: "mimart-5e4a1.appspot.com",
    messagingSenderId: "725105025812",
    appId: "1:725105025812:web:bd77056fd20a9d9ca69801"
});
const messaging = firebase.messaging();
messaging.onBackgroundMessage((payload) => {
  const notificationTitle = payload.data.title;
  const url = payload.data.url;
  const notificationOptions = {
    body: payload.data.body,
    icon: payload.data.icon
  };
  self.registration.showNotification(notificationTitle,notificationOptions);
  self.addEventListener('notificationclick', (event) => {
    event.notification.close();
    clients.openWindow(url);
  });
});