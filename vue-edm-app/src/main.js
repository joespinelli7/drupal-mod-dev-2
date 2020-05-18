//import the vue instance
import Vue from 'vue'
//import the App component
import App from './App'
//import the vue router
import VueRouter from 'vue-router'
//import the vue resource
import VueResource from 'vue-resource'
//tell vue to use the router
Vue.use(VueRouter)
//tell vue to use the resource
Vue.use(VueResource);

//importing components for the routers
import Album from './components/Album'
import Artist from './components/Artist'

//define your routes
const routes = [

  {
    path: '/',
    component: Album,

  }, {
    path: '/artist',
    component: Artist
  }
]

// Create the router instance and pass the `routes` option

const router = new VueRouter({
  routes, // short for routes: routes
  mode: 'history'
})


//instatinat the vue instance

new Vue({
  //define the selector for the root component
  el: '#app',
  //pass the template to the root component
  template: '<App/>',
  //declare components that the root component can access
  components: {
    App
  },
  //pass in the router to the Vue instance
  router

}).$mount('#app') //mount the router on the app
