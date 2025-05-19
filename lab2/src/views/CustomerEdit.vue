<template>
    <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
      <CustomerForm :id="id" @submit="onSubmit"/>
    </Layout>
</template>

<script>
import Layout from "@/components/Layout/Layout.vue";
import CustomerForm from "@/components/CustomerForm/CustomerForm.vue";
import {useStore} from "vuex";
import {addItem, updateItem} from "@/store/customer/selectors.js";
export default {
  name: "CustomerEdit",
  props:{ id: String},
  components: {
    Layout,
    CustomerForm,
  },
  setup() {
    const store = useStore()
    return {
      onSubmit:({id,name,surname,image})=> id ?
          updateItem(store,{id,name,surname,image}) :
          addItem(store,{name,surname,image}),
    }
  }
}

</script>
<style scoped>

</style>