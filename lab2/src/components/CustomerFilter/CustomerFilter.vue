<template>
  <select v-model="internalCategory" @change="handleChange" >
    <option value="">All</option>
    <option v-for="item in filteredItems" :key="item.name" :value="item.name" >{{ item.name }}</option>
  </select>
</template>

<script>

import {computed, onBeforeUnmount, ref, watch} from "vue";

export default {
  props: ['items', 'category'],
  setup(props, { emit }) {
    const internalCategory = ref(props.category);

    watch(() => props.category, (newVal) => {
      internalCategory.value = newVal;
    });

    const filteredItems = computed(() => {
      const seen = new Set();
      return props.items.filter(item => {
        const name = item.name;
        if (!seen.has(name)) {
          seen.add(name);
          return true;
        }
        return false;
      });
    });

    const handleChange = () => {
        emit('update:category', internalCategory.value);
    };

    return { internalCategory, handleChange,filteredItems};
  }
}
</script>
