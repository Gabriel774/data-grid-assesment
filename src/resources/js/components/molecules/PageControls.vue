<script setup>
import CarretLeft from '../atoms/CarretLeft.vue';
import CarretRight from '../atoms/CarretRight.vue';

const emit = defineEmits(['nextPage', 'previousPage'])

</script>

<template>
    <div class="page-controls">
        <button class="button-previous-page" @click="emit('previousPage')">
            <CarretLeft />

            <span>
                Previous page
            </span>
        </button>

        <button class="button-next-page" @click="emit('nextPage')">
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

    button {
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        font-size: 14px;
        border: 0;
        color: #fff;
        cursor: pointer;
        transition: background-color .2s;
        user-select: none;
        font-weight: 600;
        width: 140px;
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
