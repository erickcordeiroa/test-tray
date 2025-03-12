<template>
  <div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
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
