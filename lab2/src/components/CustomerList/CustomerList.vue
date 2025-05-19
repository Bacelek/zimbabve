<template>
  <div class="page p-3" :key="route.params.categoryId">
    <CustomerFilter :items="items" v-model:category="selectedCategory" />

    <div class="table-responsive mt-3">
      <Table
          :headers="[
            {value: 'id', text: 'ID', width: '5%'},
            {value: 'image', text: 'Image'},
            {value: 'name', text: 'Name'},
            {value: 'surname', text: 'surname'},
            {value: 'control', text: 'control'},
        ]"
          :items="items"
      >
        <template v-slot:image="{ item }">
          <img v-if="typeof item.image === 'string'" :src="`${getImageUrl(item.image)}`" alt="Product" class="product-image img-fluid">
        </template>
        <template v-slot:control="{ item }">
          <div class="d-flex flex-wrap justify-content-center">
            <Btn @click="onClickEdit(item.id)" theme="primary" class="me-2 mb-1">Редактировать</Btn>
            <Btn @click="onClickDelete(item.id)" theme="danger" class="mb-1">Удалить</Btn>
          </div>
        </template>
      </Table>
    </div>

    <div class="d-flex justify-content-center mt-3"> 
      <Btn @click="onClickAdd" theme="primary">Добавить</Btn>
    </div>
  </div>
</template>

<script>
import Table from "@/components/Table/Table.vue";
import Btn from "@/components/Btn/Btn.vue";
import {useStore} from "vuex";
import {computed, onMounted, ref, watch} from "vue";
import {fetchItems, removeItem, selectItems} from "@/store/customer/selectors.js";
import router from "@/router/index.js";
import CustomerFilter from "@/components/CustomerFilter/CustomerFilter.vue";
import {useRoute} from "vue-router";

export default {
  name: 'CustomerList',
  components: {CustomerFilter, Table, Btn,Filter: CustomerFilter },
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

    const getImageUrl = (filename) => {
      return `/images/${filename}`;
    };

    watch(selectedCategory,(newCategoryId)  => {
      router.push({
        name: 'customer',
        params: {categoryId: newCategoryId || undefined}
      });
    });
    const onClickEdit = (id) =>{
      router.push(`/customer-edit/${id}`);
    }

    const onClickDelete = (id) =>{
      const isConfirmRemove = confirm('Вы действительно хотите удалить запись?')
      if(isConfirmRemove){
        removeItem(store,id);
      }
    }

    const onClickAdd = () =>{
      router.push(`/customer-edit/`);
    }

    return {
      route,
      getImageUrl,
      items: computed(()=> selectItems(store)),
      selectedCategory,
      onClickEdit,
      onClickDelete,
      onClickAdd
    }
  },
}
</script>

<style scoped>
.product-image {
  max-width: 80px;
  max-height: 80px;
  height: auto;
  display: block;
  margin: 0 auto;
}
</style>