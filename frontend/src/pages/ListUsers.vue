<template>
  <div class="container">
    <div class="table-wrapper">
      <h2 class="title">Lista de Usuários</h2>
      <div class="filters">
        <input type="text" v-model="filterName" placeholder="Filtrar por nome" @input="applyFilters" />
        <input type="text" v-model="filterCPF" placeholder="Filtrar por CPF" @input="applyFilters" />
      </div>
      <table class="user-table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in filteredUsers" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ formatDate(user.birthdate) }}</td>
            <td>{{ user.document }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axiosInstance from '../config/axiosConfig';

export default {
  name: "ListUsers",
  data() {
    return {
      users: [],
      filterName: '',
      filterCPF: '',
    };
  },
  created() {
    this.fetchUsers();
  },
  computed: {
    filteredUsers() {
      return this.users.filter(user => {
        return (
          (!this.filterName || user.name.toLowerCase().includes(this.filterName.toLowerCase())) &&
          (!this.filterCPF || user.document.includes(this.filterCPF))
        );
      });
    }
  },
  methods: {
    fetchUsers() {
      axiosInstance.get('/api/listar')
        .then(response => {
          this.users = response.data;
        })
        .catch(error => {
          console.error('Erro ao buscar usuários:', error);
        });
    },
    applyFilters() {
      this.fetchUsers();
    },
    formatDate(date) {
      const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      return new Date(date).toLocaleDateString('pt-BR', options);
    }
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

.table-wrapper {
  width: 80%;
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  margin-bottom: 20px;
  font-size: 24px;
  font-weight: bold;
}

.filters {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.filters input {
  width: 48%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.user-table {
  width: 100%;
  border-collapse: collapse;
}

.user-table th, .user-table td {
  padding: 12px;
  border: 1px solid #ddd;
  text-align: left;
}

.user-table th {
  background-color: #f4f4f4;
}

.user-table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.user-table tr:hover {
  background-color: #f1f1f1;
}
</style>