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
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ formatDate(user.birthdate) }}</td>
            <td>{{ user.document }}</td>
          </tr>
        </tbody>
      </table>
      <div class="pagination">
        <button @click="prevPage" :disabled="!pagination.prev_page_url">Anterior</button>
        <span>Página {{ pagination.current_page }} de {{ pagination.last_page }}</span>
        <button @click="nextPage" :disabled="!pagination.next_page_url">Próxima</button>
      </div>
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
      pagination: {
        current_page: 1,
        last_page: 1,
        prev_page_url: null,
        next_page_url: null,
      },
    };
  },
  created() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers(pageUrl = '/api/listar') {
      axiosInstance.get(pageUrl)
        .then(response => {
          this.users = response.data.data;
          this.pagination = {
            current_page: response.data.current_page,
            last_page: response.data.last_page,
            prev_page_url: response.data.prev_page_url,
            next_page_url: response.data.next_page_url,
          };
        })
        .catch(error => {
          console.error('Erro ao buscar usuários:', error);
        });
    },
    applyFilters() {
      const query = [];
      if (this.filterName) query.push(`q=${this.filterName}`);
      if (this.filterCPF) query.push(`q=${this.filterCPF}`);
      const queryString = query.length ? `?${query.join('&')}` : '';
      
      this.fetchUsers(queryString ? `/api/search${queryString}` : '/api/listar');
    },
    formatDate(date) {
      const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      return new Date(date).toLocaleDateString('pt-BR', options);
    },
    prevPage() {
      if (this.pagination.prev_page_url) {
        this.fetchUsers(this.pagination.prev_page_url);
      }
    },
    nextPage() {
      if (this.pagination.next_page_url) {
        this.fetchUsers(this.pagination.next_page_url);
      }
    }
  },
};
</script>

<style scoped>
.container {
  display: flex;
  justify-content: flex-start;
  align-items: flex-start;
  height: 100vh;
  background-color: #f0f0f0;
  padding: 20px;
}

.table-wrapper {
  width: 100%;
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

.pagination {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.pagination button {
  padding: 10px 20px;
  border: none;
  background-color: #007bff;
  color: #fff;
  border-radius: 5px;
  cursor: pointer;
}

.pagination button:disabled {
  background-color: #ddd;
  cursor: not-allowed;
}
</style>