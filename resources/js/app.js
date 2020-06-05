require('./bootstrap');

window.Vue =require('vue')

import AppComponent from "./AppComponent";
import router from './routes/index'
import store from './store'
import installer from '@andresouzaabreu/vue-data-table'
installer(Vue, store)

//for datatable init
import '@andresouzaabreu/vue-data-table/dist/DataTable.css'
import 'bootstrap/dist/css/bootstrap.min.css'

const app =new Vue({
    el:'#app',
    router,
    store,
    components:{AppComponent}
})
