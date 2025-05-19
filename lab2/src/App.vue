<template>
  <div class="d-flex flex-column m-5 pb-5" >
    <nav class="navbar navbar-light bg-light fixed-top justify-content-center">
      <div class="container-fluid d-flex justify-content-center">
        <router-link to="/order" class="btn btn-outline-primary">Заказ</router-link> |
        <router-link to="/customer" class="btn btn-outline-success">Покупатель</router-link>
      </div>
    </nav>
      <div class="d-flex justify-content-center">
        <router-view/>
      </div>
  </div>
</template>

<style>
</style>
<script>
</script>