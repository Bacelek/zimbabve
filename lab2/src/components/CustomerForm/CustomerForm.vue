<template>
  <div class="container mt-5 ">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-body">

            <div v-if="form.id" class="mb-3">
              <label for="id" class="form-label">id</label>
              <input :value="form.id" id="id" placeholder="id" class="form-control" disabled readonly/>
            </div>

            <div class="mb-3">
              <label for="image" class="form-label">image</label>

              <div v-if="previewImage" class="input-group mb-2">
                <img :src="previewImage" alt="Preview" class="img-fluid product-image">
              </div>
              <div v-else-if="typeof form.image === 'string' && form.image">
                <img :src="`/images/${form.image}`" alt="Product" class="img-fluid product-image">
              </div>

              <input type="file" class="form-control" @change="handleFileUpload">
            </div>

            <div class="mb-3">
              <label for="name" class="form-label">name</label>
              <input v-model="form.name" id="name" placeholder="name" class="form-control"/>
            </div>

            <div class="mb-3">
              <label for="surname" class="form-label">surname</label>
              <input v-model="form.surname" id="surname" placeholder="surname" class="form-control"/>
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
import {computed, onBeforeMount, reactive, ref, watchEffect} from "vue";
import {fetchItems, selectItemsById} from "@/store/customer/selectors.js";
import router from "@/router/index.js";
import Btn from "@/components/Btn/Btn.vue";

export default {
  components: { Btn },
  props: {
    id: { type: String, default: '' },
  },
  setup(props, { emit }) {
    const store = useStore();

    const form = reactive({
      id: '',
      image: '',
      name: '',
      surname: '',
    });
    const previewImage = ref(null);
    onBeforeMount(() => {
      fetchItems(store);
    });

    watchEffect(() => {
      const good = selectItemsById(store, props.id);
      Object.keys(good).forEach(key => {
        form[key] = good[key];
      });
    });

    const handleFileUpload = (event) => {
      const file = event.target.files[0];
      if (file) {
        form.image = file;
        previewImage.value = URL.createObjectURL(file);
      } else {
        form.image = '';
        previewImage.value = null;
      }
    };


    const isValidForm = computed(() => {
      return Boolean(form.name && form.surname && (form.image));
    });

    const onClick = () => {
      emit("submit", form);
      router.push("/customer");
    };

    return {
      form,
      previewImage,
      handleFileUpload,
      isValidForm,
      onClick
    };
  }
};
</script>

<style scoped>
.product-image {
  max-height: 200px;
}
</style>
