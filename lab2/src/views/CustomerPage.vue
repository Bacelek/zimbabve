<template>
  <Layout title="Customer">
    <CustomerList/>
  </Layout>
</template>

<script>
import Layout from "@/components/Layout/Layout.vue";
import CustomerList from "@/components/CustomerList/CustomerList.vue";
import CustomerFilter from "@/components/CustomerFilter/CustomerFilter.vue";

export default{
  name: "CustomerPage",
  components: {CustomerFilter: CustomerFilter, Layout, CustomerList}
}
</script>

<style scoped>

</style>