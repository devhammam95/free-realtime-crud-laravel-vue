<template>
    <button class="btn btn-outline-danger" @click="triggerAction">
        <i>Delete</i>
    </button>
</template>

<script>
    import ActionButton from '@andresouzaabreu/vue-data-table/src/components/ActionButtons/ActionButton'
    export default {
        name: "DeleteButton",
        data: () => ({action: "delete"}),
        ...ActionButton
    }
</script>

<style scoped>
    button{
        margin:10px ;
    }
</style>
