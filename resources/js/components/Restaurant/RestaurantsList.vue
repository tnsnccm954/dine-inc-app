<script setup>
import Card from '@/components/Restaurant/Card.vue';
defineProps({
    containerClass: {
        type: String,
        default: 'row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 p-3'
    },
    restaurants: {
        type: Array,
        default: []
    },
});

</script>

<template lang="">
    <div :class="containerClass">
        <div class="col" v-for="restaurant in restaurants">
            <Card :key="restaurant.id" v-bind="restaurant" />
        </div>
    </div>
</template>
