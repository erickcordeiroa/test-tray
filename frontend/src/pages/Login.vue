<template>
  <div class="login-container">
    <div class="login-box">
      <!-- Botão do Google -->
      <ButtonGoogle />
    </div>
  </div>
</template>

<script>
import ButtonGoogle from "@/components/ButtonGoogle.vue";

export default {
  name: "Login",
  components: {
    ButtonGoogle,
  }
};
</script>

<style scoped>
.login-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f3f4f6;
}

.login-box {
  width: 100%;
  max-width: 400px;
  padding: 2rem;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>