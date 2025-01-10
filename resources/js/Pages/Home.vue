<script setup>
import { ref, watch } from 'vue';
import Pagination from './Components/Pagination.vue';
import { debounce } from 'lodash';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    users: Object,
    searchTerm: String
});

const search = ref(props.searchTerm);

watch(
    search,
    debounce(
        (s) => router.get('/', {search : s }, { preserveState: true }), 500
));

const getDate = (date) =>
    new Date(date).toLocaleDateString("en-us", {
        year : "numeric",
        month : "long",
        day : "numeric",
    });
</script>
<template>
    <div>
        <p v-if=" $page.props.flash.message" class="p-4 bg-green-200">
            {{ $page.props.flash.message }}
        </p>
        <div>
            <div class="flex justify-end mb-4">
                <div class="w-1/4">
                    <input type="search" placeholder="Search" v-model="search">
                </div>
            </div>
            <table>
                <thead>
                    <tr class="bg-slate-300">
                        <th>
                            Name 
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Registration Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                        <td>
                            {{ user.name }}
                        </td>
                        <td>
                            {{ user.phone }}
                        </td>
                        <td>
                            {{ user.email }}
                        </td>
                        <td>
                            {{ getDate(user.created_at) }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <Pagination :paginator="users" />

            </div>
        </div>
    </div>
</template>
