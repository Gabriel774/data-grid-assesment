<script setup lang="ts">
import ModalContainer from '../molecules/ModalContainer.vue';
import TextInputFilter from '../atoms/TextInputFilter.vue';
import SelectInputFilter from '../atoms/SelectInputFilter.vue';
import DateInputFilter from '../atoms/DateInputFilter.vue';
import dataGridStore from '@/store/dataGridStore';
import type { Component } from 'vue';

const store = dataGridStore();
const emit = defineEmits('close')

const applyFilters = (): void => {
    store.applyPendingFilters();

    emit('close');
}

const filterComponents: { [key: string]: Component } = {
    text: TextInputFilter,
    select: SelectInputFilter,
    date: DateInputFilter
}

</script>

<template>
    <ModalContainer @out-click="emit('close')">
        <div class="filters-modal">
            <button @click="applyFilters" class="btn">Apply filters</button>

            <div class="input-container">
                <label for="per-page-select">
                    Per page
                </label>

                <select class="inp" :value="store.pendingFilters.per_page || 10"
                    @change="({ target }) => store.setPendingFilters('per_page', target.value)" id="per-page-select">
                    <option value="10">
                        10
                    </option>

                    <option value="25">
                        25
                    </option>

                    <option value="50">
                        50
                    </option>
                </select>
            </div>

            <component v-for="filter in store.filters" v-bind="{ ...filter }" :key="filter.value"
                :is="filterComponents[filter.type] || 'span'" />
        </div>
    </ModalContainer>
</template>

<style>
.filters-modal {
    background-color: #FFF;
    height: 100dvh;
    margin-left: auto;
    animation: enterFromRight .3s ease;
    min-width: 350px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 20px;

    .input-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
        width: 100%;

        label {
            font-size: 14px;
            font-weight: 600;
        }
    }
}
</style>
