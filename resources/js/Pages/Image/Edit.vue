<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
const props = defineProps({
    imageFile: Object
});

const form = useForm({
    name: props.imageFile.name ?? ' ',
    id: props.imageFile.id ?? '',
    images:''
});
const getImages =(e)=>{
//    form.image = e.target.files[0]; // for single image upload
    // for multiple image upload
    form.images = e.target.files
}
const submit = () => {
    form.post(route('image.update.store', props.imageFile.id));
};
</script>

<template>
    <h1>{{ imageFile }}</h1>

    
    <GuestLayout>

       
        
        <div class="images" v-for="(item, id) in imageFile.images" :key="id">
        <img :src="'/storage/images/'+item.image" alt="">
        <Link :href="route('image.update', item.id)" style="color:#fff;">X</Link>
    </div>
       
         <form @submit.prevent="submit" enctype="multipart/form-data"> 
         
            
            
            <!-- For Multiple Image Upload-->
             <input type="file" name="image" multiple @change="getImages"> 

            <!-- <input type="file" name="image" @change="getImage"> For Single Image Upload -->
             <input type="text"  placeholder="name" v-model="form.name">
             <input type="hidden"  placeholder="name" v-model="form.id">

            
             <button type="submit">Submit</button>
        </form>  
    
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