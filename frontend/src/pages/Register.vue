<template>
  <div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center">Finalizar o Cadastro</h2>
      <form @submit.prevent="handleRegister">
        <input
          v-model="name"
          type="text"
          placeholder="Nome"
          class="w-full p-2 border rounded mb-4"
          readonly
        />
        <input
          v-model="email"
          type="email"
          placeholder="Email"
          class="w-full p-2 border rounded mb-4"
          readonly
        />
        <input
          v-model="birthdate"
          type="date"
          placeholder="Data de Nascimento"
          class="w-full p-2 border rounded mb-4"
          required
        />
        <input
          v-model="document"
          type="text"
          placeholder="CPF"
          class="w-full p-2 border rounded mb-4"
          required
        />
        <button type="submit" class="w-full p-2 text-white bg-blue-500 rounded">
          Cadastrar
        </button>
      </form>
      <p class="text-center">
        Já tem conta?
        <router-link to="/login" class="text-blue-500">Entrar</router-link>
      </p>
    </div>
  </div>
</template>

<script>
import axiosInstance from '../config/axiosConfig';

export default {
  name: "Register",
  data() {
    return {
      name: "",
      email: "",
      birthdate: "",
      document: "",
      token: "",
    };
  },
  created() {
    const urlParams = new URLSearchParams(window.location.search);
    this.name = urlParams.get("name") || "";
    this.email = urlParams.get("email") || "";
    this.token = urlParams.get("token") || "";
  },
  methods: {
    handleRegister() {
      const userData = {
        name: this.name,
        email: this.email,
        birthdate: this.birthdate,
        document: this.document,
        google_token: this.token
      };
      
      axiosInstance
        .put("/api/register", userData, {
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then((response) => {
          alert("Cadastro realizado com sucesso!");
          window.location.href = "/listar";
        })
        .catch((error) => {
          console.error("Erro ao cadastrar:", error);
        });
    },
  },
};
</script>
