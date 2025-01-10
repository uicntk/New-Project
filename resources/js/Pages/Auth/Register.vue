<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { ChevronDownIcon } from '@heroicons/vue/16/solid'
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'

const form = useForm({
  name : null,
  phone : null,
  email : null,
  password : null,
  password_confirmation : null,
  avatar : null,
  preview : null,
});

const change = (e)=>{
  form.avatar = e.target.files[0];
  form.preview = URL.createObjectURL(e.target.files[0]);
};

const submit =() => {
  form.post('/register', {
    onError: ()=> form.reset(
      'password',
      'password_confirmation'
    )
  });
};

const agreed = ref(false)


</script>
<template>
  <div class="flex min-h-full flex-1 flex-col justify-center lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Register your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-2" @submit.prevent="submit">
        <div class="grid place-items-center">
          <div class="relative w-28 h-28 rounded-full overflow-hidden border border-slate-300">
            <label for="avatar" class="absolute inset-0 grid content-end cursor-pointer">
              <span class="bg-white/70 pb-2 text-center">
                Avatar
              </span>
            </label>
            <input type="file" @input="change" id="avatar" hidden>
            <img class="object-cover w-28 h-28" :src="form.preview ?? 'storage/avatars/d'">
          </div>
        </div>
        <div>
          <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
          <div class="mt-2">
            <input type="text" name="name" id="name" autocomplete="text"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" v-model="form.name"/>
            <small class="error">{{ form.errors.name }}</small>
          </div>
        </div>
        <div>
          <label for="phone" class="block text-sm/6 font-medium text-gray-900">Phone</label>
          <div class="mt-2">
            <input type="text" name="phone" id="phone" autocomplete="phone"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" v-model="form.phone" />
            <small class="error">{{ form.errors.phone }}</small>
          </div>
        </div>
        <div>
          <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
          <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" v-model="form.email" />
            <small class="error">{{ form.errors.email }}</small>
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input type="password" name="password" id="password" autocomplete="current-password"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" v-model="form.password" />
            <small class="error">{{ form.errors.password }}</small>
          </div>
        </div>
        <div>
          <div class="flex items-center justify-between">
            <label for="password_confimation" class="block text-sm/6 font-medium text-gray-900">Password Confirmation</label>
          </div>
          <div class="mt-2">
            <input type="password" name="password_confimation" id="password_confimation" autocomplete="password_confimation"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" v-model="form.password_confirmation" />
          </div>
        </div>
        <SwitchGroup as="div" class="flex gap-x-4 sm:col-span-2">
          <div class="flex h-6 items-center">
            <Switch v-model="agreed" :class="[agreed ? 'bg-indigo-600' : 'bg-gray-200', 'flex w-8 flex-none cursor-pointer rounded-full p-px ring-1 ring-inset ring-gray-900/5 transition-colors duration-200 ease-in-out focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600']">
              <span class="sr-only">Agree to policies</span>
              <span aria-hidden="true" :class="[agreed ? 'translate-x-3.5' : 'translate-x-0', 'size-4 transform rounded-full bg-white shadow-sm ring-1 ring-gray-900/5 transition duration-200 ease-in-out']" />
            </Switch>
          </div>
          <SwitchLabel class="text-sm/6 text-gray-600">
            By selecting this, you agree to our
            {{ ' ' }}
            <a href="#" class="font-semibold text-indigo-600">privacy&nbsp;policy</a>.
          </SwitchLabel>
        </SwitchGroup>

        <div>
          <button class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 mt-5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" :disabled="form.processing">Sign up</button>
        </div>
        <div class="mt-10 text-right text-sm/6 text-gray-500">
          <div class="text-sm">
            <Link href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Have an account?</Link>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
