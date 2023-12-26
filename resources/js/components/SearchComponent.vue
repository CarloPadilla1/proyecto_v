<template>
    <div style="left: 50% ;" class="p-1">
        <div class="select_search_true pb-3 ">
            <form method="GET" @submit.prevent="Search" class=" mt-3">
                <div class="input-group search-style  ">
                    <input
                        type="search"
                        class="form-control search_d"
                        placeholder="Buscar..."
                        aria-label="Search"
                        v-model="search"
            
                    />
                    <button class="btn btn-outline-dark" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
    import {ref, watch} from 'vue';
    const search = ref();
    const emit = defineEmits(['search']);
    // Si el componente que contiene el botón no debe ser accesible para usuarios autenticados
    const Search = async() =>{
        emit('search', search.value);
    };
     // Observa cambios en la variable search
    watch(search, (newVal, oldVal) => {
        // Realiza la búsqueda cada vez que search cambie
        // Puedes llamar a la función de búsqueda aquí
        // Llama a tu función de búsqueda aquí
        emit('search', newVal);
    });
</script>
<style scoped>
    .search-style {
    box-sizing: border-box;
    }
    .search_d{
        border: 3px solid pink;   
    }
</style>