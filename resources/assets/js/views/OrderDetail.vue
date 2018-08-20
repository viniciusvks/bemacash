<template>
    <div class="row">
        <div v-if="state === 'loading'">
            <app-loading-panel></app-loading-panel>
        </div>
        <div v-if="state === 'error'">
            <app-error-panel></app-error-panel>
        </div>
        <div v-if="state === 'fetched'">
            <div class="col s12 m12 l12">
                <div class="card-panel">
                    <div class="section">
                        <h4>
                            <i class="material-icons">shopping_cart</i> Pedido #{{ this.orderDetails.id }}
                        </h4>
                        <div class="row">
                            <div class="col s12 m4">
                                <h6 class="valign-wrapper">
                                    <i class="material-icons">local_shipping</i> Endereço de envio:
                                </h6>
                                <br>
                                {{ this.orderDetails.shipping_address.description }} <br>
                                CEP: {{ this.orderDetails.shipping_address.zip_code }} <br>
                                {{ this.orderDetails.shipping_address.city }}/{{ this.orderDetails.shipping_address.state }}
                                - {{ this.orderDetails.shipping_address.country }} <br>
                                Documento de envio: {{ this.orderDetails.shipping_document }}
                            </div>
                            <div class="col s12 m4">
                                <h6 class="valign-wrapper">
                                    <i class="material-icons">info</i> Situação:
                                </h6>
                                {{ this.orderDetails.status.description }}
                            </div>
                            <div class="col s12 m4">
                                <h6 class="valign-wrapper">
                                    <i class="material-icons">event</i> Data de emissão:
                                </h6>
                                {{ this.orderDetails.created_at | date}}

                                <h6 class="valign-wrapper">
                                    <i class="material-icons">receipt</i> Número do pedido de hardware:
                                </h6>
                                {{ this.orderDetails.hardware_order_number | optional }}

                                <h6 class="valign-wrapper">
                                    <i class="material-icons">account_circle</i> Executivo de vendas:
                                </h6>
                                {{ this.orderDetails.sales_executive | optional}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <h6 class="valign-wrapper">
                                    <i class="material-icons">comment</i> Comentários:
                                </h6>
                                <br>
                                {{ this.orderDetails.comment | optional }}
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="section row blue darken-1 white-text" style="margin-top: 20px;">
                        <div class="col s12 m6">
                            <h6>Kit:</h6> <br> {{ this.orderDetails.kit.name }}
                        </div>
                        <div class="col s12 m1">
                            <h6>Preço</h6> <br> {{ this.orderDetails.kit.price | currency }}
                        </div>
                        <div class="col s12 m2">
                            <h6>Nota Fiscal:</h6> <br>
                            Nº: {{ this.orderDetails.invoice_number }} <br>
                            Emitida em: {{ this.orderDetails.invoice_issue_date | date}}
                        </div>
                        <div class="col s12 m3">
                            <h6>Licensa:</h6> <br> {{ this.orderDetails.kit.license.name}}
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="section">
                        <h4>
                            <i class="material-icons">shopping_basket</i> Itens do Kit
                        </h4>
                        <div class="row">
                            <div class="col s12">
                                <table class="striped bordered grey lighten-5">
                                    <thead>
                                    <tr>
                                        <th class="center-align">#</th>
                                        <th>Item</th>
                                        <th class="center-align">Quantidade</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, index) in this.orderDetails.kit.products">
                                        <td class="center-align"> {{index+1}} </td>
                                        <td class="left-align"> {{item.name}} </td>
                                        <td class="center-align"> {{item.quantity}} </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="section">
                        <h4>
                            <i class="material-icons">timeline</i> Histórico do pedido
                        </h4>
                        <ul class="collection">
                            <li class="valign-wrapper collection-item" v-for="record in this.orderDetails.history">
                                <i class="material-icons">event</i> {{ record.created_at | timestamp }}: {{record.description}}
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

        name: "OrderDetail",

        created() {
        	this.fetchData();
        },

        data() {
        	return {
                orderDetails: {},
                state: 'loading'
            }
        },

        watch: {
	        '$route': 'fetchData'
        },

        components: {

            appLoadingPanel: LoadingPanel,
            appErrorPanel: ErrorPanel,

        },

        methods: {

            fetchData() {

                this.loading = true;

                this.$bemacash.api.fetchOrderDetails(this.$route.params.id).then(data => {

                    this.state = 'fetched';
                    this.orderDetails = data.results;
                    console.log(data);

                }).catch(error => {

                    this.state = 'error';
                    console.log(error);

                });
            }
        }
    }
</script>

<style scoped>

</style>
