<script setup lang="ts">
import dataGridStore from '@/store/dataGridStore';
import Skeleton from '../atoms/Skeleton.vue';

const props = defineProps({ columns: { type: Array }, fields: { type: Array }, data: { type: Array } })

const store = dataGridStore();
</script>

<template>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th v-for="(column) in props.columns" :key="column">
                        {{ column }}
                    </th>
                </tr>
            </thead>

            <tbody>
                <template v-if="!store.loading">
                    <tr v-for="(register, index) in store.data" :key="index">
                        <td v-for="(field, index) in props.fields" :key="index">
                            {{ register[field] }}
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr v-for="(index) in 15" :key="index">
                        <td v-for="(field, index) in props.fields" :key="index">
                            <Skeleton :width="120" :height="20" />
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<style scoped>
.table-container {
    border-radius: 12px;
    overflow-y: auto;
    width: 100%;

    table {
        width: 100%;
        color: #FFF;
        border-collapse: collapse;
        border-spacing: 0;
        min-width: 1300px;
    }

    th,
    td {
        text-align: left;
        padding: 15px 20px;
    }

    tr {
        background-color: var(--primary);

    }

    tbody {
        tr:nth-child(odd) {
            background-color: var(--secondary);
        }
    }

    th {
        cursor: pointer;
    }
}
</style>
