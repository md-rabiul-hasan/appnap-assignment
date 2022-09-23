<template>
    <main class="app-content">
        <div class="col-md-6 offset-md-3">
          <div class="tile">
            <h3 class="tile-title">Product Update</h3>
            <div class="tile-body">
              <form @submit.prevent="handleProductUpdate" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="control-label">Name</label>
                  <input class="form-control" v-model="formData.name" type="text" placeholder="Name">
                </div>
                <div class="form-group">
                  <label class="control-label">Price</label>
                  <input class="form-control" v-model="formData.price" type="number" placeholder="Price">
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Select Category</label>
                    <select class="form-control" id="exampleSelect1" @change="handleCategoryChange">
                        <option value="">Select Product</option>
                        <option v-for="item in categories" v-bind:key="item.id" :value="item.id" :selected="item.id == formData.category_id">{{item.name}}</option>                     
                    </select>
                  </div>
                <div class="form-group">
                  <label class="control-label">Image</label>
                  <input class="form-control" type="file"  @change="handleFileObject()" id="customFile" ref="file">               
                </div> 
                <div class="tile-footer">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>                
                </div>
              </form>
            </div>            
          </div>
        </div>
    </main>
</template>

<script>
import axios from 'axios'
import Vue from 'vue';
export default {
    name: "EditProduct",
    data() {
        return {
            formData:{
                name: '',
                price: '',
                category_id: '',
                image: ''
            },
            image: null,
            categories:[]
        };
    },
    mounted() {
      this.getCategories();
      this.getProductInfo();
    },
    methods: {
        async getCategories(){
            const response = await axios.get('categories');
            this.categories = response.data.data
        },

        async getProductInfo(){
            const response = await axios.get(`/products/${this.$route.params.id}`);
            this.formData.name = response.data.data.name;
            this.formData.price = response.data.data.price;
            this.formData.category_id = response.data.data.category_id;
        },

        handleCategoryChange(event){
            this.formData.category_id = event.target.value
        },

       async  handleProductUpdate() {

            let formData = new FormData()
            formData.append('image', this.image)
            formData.append('name', this.formData.name)
            formData.append('category_id', this.formData.category_id)
            formData.append('price', this.formData.price)


            const response = await axios.post(`/products/update/${this.$route.params.id}`, formData);
            this.$store.dispatch("loader", false); //loader off
            if(response.data.success === true){ // success request                  
                Vue.$toast.open({
                    message: response.data.message,
                    type: "success",
                    position: 'top'
                });
                this.$router.push("/products");
            }else{ // failed request
                Vue.$toast.open({
                    message: response.data.message,
                    type: "error",
                    position: 'top'
                });
            } 
      },
      handleFileObject() {
        this.image = this.$refs.file.files[0]
      }
    }
}
</script>

<style>
    .add_button {
        position: absolute;
        top: 5%;
        right: 5%;
    }
</style>