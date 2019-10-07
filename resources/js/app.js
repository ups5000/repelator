/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(document).ready(function(){
    $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $('.btn_wishlist').click(function(e){

        e.preventDefault();
        e.stopPropagation();

        var id = $(this).data('id_product');
        var data = {id_product:id};
        ajaxRequest('add_wish',data,cb_add_wish);

    });
});
function cb_add_wish(e){
    alert('cb_add_wish');
}
function ajaxRequest(file,data,Funcion){

    $.ajax({
        type: 'POST',
        url: file,
        dataType: 'json',
        contentType: 'application/x-www-form-urlencoded',
        data: data,
        success: Funcion
    });
}
