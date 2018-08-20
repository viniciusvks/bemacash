<template>
    <div>
            <nav class="nav-extended blue darken-1 white-text">
                <div class="nav-wrapper">
                    <span class="brand-logo" style="margin-left: 20px">Bemacash</span>
                </div>
                <div class="nav-content">
                    <ul class="tabs tabs-transparent">
                        <li class="tab">
                            <!--<i class="material-icons">home</i>-->
                            <a :class="{ 'active': isCurrentPage('home')}">
                                <router-link :to="{name: 'home'}">
                                    Início
                                </router-link>
                            </a>
                        </li>
                        <li class="tab">
                            <!--<i class="material-icons">inbox</i>-->
                            <a :class="{ 'active': isCurrentPage('orders')}">
                                <router-link :to="{name: 'orders'}">
                                   Pedidos
                                </router-link>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
    </div>
</template>

<script>
    export default {
        name: "Header",

        methods: {
            isCurrentPage(page) {
                return this.$route.name === page;
            }
        }
    }
</script>

<style scoped>

</style>