<template>
   <div class="text-center mt-5 pt-5">
       <h3>welcome to realtime-crud </h3>
       <router-link class="lead" :to="{name:'product.index'}">list products</router-link>
   </div>
</template>

<script>
    export default {
        name: "Home"
    }
</script>

<style scoped>

</style>
