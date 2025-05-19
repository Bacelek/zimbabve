<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow">
          <div class="card-body">
            <div v-if="form.id" class="mb-3">
              <label for="id" class="form-label">id</label>
              <input :value="form.id" id="id" placeholder="id" class="form-control" disabled>
            </div>

            <div class="mb-3">
              <label for="date" class="form-label">date</label>
              <input v-model="form.date" id="date" placeholder="date" class="form-control" type="date" >
            </div>

            <div class="mb-3">
              <label for="cost" class="form-label">cost</label>
              <input v-model="form.cost" id="cost" placeholder="cost" class="form-control" type="number" >
            </div>

            <div class="mb-3">
              <div>
                <label for="customer_id" class="form-label">customer_id</label>
                <select v-model="form.customer_id" id="customer_id" name="customer_id" class="form-select">
                <option v-for="good in goodList" :key="good.id" :value="good.id">
                  {{ good.id }}
                </option>
              </select>
              </div>
            </div>

            <div class="d-grid gap-2">
              <Btn @click="onClick" :disabled="!isValidForm" theme="primary">Сохранить</Btn>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

</template>

<script>

import {useStore} from "vuex";
import {computed, onBeforeMount, reactive, watchEffect} from "vue";
import {fetchItems} from "@/store/order/selectors.js";
import {selectItemsById} from "@/store/order/selectors.js";
import {selectItems as selectGroups,fetchItems as fetchGroups} from "@/store/customer/selectors.js";
import router from "@/router/index.js";
import Btn from "@/components/Btn/Btn.vue";

export default {
  components: {Btn},
  props: {
    id: {type: String, default: ''},
  },

  setup(props, context) {
    const store = useStore();
    const goodList = computed(() => selectGroups(store))
    const form = reactive({
      id: '',
      date: '',
      cost: '',
      customer_id: ''
    });

    onBeforeMount(() => {
      fetchItems(store);
      fetchGroups(store);
    });

    watchEffect(() => {
      const order = selectItemsById(store, props.id);
      Object.keys(order).forEach((key) => {
        form[key] = order[key];
      })
    })

    return {
      form,
      goodList,
      isValidForm: computed(() => !!(form.date && form.cost !== null && form.customer_id)),
      onClick: () => {
        context.emit("submit", form);
        router.push("/order");
      }
    };
  }
}
</script>


<style scoped>
</style>