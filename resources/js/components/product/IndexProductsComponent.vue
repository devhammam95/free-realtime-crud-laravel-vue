<template>
    <data-table v-bind="options"/>
</template>

<script>

    import EditButton from "../butttonComponents/EditButtonComponent";
    import DeleteButton from "../butttonComponents/DeleteButtonComponent";
    import ShowButton from "../butttonComponents/ShowButtonComponent";

    export default {
        name: "IndexProducts",
        beforeDestroy () {
            DataTableEventBus.$off("viewData");
            DataTableEventBus.$off("deleteData");
            DataTableEventBus.$off("editData");
        },
        mounted() {
            axios.get('/api/product').then(res => {
                this.products = res.data.products;
            }).catch(err => {
                alert('error,try again')
            });
            //event bus for trigger action for datatable
            DataTableEventBus.$on("viewData", data =>
                this.showProduct(data.id)
            );
            DataTableEventBus.$on("deleteData", data =>
                this.deleteItem(data.id)
            );
            DataTableEventBus.$on("editData", data =>
                this.editProduct(data.id)
            );

            // listening to broadcasting events sub channels
            window.Echo.channel('product-index').listen('SendOperationOnProduct', (data) => {
                var id = data.product.id;
                var index = this.products.findIndex(x => x.id == id);
                console.log('product', data.product.id, index)
                if (data.status == 'added') {
                    this.products.unshift(data.product) //to first this item
                } else if (data.status == 'deleted') {
                    this.products.splice(index, 1);
                    //alert('deleted');
                } else if (data.status == 'updated') {
                    var product = this.products[index];
                    product.name = data.product.name;
                    product.price = data.product.price;
                    // alert('updated');
                }
            });
        },
        data: function () {
            return {
                products: [],
            }
        },
        computed: {
            allProducts() {
                return this.products;
            },
            options() {
                return {
                    actionColumn: true,
                    columns: [
                        {
                            key: 'id',
                            title: 'id',
                        },
                        {
                            key: 'name',
                            title: 'name',
                        },
                        {
                            key: 'price',
                            title: 'price',
                        },
                    ],
                    data: this.allProducts,
                    actionButtons: {
                        edit: EditButton,
                        delete: DeleteButton,
                        view: ShowButton,

                    },
                }
            }
        },
        methods: {
            showProduct(id) {
                this.$router.push({name: 'product.show', params: {id: id}}, () => {
                })
            }, editProduct(id) {
                this.$router.push({name:'product.edit',params:{id:id}},()=>{});
            },
            deleteItem(id) {
                axios.delete(`/api/product/${id}`).then(res => {
                    //can use status code response
                    if (res.data.status == true) {
                        var index = this.products.findIndex(x => x.id == id);
                        console.log(index, id)
                        this.products.splice(index, 1);
                        // this.$toastr.sucess(res.data.msg)
                    }
                }).catch(err => {
                    alert('error,try again')
                })
            }
        }
    }
</script>

<style scoped>

</style>
