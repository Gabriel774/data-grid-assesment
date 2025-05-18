<script setup>
import CarretLeft from '../atoms/CarretLeft.vue';
import CarretRight from '../atoms/CarretRight.vue';
import dataGridStore from '@/store/dataGridStore';

const emit = defineEmits(['nextPage', 'previousPage'])
const store = dataGridStore();
</script>

<template>
    <div class="page-controls">
        <button :disabled="store.loading || !store.previousPageUrl" class="btn button-previous-page"
            @click="emit('previousPage')">
            <CarretLeft />

            <span>
                Previous page
            </span>
        </button>

        <button :disabled="store.loading || !store.nextPageUrl" class="btn button-next-page" @click="emit('nextPage')">
            <span>
                Next page
            </span>

            <CarretRight />
        </button>
    </div>
</template>

<style scoped>
.page-controls {
    display: flex;
    align-items: center;
    justify-self: flex-end;

    button {
        padding: 10px;
        font-size: 14px;
        transition: opacity background-color .2s;
        user-select: none;
        font-weight: 600;
        width: 140px;
    }

    button:disabled {
        cursor: not-allowed;
        opacity: .6;
    }

    .button-previous-page {
        border-radius: 10px 0 0 10px;
        background-color: var(--secondary);
    }

    .button-previous-page:hover {
        background-color: var(--secondary-light);
    }

    .button-next-page {
        border-radius: 0 10px 10px 0;
        background-color: var(--primary);
    }

    .button-next-page:hover {
        background-color: var(--primary-light);
    }
}
</style>
