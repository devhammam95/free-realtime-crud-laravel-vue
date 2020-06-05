<template>
    <div class="container" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <div>
                    <router-link class="lead text-success p-2" :to="{name:'product.index'}">products</router-link>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto " >
                        <router-link :to="{name:'product.create'}" class="lead btn btn-success btn-sm text-white">create</router-link>
                    </ul>
                </div>
            </div>
        </nav>
        <hr>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "AppComponent"
    }
</script>

<style>
    @import'~bootstrap/dist/css/bootstrap.css';
</style>
