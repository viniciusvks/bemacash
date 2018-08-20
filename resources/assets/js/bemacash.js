import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000/api';

export default {

	api: {

        fetchOrders(page = null) {

            return new Promise((resolve, reject) => {

                let queryPage = parseInt(page) > 0 ? '?page='+page : '';

                axios.get('/order'+queryPage).then(response => {

                    resolve(response.data);

                }).catch(error => {

                    reject(error);

                });
            });
        },

        fetchOrderDetails(id) {

            return new Promise((resolve, reject) => {

                axios.get(`/order/${id}`).then(response => {

                    resolve(response.data);

                }).catch(error => {

                    reject(error);

                });
            });
        }

    }
};
