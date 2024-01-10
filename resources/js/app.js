import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './App.vue';
import Home from './components/Home.vue';
import Header from './components/Header.vue'; // Import the Header component

// Create a router instance with history mode
const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Home, name: 'home' },
        // Add your other routes here if needed
    ],
});

// Create the Vue app
const app = createApp(App);

// Use the router in the app
app.use(router);

// Register the Header component globally
app.component('Header', Header);

// Mount the app to the #app element
app.mount('#app');
