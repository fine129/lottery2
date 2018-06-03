
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router';
import Vuex from 'vuex'
import  confirmHao from './components/confirmHao.vue';
import  xuanhao from './components/xuanhaonew.vue';
import  dantuo from './components/dantuo.vue';
window.Vue = require('vue');

window.Vue.use(VueRouter);
window.Vue.use(Vuex);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('avatarhere', require('./components/avatarhere.vue'));


const router = new VueRouter({
    // routes // （缩写）相当于 routes: routes
    routes: [
        { path: '/confirm', component: confirmHao,props: (route) => ({type:route.query.type}) },
        { path: '/', component: xuanhao, props: true},
        { path: '/dantuo', component: dantuo, props: true},

        // { path: '/search', component: SearchUser, props: (route) => ({ query: route.query.q ,secq:route.query.secq}) },

    ]
});

const store = new Vuex.Store({
    actions: {
        checkout({commit, state}, products) {
            // 把当前购物车的物品备份起来
            const savedCartItems = [...state.cart.added]
            // 发出结账请求，然后乐观地清空购物车
            commit(types.CHECKOUT_REQUEST)
            // 购物 API 接受一个成功回调和一个失败回调
            shop.buyProducts(
                products,
                // 成功操作
                () => commit(types.CHECKOUT_SUCCESS),
                // 失败操作
                () => commit(types.CHECKOUT_FAILURE, savedCartItems)
            )
        }
    },
    state: {
        count: 0,
        todos: [
            { id: 1, text: '...', done: true },
            { id: 2, text: '...', done: false }
        ]
    },
    mutations: {
        increment (state,payload) {
            state.count += payload.amount
        }
    },
    getters: {
        doneTodos: state => {
            return state.todos.filter(todo => todo.done)
        },
        doneTodosCount: (state, getters) => {
            return getters.doneTodos.length
        },
        getTodoById: (state) => (id) => {
            return state.todos.find(todo => todo.id === id)
        }
    },

});

const app = new Vue({
    el: '#app',
    data:{
        msg : 'hi vue!!!'+$('body').length
    },
    router,
    store
});


