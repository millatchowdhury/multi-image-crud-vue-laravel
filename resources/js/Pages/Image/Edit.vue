<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    imageFile: Object
});

// const form = useForm({
//     imageFile: props.imageFile,
//     name: ''
// });
function getImage(e){
//    form.image = e.target.files[0]; // for single image upload
   form.image = e.target.files; // for multiple image upload
}
const submit = () => {
    console.log(form)
    form.post(route('image.store') );
};
</script>

<template>
    <h1>{{ imageFile }}</h1>

    
    <GuestLayout>

       
        
        <div class="images" v-for="(item, id) in imageFile.images" :key="id">
        <img :src="'/storage/images/'+item.image" alt="">
        <Link :href="route('image.update', item.id)" style="color:#fff;">X</Link>
    </div>
       
        <!-- <form @submit.prevent="submit" enctype="multipart/form-data"> -->
            
            
            <!-- For Multiple Image Upload-->
            <!-- <input type="file" name="image" multiple @change="getImage">  -->

            <!-- <input type="file" name="image" @change="getImage"> For Single Image Upload -->
            <!-- <input type="text" v-model="form.name" placeholder="name">
            
            <button type="submit">Submit</button>
        </form>  -->
    
    </GuestLayout>
</template>
<style scoped>
/* img{
    width: 150px;
    height: 150px;
} */
    div.images{
        width: 200px;
        height: 200px;
        background: red;
        padding: 30px;
        margin: 30px;
    } 
    div.images img{
        width: 100%;
        height: 150px;
    }
</style>