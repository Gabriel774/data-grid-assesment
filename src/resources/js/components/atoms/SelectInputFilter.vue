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
    },
    extra_data: {
        type: Object
    }
})

const store = dataGridStore();
const value = ref(store.pendingFilters[props.value] || '');
</script>

<template>
    <div class="input-container">
        <label>{{ props.label }}</label>

        <select :value="value" @change="({ target }) => store.setPendingFilters(props.value, target.value)" class="inp">
            <option disabled value="">{{ props.placeholder }}</option>

            <option v-for="(value, index) in props.extra_data.options" :value="value.toLowerCase()">{{ value }}</option>
        </select>
    </div>
</template>
