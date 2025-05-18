<script setup>
import DataGrid from '@/components/organisms/DataGrid.vue';
import NavTemplate from '@/components/templates/NavTemplate.vue'
import { route } from 'ziggy-js';
import { onMounted, ref } from 'vue'
import dataGridStore from '@/store/dataGridStore';
import DataGridControls from '@/components/organisms/DataGridControls.vue';
const store = dataGridStore();

onMounted(async () => {
  store.fetchData(route('api.movies.list'))
})

defineOptions({ layout: NavTemplate })

const props = defineProps({
  title: { type: String },
  filters: { type: Array },
  table: { type: Object }
})

</script>

<template>
  <div id="data-grid">
    <DataGridControls/>

    <DataGrid :columns="Object.values(props.table.fields)" :fields="Object.keys(props.table.fields)" />
  </div>
</template>

<style scoped>
#data-grid {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 20px;
}
</style>
