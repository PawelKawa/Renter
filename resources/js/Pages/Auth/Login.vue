<template>
    <form @submit.prevent="login">
      <div class="w-1/2 mx-auto">
        <div>
          <label for="email" class="label">E-mail (username)</label>
          <input id="email" v-model="form.email" type="text" class="input" />
        </div>
        <div class="mt-4">
          <label for="password" class="label">Password</label>
          <input id="password" v-model="form.password" type="password" class="input" />
        </div>
        <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
        <div class="mt-16">
          <button class="primary-btn w-full" type="submit">Login</button>
        </div>
      </div>
    </form>
    <div class="mt-4 text-center dark:text-white">
      <Link :href="route('user-account.create')" class="text-sm py-1 px-4">You dont have account yet? Click here!</Link>
    </div>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  const form = useForm({
    email: null,
    password: null,
  })
  const login = () => form.post(route('login.store'))
  </script>

