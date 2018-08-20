import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import Orders from './views/Orders';
import OrderDetail from './views/OrderDetail';

Vue.use(VueRouter);

const routes = [

    {path: '/', name: 'home', component: Home},
    {path: '/orders', name: 'orders', component: Orders},
    {path: '/orders/detail/:id', name: 'order-details', component: OrderDetail},
    { path: "*", component: Home }

];

export default new VueRouter({
	mode: 'history',
	routes
});
