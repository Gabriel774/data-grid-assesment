<script setup>
import dataGridStore from '@/store/dataGridStore';
import { ref } from 'vue'

const props = defineProps({
    label: {
        type: String,
    },
    placeholder: {
        type: String,
    },
    value: {
        type: String
    }
})

const store = dataGridStore();
const value = ref(store.activeFilters[props.value] || '')
console.log(store.filters)


</script>

<template>
    <div class="input-container">
        <label>{{ props.label }}</label>

        <input :value="value" :placeholder="props.placeholder"
            @input="({ target }) => store.setPendingFilters(props.value, target.value)" class="inp" type="date" />
    </div>
</template>
