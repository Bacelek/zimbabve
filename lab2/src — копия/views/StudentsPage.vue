<template>
  <Layout title="Студенты">
    <StudentList />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout.vue';
import StudentList from '@/components/StudentList/StudentList.vue';

export default {
  name: 'Students',
  components: {
    Layout,
    StudentList,
  }
}
</script>
