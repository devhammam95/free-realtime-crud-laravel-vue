<template>
    <div class="container">
        <h3> Edit a product <em>-</em>
            <button class="btn btn-default btn-info btn-sm" @click="$router.back()">back</button>
        </h3>
        <form class="col-md-6">
            <div class="form-group">
                <label for="name">name <span class="text-danger">*</span></label>
                <input type="text" v-model="product.name" class="form-control" id="name" placeholder="product name">
                <div class="form-group">
                    <span class="text-danger" v-if="errors.name" v-text="errors.name[0]"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="price">price <span class="text-danger">*</span></label>
                <input type="number" v-model="product.price" class="form-control" id="price"
                       placeholder="product price">
                <div class="form-group">
                    <span class="text-danger" v-if="errors.price" v-text="errors.price[0]"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="desc">description <span class="text-danger">*</span></label>
                <textarea id="desc" v-model="product.description" class="form-control"
                          placeholder="product description"></textarea>
                <div class="form-group">
                    <span class="text-danger" v-if="errors.description" v-text="errors.description[0]"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="main_image">main image <span class="text-danger">*</span></label>
                <input type="file" @change="uploadImage" id="main_image">
                <div class="form-group">
                    <span class="text-danger" v-if="errors.main_image" v-text="errors.main_image[0]"></span>
                </div>
                <div class="form-group d-flex image" v-if="main_image_src">
                    <img :src="main_image_src">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="form-control btn btn-success" @click.prevent="updateProduct()"
                       value="update product"/>
            </div>

        </form>
    </div>
</template>

<script>
    export default {
        name: "EditProduct",
        data: function () {
            return {
                id: this.$route.params.id,
                errors: [],
                product: {
                    name: '',
                    price: '',
                    description: '',
                },
                main_image: '',
                main_image_src: '',
                form: new FormData()
            }
        },
        created() {
            var id = this.id;
            axios.get(`/api/product/${id}`).then((res) => {
                //console.log(res.data);
                if (res.data.status == true) {
                    var product              = res.data.product
                    this.product.name        = product.name
                    this.product.price       = product.price
                    this.product.description = product.description
                    this.main_image_src      = product.main_image;
                }/*else{
                    this.errors = res.data.errors  //if i return reponse with status 200 not 422 for unprocessable entity
                }*/
            }).catch(err => {
                this.errors = err.response.data.errors
            });
        }, methods: {
            removeImg(index) {
                this.multiple_images_src.splice(index, 1);
            },
            uploadImage(e) {
                this.main_image_src = URL.createObjectURL(e.target.files[0]);
                this.main_image = e.target.files[0];
            },

            updateProduct() {
                const config = {headers: {'Content-Type': 'multipart/form-data'}};
                this.form.append('main_image', this.main_image)
                this.form.append('name', this.product.name)
                this.form.append('price', this.product.price)
                this.form.append('description', this.product.description)
                axios.post(`/api/product/${this.id}/update`, this.form, config).then(res => {
                        console.log('id', res.data)
                        if (res.data.status == true) {
                            this.$router.push({name: 'product.index'});
                        }else{
                            alert(res.data.msg)
                        }
                    }
                ).catch(err => {
                   this.errors = err.response.data.errors;
                })
            }
        }
    }
</script>

<style scoped>
    .image img {
        width: 100px;
        height: 100px;
    }
</style>
