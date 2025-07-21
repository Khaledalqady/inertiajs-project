<template>

    <Head title=""Create User />

    <h1 class="text-3xl">Create New User</h1>

    <form @submit.prevent="submit" action="/" method="POST" >
        <div class="form-max-w-md mx-auto mt-8">
          <label for="name">

            Name
          </label>
          <input v-model="form.name" type="text"
            class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" required />
             <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
          
        </div>

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
        <button type="submit" class="btn btn-primary" :disabled="form.processing">Submit</button>
        </div>
    </form>
</template>

<script setup>

import { userForm } from "@inertiajs/inertia-vue3";



let form = userForm ({
 name: '',
 email: '',
 password: ''
});



let submit = () => {
   
    form.post('/users');
       
};
</script>