<script lang="ts" setup>
import NavLink from '../atoms/NavLink.vue';
import { Link } from '@inertiajs/inertia-vue3'
import UserIcon from '../atoms/UserIcon.vue';
import { route } from 'ziggy-js';
</script>

<template>
    <nav id="nav-bar">
        <div class="container">
            <Link class="logo-container" :href="route('home')">
            <img src="https://www.curotec.com/wp-content/uploads/2023/06/Curotec-Logo.svg" alt="Curotec" width="120" />
            </Link>

            <div class="nav-link-container">
                <NavLink label="Home" :link="route('home')" />

                <NavLink label="Movies" :link="route('movies.list')" />

                <NavLink label="Users" :link="route('user.list')" />
            </div>

            <div class="nav-user">
                <UserIcon />
            </div>
        </div>
    </nav>
</template>

<style scoped>
#nav-bar {
    box-shadow: 0px 0px 33px 0px rgba(34, 44, 71, 0.1);

    .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 25px 10%;
        max-width: 1440px;
        margin: auto;

        .logo-container {
            width: 100%;
            display: flex;
            justify-content: flex-start;

            img {
                user-select: none;
                display: block;
            }
        }

        .nav-link-container {
            width: 100%;
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .nav-user {
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }
    }
}
</style>
