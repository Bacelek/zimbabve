<template>
  <Layout title="Order">
    <OrderList/>
  </Layout>

</template>

<script>


import Layout from "@/components/Layout/Layout.vue";
import OrderList from "@/components/OrderList/OrderList.vue";

export default{
  name: "OrderPage",
  components: {Layout, OrderList}
}
</script>

<style scoped>

</style>