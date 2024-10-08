<script setup>

import { useForm } from '@inertiajs/vue3'
import TextInput from '../Components/TextInput.vue';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: null
})

const change =(e) =>{
    form.avatar = e.target.files[0]
};

const submit =() =>{
    form.post(route('register'), {
        onError: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title=" Register"/>

    <h1 class="title">Register New Account</h1>

    <div class="w-2/4 mx-auto">

        <form @submit.prevent="submit">
            <div>
                <label for="avatar">Avatar</label>
                <input type="file" id="avatar" @input="change"/>

                <p>{{ form.errors.avatar }}</p>
            </div>


            <TextInput name="name"
            v-model="form.name" :message="form.errors.name"/>

            <TextInput name="email" type="email"
            v-model="form.email" :message="form.errors.email"/>

            <TextInput name="password" type="password"
            v-model="form.password" :message="form.errors.password"/>

            <TextInput name="confirm password" type="password"
            v-model="form.password_confirmation" />

            <div>
                <p class="text-slate-600 mb-2">Already a user?<a :href="route('login')"
                    class="text-link"> Login</a></p>
                <button class="primary-btn" :disabled="form.processing">Register</button>
            </div>
        </form>
    </div>

</template>
