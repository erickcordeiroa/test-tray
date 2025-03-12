<template>
  <div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-4xl p-8 space-y-6 bg-gray-100 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center">Lista de Usuários</h2>
      <table class="min-w-full">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b">Nome</th>
            <th class="py-2 px-4 border-b">Email</th>
            <th class="py-2 px-4 border-b">Data de Nascimento</th>
            <th class="py-2 px-4 border-b">CPF</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td class="py-2 px-4 border-b">{{ user.name }}</td>
            <td class="py-2 px-4 border-b">{{ user.email }}</td>
            <td class="py-2 px-4 border-b">{{ formatDate(user.birthdate) }}</td>
            <td class="py-2 px-4 border-b">{{ user.document }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "ListUsers",
  data() {
    return {
      users: [],
    };
  },
  created() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      axios.get('http://localhost:8000/api/listar')
        .then(response => {
          this.users = response.data.users;
        })
        .catch(error => {
          console.error('Erro ao buscar usuários:', error);
        });
    },
    formatDate(date) {
      const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      return new Date(date).toLocaleDateString('pt-BR', options);
    }
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #f2f2f2;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}
</style>