<script setup>
import { useForm } from '@inertiajs/vue3';
import ErrorMessages from './ErrorMessages.vue';

const props = defineProps({
  user: Object
});

const form = useForm({
    id : props.user.id,
    current_password : null,
    password : null,
    password_confirmation : null
});
const submit =() => {
  form.post('/profile/editpass', {
    onError: ()=> form.reset(),
    onSuccess: ()=> form.reset(),
    preserveScroll : true,
  });
};
</script>
<template>
    <form @submit.prevent="submit">
        <p v-if=" $page.props.flash.message" class="p-4 bg-green-200">
            {{ $page.props.flash.message }}
        </p>
        <ErrorMessages :errors="form.errors"/>
        <dl class="divide-y divide-gray-100">
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm/6 font-medium text-gray-900"><label for="current_password">Old Password</label></dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <div class="sm:max-w-sm">
                    <input type="password" name="current_password" id="current_password" v-model="form.current_password">
                  </div>
                </dd>
              </div>
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm/6 font-medium text-gray-900"><label for="password">New Password</label></dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <div class="sm:max-w-sm">
                    <input type="password" name="password" id="password" v-model="form.password">
                  </div>
                </dd>
              </div>
              <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm/6 font-medium text-gray-900"><label for="password_confirmation">Password Confirmation</label></dt>
                <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                  <div class="sm:max-w-sm">
                    <input type="password" name="password_confirmation" id="password_confirmation" v-model="form.password_confirmation">
                  </div>
                </dd>
              </div>
                <div class="px-4 mb-5 sm:grid sm:grid-cols-3 sm:gap-4">
                    <dt class="text-sm/6 font-medium text-gray-900"></dt>
                    <dd class="text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 mt-5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" :disabled="form.processing">Update Password <font-awesome-icon class="px-2 mt-1" icon="fa-solid fa-edit" /></button>
                    </dd>
                </div>
          </dl>
    </form>
</template>