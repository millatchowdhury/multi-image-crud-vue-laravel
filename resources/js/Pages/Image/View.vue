<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    imagesFile: Object
});

// const form = useForm({
//     image: Array,
//     name: ''
// });
// function getImage(e){
// //    form.image = e.target.files[0]; // for single image upload
//    form.image = e.target.files; // for multiple image upload
// }
// const submit = () => {
//     console.log(form)
//     form.post(route('image.store') );
// };
</script>

<template>
    <!-- <h1>{{ imagesFile }}</h1> -->
   
    <table>
        <tr v-for="(item, id) in imagesFile.images" :key="id">
            <td>
                <!-- {{ item.image }} -->
                <img :src="'/storage/images/'+item.image" alt="">
                <!-- <img :src="item.image" alt=""> -->
            </td>
        </tr>
    </table>
        <!-- <div><h1>{{ imagesFile.name }}</h1></div> -->
        <!-- <div v-for="(item, id) in imagesFile.images" :key="id">
            <img :src="'/storage/images/'+item.image" alt="">
        </div> -->
        <!-- <img :src="'/storage/images/'+ imagesFile.images[2].image"/> -->
   
</template>



