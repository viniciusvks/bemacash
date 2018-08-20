<template>
    <div>

        <app-header></app-header>

        <!--<div class="row">-->
            <!--<div class="col s12">-->
                <div class="container">
                    <router-view></router-view>
                </div>
            <!--</div>-->
        <!--</div>-->

    </div>
</template>

<script>

    import Header from './Header';

    export default {
        name: "App",
        components: {
            appHeader: Header
        }
    }
</script>

<style scoped>
</style>