<template>
  <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
    <OrderForm :id="id" @submit="onSubmit"/>
  </Layout>
</template>

<script>
import Layout from "@/components/Layout/Layout.vue";
import OrderForm from "@/components/OrderForm/OrderForm.vue";
import {useStore} from "vuex";
import {addItem, updateItem} from "@/store/order/selectors.js";

export default {
  name: "OrderEdit",
  props:{ id: String},
  components: {
    Layout,
    OrderForm,
  },
  setup() {
    const store = useStore()
    return {
      onSubmit:({id,customer_name,customer_surname,customer_id})=> id ?
          updateItem(store,{id,customer_name,customer_surname,customer_id}) :
          addItem(store,{customer_name,customer_surname,customer_id}),
    }
  }
}
</script>


<style scoped>
</style>