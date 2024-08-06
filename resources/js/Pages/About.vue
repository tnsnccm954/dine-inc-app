<script>
import Layout from '@/components/Layout.vue'

export default {
  // Using a render function...
  layout: (h, page) => h(Layout, [page]),

  // Using shorthand syntax...
  layout: Layout,
}
</script>

<script setup>
    defineProps({ user: Object })
</script>

<template>
  <H1>About</H1>
</template>