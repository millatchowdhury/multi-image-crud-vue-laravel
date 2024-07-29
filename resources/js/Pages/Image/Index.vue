<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

// const props = defineProps({
    
// });

const form = useForm({
    image: Array,
    name: ''
});
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
    <GuestLayout>

       
        <form @submit.prevent="submit" enctype="multipart/form-data">
            
            <input type="file" name="image" multiple @change="getImage"> <!-- For Multiple Image Upload-->
            <!-- <input type="file" name="image" @change="getImage"> For Single Image Upload -->
            <input type="text" v-model="form.name" placeholder="name">
            
            <button type="submit">Submit</button>
        </form>
    </GuestLayout>
</template>
