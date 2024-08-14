<script setup>
import Layout from '@/layouts/CardViewerLayout.vue'
import RestaurantsList from '@/components/Restaurant/RestaurantsList.vue';
import Spinner from '@/components/Spinner.vue';
import { onMounted, ref } from 'vue'
import { useRestaurants } from '@/composables/Restaurant/restaurant';

const { restaurants, restaurantsRes, getRestaurants } = useRestaurants();
const isLoading = ref(true);

const emit = defineEmits(['update:isLoading']);

const emitIsLoading = (value) => {
  emit('update:isLoading', value);
}

onMounted(() => {
  getRestaurants()
    .then(() => {
      setTimeout(() => {
        isLoading.value = false;
      }, 500)
    })
});
</script>

<template>
  <Layout>
      <div class="container-fluid bg-app-sub-primary rounded p-3">
          <div v-if="isLoading" class="row justify-content-center align-content-center" style="min-height: 300px;">
              <Spinner />
          </div>
          <RestaurantsList v-else :restaurants="restaurants" />
      </div>
  </Layout>
</template>
