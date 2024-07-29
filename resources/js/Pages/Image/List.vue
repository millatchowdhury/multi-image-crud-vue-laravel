<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    services:Object
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
    <GuestLayout>
        <h1></h1>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="(service, id) in  props.services" :key="id">
                    <th scope="row">{{ service.id }}</th>
                    <td>{{ service.name }}</td>
                    <td>
                       
                        <Link :href="route('image.show', service.id)">View</Link> |
                        <Link :href="route('image.edit.show', service.id)">Edit</Link> |
                        <Link :href="route('image.delete', service.id)">Delete</Link>
                    </td>
                </tr>
            </tbody>
            </table>
        
    </GuestLayout>
</template>
