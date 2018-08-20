<template>
    <div >
        <div v-if="state === 'loading'">
            <app-loading-panel></app-loading-panel>
        </div>
        <div v-if="state === 'error'">
            <app-error-panel></app-error-panel>
        </div>
        <div class="row" v-if="state === 'fetched'">
            <div class="col s12">
                <div class="card-panel">
                    <h2>Pedidos</h2>
                    <div class="divider"></div>
                    <div class="section">
                        <table class="striped bordered grey lighten-5">
                            <thead>
                            <tr>
                                <th class="center-align">#</th>
                                <th>Kit</th>
                                <th>Status</th>
                                <th>Última atualização</th>
                                <th class="center-align">Visualizar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order in orders">
                                <td class="center-align"> {{order.id}} </td>
                                <td> {{order.kit}} </td>
                                <td> {{order.status.description}} </td>
                                <td> {{order.status.last_updated | timestamp}} </td>
                                <td class="center-align">
                                    <router-link :to="{name: 'order-details', params: {id: order.id}}">
                                        <i class="material-icons">receipt</i>
                                    </router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <ul class="pagination center-align">
                            <li class="waves-effect"
                                :class="{ 'active blue darken-1': isActivePage(page)}"
                                v-for="page in this.pagination.pageCount">
                                <a @click="fetchOrders(page)">{{page}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import LoadingPanel from '../components/LoadingPanel';
    import ErrorPanel from '../components/ErrorPanel';

    export default {

        name: "Orders",

        created() {
            this.fetchOrders();
        },

        watch: {
            '$route': 'fetchOrders'
        },

        components: {

            appLoadingPanel: LoadingPanel,
            appErrorPanel: ErrorPanel,

        },

        data() {
            return {
                orders: [],
                pagination: {},
                state: 'loading'
            }
        },

        methods: {

            isActivePage(page) {
                return page === this.pagination.currentPage;
            },

            fetchOrders(page = null) {

                this.loading = true;

                console.log('setTimeout');

                this.$bemacash.api.fetchOrders(page).then(data => {

                    this.state = 'fetched';
                    this.orders = data.results;
                    this.pagination = data.resultsInfo;
                    this.pagination.pageCount = Math.ceil(this.pagination.total/this.pagination.perPage);
                    console.log(data);

                }).catch(error => {

                    this.state = 'error';
                    console.log(error);

                });
            }
        }
    }
</script>