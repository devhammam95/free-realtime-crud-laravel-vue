<template>
    <button class="btn btn-outline-info" @click="triggerAction">
        <i>Show</i>
    </button>
</template>

<script>
    import ActionButton from '@andresouzaabreu/vue-data-table/src/components/ActionButtons/ActionButton'
    export default {
        name: "ShowButton",
        data: () => ({action: "view"}),
        ...ActionButton
    }
</script>

<style scoped>
    button{
        margin:10px ;
    }
</style>
