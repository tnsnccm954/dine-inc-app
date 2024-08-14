
<script setup>
defineProps({
    isFetching:Boolean
});
</script>
<template>
    <div class="row">
          <h5>Filters</h5>
        </div>
        <div class="row gy-3 mb-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                Area of the city
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <select class="form-select">
                    <option selected>เลือก...</option>
                    <option value="2">กทม.2</option>
                    <option value="3">กทม.3</option>
                    <option value="4">กทม.4</option>
                  </select>
                </li>
                <li class="list-group-item">
                  <select class="form-select">
                    <option selected>เลือก...</option>
                    <option value="2">กทม.2</option>
                    <option value="3">กทม.3</option>
                    <option value="4">กทม.4</option>
                  </select>
                </li>
                <li class="list-group-item">
                  <select class="form-select">
                    <option selected>เลือก...</option>
                    <option value="2">กทม.2</option>
                    <option value="3">กทม.3</option>
                    <option value="4">กทม.4</option>
                  </select>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                FoodType
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <select class="form-select" multiple>
                    <option selected>เลือก...</option>
                    <option value="2">กทม.2</option>
                    <option value="3">กทม.3</option>
                    <option value="4">กทม.4</option>
                  </select>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-12 p-3">
            <div class="card outline-secondary row g-3 p-3">
              <button :class="[isFetching ? 'disabled' : 'btn-disable', 'btn btn-outline-primary']" :disabled="isFetching">apply filter</button>
              <button class="btn btn-outline-warning " :disabled="isFetching" >clear filter</button>
            </div>
          </div>
        </div>
</template>