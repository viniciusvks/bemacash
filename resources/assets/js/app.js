import Vue from 'vue';
import App from './views/App';
import router from './router'
import bemacash from './bemacash';
import moment from 'moment';

Vue.prototype.$bemacash = bemacash;

Vue.filter('timestamp', function (value) {
    return moment(String(value)).format('DD/MM/YYYY hh:mm');
});

Vue.filter('date', function (value) {
    return moment(String(value)).format('DD/MM/YYYY');
});

Vue.filter('currency', function (value) {
    return parseFloat(value).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
});

Vue.filter('optional', function (value) {
    return value ? value : '-';
});

const app = new Vue({
    el: '#app',
    components: { App },
    router: router
});
