<template>
    <head title="Users" />
     
  <div class="flex justify-between mb-6">
    <div class="flex items-center">
    <h1 class="text-3xl">Users</h1>

    <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm" ml-2>New User</Link>
    </div>

<input v-model="search" type="text" placeholder="Search users..." class="border px-2 rounded-lg" />
</div>
<ul role="list" class="divide-y divide-gray-100">
  <li class="flex justify-between gap-x-6 py-5">
    <div class="flex min-w-0 gap-x-4" v-for="user in users.data" :key="user.id">
      <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-12 flex-none rounded-full bg-gray-50" />
      <div class="min-w-0 flex-auto">
        <p class="text-sm/6 font-semibold text-gray-900"> {{ user.name }}</p>
       
      </div>
    </div>
    <div v-if="user.can.edit" class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
      <p class="text-sm/6 text-gray-900">Co-Founder / CEO</p>
      <Link :href="'/users/${user.id}/edit'" class="text-indigo-600 hover:text-indigo-900"> Edit </Link>
      
    </div>
  </li>
  
   

</ul>

<Pagination :links="users.links" class="mt-6" />

</template>

<script setup>


import Pagination from '../../Shared/Pagination.vue';


import { ref, watch } from "vue";
import { Inertia } from '@inertiajs/inertia';
import debounce from 'lodash/debounce';

const props = defineProps({
  users: Object,
  filters: Object,
  can: Object
});

let search = ref(props.filters.search);

watch(
  search,
  debounce(function (value) {
  
    Inertia.get('/users', { search: value }, {
      preserveState: true,
      replace: true
    });
  }, 500)
);

</script>