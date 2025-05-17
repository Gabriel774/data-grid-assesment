<script lang="ts" setup>
import NavLink from '../atoms/NavLink.vue';
import { Link } from '@inertiajs/inertia-vue3'
import UserIcon from '../atoms/UserIcon.vue';

</script>

<template>
    <nav id="nav-bar">
        <Link href="/">
        <img src="https://www.curotec.com/wp-content/uploads/2023/06/Curotec-Logo.svg" alt="Curotec" width="120" />
        </Link>

        <div class="nav-link-container">
            <NavLink label="Movies" link="/movies" />

            <NavLink label="Users" link="/users" />
        </div>

        <UserIcon />
    </nav>
</template>

<style scoped>
#nav-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px 10%;
    box-shadow: 0px 0px 33px 0px rgba(34, 44, 71, 0.1);

    img {
        user-select: none;
    }

    .nav-link-container {
        display: flex;
        gap: 15px;
    }
}
</style>