<script setup>
import {ref} from 'vue';
import SideBar from '../components/SideBar.vue';
import RestaurantFilters from '../components/Restaurant/RestaurantFilters.vue';

const isFetching = ref(true);

const queryFormData = ref({
  query: '',
  area: '',
  cuisine: '',
  price: '',
  rating: '',
  sort: '',
  order: '',
});

function setIsFetching(value) {
  isFetching.value = value;
}

</script>


<template>
  <header class="container-fluid bg-app-dark">
      <nav class="container navbar">
        <div class="container-fluid">
          <a class="navbar-brand dine-in-font primary-color">Dine Inc</a>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" v-model="queryFormData.query">
            <button class="btn btn-outline-app-primary me-2 me-lg-0" @click="console.log(queryFormData)" type="button">Search</button>
            <!-- <a class="btn btn-outline-success d-box d-md-none">filter</a> -->
            <a class="btn btn-outline-app-primary d-box d-lg-none" data-bs-toggle="collapse"
              href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              filters
            </a>
          </form>
        </div>
      </nav>
      <div class="collapse container rounded-bottom" id="collapseExample">
        <div class="d-flex flex-column d-lg-none bg-main">
          <div class="row p-3">
            <div class="card">
              <div class="card-header">
                Area of the city
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  </header>
  <main class="container p-3">
    <section v-if="breadcrumbs" class="bg-app-sub-primary rounded p-1">
      <ul class="list-group list-group-horizontal bg-inherit">
        <li v-for="breadcrumb in breadcrumbs" class="list-group-item border-0 bg-inherit">{{ breadcrumb }} ></li>
      </ul>
    </section>
    <section class="d-flex">
      <SideBar>
        <RestaurantFilters :isFetching="isFetching" />
      </SideBar>
      <!-- section content -->
      <!-- <section id="content" class="col bg-theme-color rounded-bottom"> -->
      <section id="content" class="container-fluid my-3 my-lg-0 p-0 py-lg-3">
        <slot />
      </section>
    </section>
  </main>
</template>
