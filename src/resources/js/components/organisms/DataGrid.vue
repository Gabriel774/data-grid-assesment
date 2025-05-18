<script setup lang="ts">
import dataGridStore from '@/store/dataGridStore';

const props = defineProps({ columns: { type: Array }, fields: { type: Array }, data: { type: Array } })

const store = dataGridStore();
</script>

<template>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th v-for="(column) in props.columns" :key="column">
                        <span>
                            {{ column }}
                        </span>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(register, index) in store.data" :key="index">
                    <td v-for="(field, index) in props.fields" :key="index">
                        {{ register[field] }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>
.table-container {
    border-radius: 12px;
    overflow-y: auto;
    max-width: 100%;
    
    table {
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
        span {
            cursor: pointer;
        }
    }
}
</style>
