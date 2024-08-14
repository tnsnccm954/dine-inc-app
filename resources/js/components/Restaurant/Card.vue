<script setup>

defineProps({ 
    id: Number,
    name: String,
    description: String,
    picture: {
        type: String,
        default: 'https://via.placeholder.com/150'
    }
});

</script>

<template >
    <a class="card" href="#">
        <img class="img-thumbnail" :src="picture" />
        <div class="card-body">
            <h5 class="card-title text-truncate">{{ name }}</h5>
            <p v-if="description" class="card-text text-truncate">{{ description }}</p>
        </div>
        <!-- <div class="card-footer d-flex flex-column flex-lg-row justify-content-start align-content-center">
            <a href="#" class="btn btn-primary m-1 align-content-center ">Menu</a>
            <a href="#" class="btn btn-primary m-1 align-content-center ">maps</a>
        </div> -->
    </a>
</template>
