<template>
  <select v-model="internalCategory" @change="handleChange" >
    <option value="">All</option>
    <option v-for="item in filteredItems" :key="item.customer_id" :value="item.customer_id" >{{ item.customer_id }}</option>
  </select>
  <!-- <div v-if="internalCategory" class="filter-message">
    Фильтр: {{ items[0].customer_id }}
  </div> -->
</template>

<script>

import {computed, ref, watch} from "vue";

export default {
  props: ['items', 'category'],
  setup(props, { emit }) {
    const internalCategory = ref(props.category);

    const filteredItems = computed(() => {
      const seen = new Set();
      return props.items.filter(item => {
        const id = item.customer_id;
        if (!seen.has(id)) {
          seen.add(id);
          return true;
        }
        return false;
      });
    });

    watch(() => props.category, (newVal) => {
      internalCategory.value = newVal;
    });

    const handleChange = () => {
      emit('update:category', internalCategory.value);
    };

    return { internalCategory, handleChange,filteredItems};
  }
}
</script>
