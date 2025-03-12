<template>
  <div class="container">
    <div class="form-wrapper">
      <h2>Finalizar o Cadastro</h2>
      <form @submit.prevent="handleRegister">
        <input
          v-model="name"
          type="text"
          placeholder="Nome"
          class="input-field"
          readonly
        />
        <input
          v-model="email"
          type="email"
          placeholder="Email"
          class="input-field"
          readonly
        />
        <input
          v-model="birthdate"
          type="date"
          placeholder="Data de Nascimento"
          class="input-field"
          required
        />
        <input
          v-model="document"
          type="text"
          placeholder="CPF"
          class="input-field"
          required
        />
        <button type="submit" class="submit-button">
          Cadastrar
        </button>
      </form>
      <p class="login-link">
        Já tem conta?
        <router-link to="/login">Entrar</router-link>
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

<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f0f0f0;
}

.form-wrapper {
  width: 100%;
  max-width: 400px;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}

h2 {
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: bold;
}

.input-field {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.submit-button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.submit-button:hover {
  background-color: #0056b3;
}

.login-link {
  margin-top: 15px;
}

.login-link a {
  color: #007bff;
  text-decoration: none;
}

.login-link a:hover {
  text-decoration: underline;
}
</style>