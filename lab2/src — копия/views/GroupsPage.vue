<template>
  <Layout title="Группы">
    <GroupList />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout.vue';
import GroupList from '@/components/GroupList/GroupList.vue';

export default {
  name: 'GroupsPage',
  components: {
    Layout,
    GroupList,
  }
}
</script>
