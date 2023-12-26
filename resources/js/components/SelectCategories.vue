
<template>
  <div class="container-fluid ">
    <div class="row">
      <div class="col-auto pt-3 pb-2 ">
        <select
          class="form-select ms-0 select_d"
          v-model="selectedCategories"
          @change="emitFilterCategory"
        >
          <option value="" disabled>Filtrar por categoría</option>
          <option
            v-for="category in categories"
            :key="category.id_category"
            :value="category.name_category"
          >
            {{ category.name_category }}
          </option>
        </select>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted, ref, watch, defineEmits } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const emit = defineEmits(['filter_category']);
const categories = computed(() => store.getters['categories/getCategories']);
const selectedCategories = ref();

onMounted(async () => {
  await store.dispatch('categories/getCategories');
});

// Watcher para detectar cambios en la categoría seleccionada
watch(selectedCategories, (newValues, oldValues) => {
  if (newValues !== oldValues) {
    emitFilterCategory();
  }
});

// Método para emitir el evento filter_category con el array de name_category
const emitFilterCategory = () => {
  emit('filter_category', selectedCategories.value);
};
</script>
