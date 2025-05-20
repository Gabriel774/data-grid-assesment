<script setup lang="ts">
import DataGrid from '@/components/organisms/DataGrid.vue';
import NavTemplate from '@/components/templates/NavTemplate.vue'
import { route } from 'ziggy-js';
import { onMounted } from 'vue'
import dataGridStore from '@/store/dataGridStore';
import DataGridControls from '@/components/organisms/DataGridControls.vue';
const store = dataGridStore();

onMounted((): void => {
  store.setId(props.id);

  store.mapDatafromCache();

  if (!store.currentPageUrl) {
    store.setCurrentPageUrl(route(props.get_data_route))
  }

  store.setFilters(props.filters)
  store.fetchData()
})

defineOptions({ layout: NavTemplate })

const props = defineProps({
  title: { type: String },
  filters: { type: Array },
  table: { type: Object },
  get_data_route: { type: String },
  id: { type: String }
})

</script>

<template>
  <div id="data-grid">
    <h2 id="title">{{ props.title }}</h2>
    <DataGridControls />

    <DataGrid :fields="Object.entries(props.table.fields)" />
  </div>
</template>

<style scoped>
#data-grid {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 20px;

  #title {
    margin-right: auto;
  }
}
</style>
