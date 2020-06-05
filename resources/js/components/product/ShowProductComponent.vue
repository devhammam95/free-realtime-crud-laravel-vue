<template>
    <div class="container bg-light">
        <h3> product data - <span class="btn btn-info btn-sm" @click="$router.back()">back</span></h3>
        <div class="col-md-6">
            <div class="form-group">
                <label>name</label>
                <p class="lead" v-text="product.name"></p>
            </div>
            <div class="form-group">
                <label>price</label>
                <p class="lead" v-text="product.price"></p>
            </div>
            <div class="form-group">
                <label>description</label>
                <p class="lead" v-text="product.description"></p>
            </div><hr>
            <div class="form-group p-1">
                <label>main_image</label>
                <img class="w-100 h-100" :src="this.main_image"/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ShowProduct",
        data: function () {
            return {
                id: this.$route.params.id,
                product: {
                    name: '', price: '', description: '',
                },
                main_image: '', 
            }
        },
        created() {
            axios.get(`/api/product/${this.id}`).then((res) => {
                console.log(res.data)
                var p = res.data.product
                this.product.name = p.name
                this.product.price = p.price
                this.product.description = p.description
                this.main_image = p.main_image
            }).catch(err => {
                alert('error try again')
            });
        }
    }
</script>

<style scoped>

</style>
