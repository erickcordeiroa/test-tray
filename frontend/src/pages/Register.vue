<template>
  <div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center">Login</h2>
      <form @submit.prevent="handleLogin">
        <input
          v-model="email"
          type="email"
          placeholder="Email"
          class="w-full p-2 border rounded mb-4"
          required
        />
        <input
          v-model="password"
          type="password"
          placeholder="Senha"
          class="w-full p-2 border rounded mb-4"
          required
        />
        <button type="submit" class="w-full p-2 text-white bg-blue-500 rounded">
          Entrar
        </button>
      </form>
      <button
        @click="loginWithGoogle"
        class="w-full p-2 mt-2 text-white bg-red-500 rounded"
      >
        Entrar com Google
      </button>
      <p class="text-center">
        Não tem conta?
        <router-link to="/register" class="text-blue-500">Cadastre-se</router-link>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "Register",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    handleLogin() {
      alert(`Login com: ${this.email}`);
    },
    loginWithGoogle() {
      window.open(
        "https://accounts.google.com/o/oauth2/auth?client_id=SEU_CLIENT_ID&redirect_uri=SEU_REDIRECT_URI&response_type=token&scope=email profile",
        "_self"
      );
    },
  },
};
</script>
