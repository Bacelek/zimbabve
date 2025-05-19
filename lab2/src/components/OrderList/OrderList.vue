<template>
  <div class="page" :key="route.params.categoryId">
   <OrderFilter :items="items" v-model:category="selectedCategory" />
    <Table
        :headers="[
          {value: 'id', text: 'ID'},
          {value: 'date', text: 'date'},
          {value: 'cost', text: 'cost'},
          {value: 'customer_id', text: 'customer_id'},
          {value: 'control', text: 'control'},
      ]"
        :items="items"
    >
      <template v-slot:control="{ item }">
        <Btn @click=onClickEdit(item.id) theme="primary" class="me-2">редактировать</Btn>
        <Btn @click=onClickDelete(item.id) theme="danger">Удалить</Btn>
      </template>
    </Table>
    <div class="d-flex justify-content-center">
      <Btn @click="onClickAdd" theme="primary" >Добавить</Btn>
    </div>
  </div>
</template>

<script>

import {useStore} from "vuex";
import {computed, onMounted, ref, watch} from "vue";
import {fetchItems, removeItem, selectItems} from "@/store/order/selectors.js";
import router from "@/router/index.js";
import Btn from "@/components/Btn/Btn.vue";
import Table from "@/components/Table/Table.vue";
import {useRoute} from "vue-router";
import OrderFilter from "@/components/OrderFilter/OrderFilter.vue";

export default {
  name: 'OrderList',
  components: {OrderFilter, Table, Btn},
  setup() {
    const route = useRoute();
    const store = useStore();
    const selectedCategory = ref(route.params.categoryId || '');

    onMounted(()=>{
      fetchItems(store,route.params.categoryId);
    });

    watch(
        ()=> route.params.categoryId,
        (newCategoryId) => {
          selectedCategory.value = newCategoryId || '';
          fetchItems(store,newCategoryId);
        }
    );

    watch(selectedCategory,(newCategoryId)  => {
      router.push({
        name: 'order',
        params: {categoryId: newCategoryId || undefined}
      });
    });

    const onClickEdit = (id) =>{
      router.push(`/order-edit/${id}`);
    }

    const onClickDelete = (id) =>{
      const isConfirmRemove = confirm('Вы действительно хотите удалить запись?')
      if(isConfirmRemove){
        removeItem(store,id);
      }
    }

    const onClickAdd = () =>{
      router.push(`/order-edit/`);
    }

    return {
      route,
      selectedCategory,
      items: computed(()=> selectItems(store)),
      onClickEdit,
      onClickDelete,
      onClickAdd
    }
  }
}
</script>

<style scoped>

</style>