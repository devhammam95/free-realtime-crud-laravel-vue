<template>
    <button class="btn btn-outline-primary" @click="triggerAction">
        <i>Edit</i>
    </button>
</template>

<script>
    import ActionButton from '@andresouzaabreu/vue-data-table/src/components/ActionButtons/ActionButton'
    export default {
        name: "EditButton",
        data: () => ({action: "edit"}),
        ...ActionButton
    }
</script>

<style scoped>
    button{
        margin:10px ;
    }
</style>
