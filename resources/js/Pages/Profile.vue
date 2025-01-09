<script setup>
import { PaperClipIcon } from '@heroicons/vue/20/solid'
import { useForm } from '@inertiajs/vue3';


const form = useForm({
  name : null,
  phone : null,
  email : null,
  avatar : null,
  preview : null,
});


const change = (e) =>{
  form.avatar = e.target.files[0];
  form.preview = URL.createObjectURL(e.target.files[0]);
};


</script>
<template>
  <div>
    <div class="px-4 sm:px-0">
      <h3 class="text-base/7 font-semibold text-gray-900">
        <i class="fa-solid fa-badge"></i>
        Profile Information</h3>
      <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">Personal details. </p>
    </div>
    <div class="mt-6 border-t border-gray-100">
      <dl class="divide-y divide-gray-100">
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">Avatar</dt>
          <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
            <div class="relative w-28 h-28 rounded-full overflow-hidden border border-slate-300">
              <label for="avatar" class="absolute inset-0 grid content-end cursor-pointer">
                <span class="bg-white/70 pb-2 text-center">
                  Avatar
                </span>
              </label>
              <input type="file" @input="change" id="avatar" hidden>
              <img class="object-cover w-28 h-28" :src="form.preview ?? 'storage/' + $page.props.auth.user.avatar">
            </div>
          </dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">Full name</dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $page.props.auth.user.name }}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">Phone </dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $page.props.auth.user.phone }}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">Email address</dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $page.props.auth.user.email }}</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm/6 font-medium text-gray-900">About</dt>
          <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut pariatur eligendi nemo, mollitia dolorum quod, consequuntur eveniet, laborum aliquid perferendis fuga possimus placeat architecto corporis! Animi fugit ipsam ipsum et?</dd>
        </div>
        <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        </div>
      </dl>
    </div>
  </div>
  <div>
    <div class="px-4 sm:px-0">
      <h3 class="text-base/7 font-semibold text-gray-900">Change Password</h3>
      <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">Change Your Password Here.</p>
    </div>
    <div class="mt-6 border-t border-gray-100">
      <dl class="divide-y divide-gray-100">
      </dl>
    </div>
  </div>
</template>