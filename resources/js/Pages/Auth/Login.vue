<template>
     <Head title="Login page" />
         
<main class="grid place-items-center min-h-screen">
    <section class="bg-white p-8 rounded-xl max-w-md mx-auto border">

       <h1 class="text-3xl mb-6">Login</h1>

    <form @submit.prevent="submit"  >
        

        <div class="form-group">
          <label for="email">Email</label>
          <input v-model="form.email" type="email"
            class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="" required />
            <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></div>
         
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input v-model="form.password" type="password"
            class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="" required />
             <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></div>
          
        </div>

        <div class="mb-6">
        <button type="submit" class="btn btn-primary" :disabled="form.processing">Log In</button>
        </div>
    </form>
       </section>
    </main>

</template>

<script>
export default {
    layout: null,
};

</script>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

let form = useForm ({
    email: '',
    password: ''
});

let submit = () => {
    form.post('/login');
};

</script>