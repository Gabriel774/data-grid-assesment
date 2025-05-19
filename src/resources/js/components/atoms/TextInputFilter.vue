<script setup>
import dataGridStore from '@/store/dataGridStore';
import { computed } from 'vue'

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
const value = computed(() => store.activeFilters[props.value] || null)
</script>

<template>
    <div class="input-container">
        <label>{{ props.label }}</label>

        <input :value="value" :placeholder="props.placeholder"
            @input="({ target }) => store.setPendingFilters(props.value, target.value)" class="inp" type="text" />
    </div>
</template>
