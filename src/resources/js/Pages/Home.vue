<script setup>
import NavTemplate from '@/components/templates/NavTemplate.vue'
import InfoIcon from '@/components/atoms/InfoIcon.vue';
defineOptions({ layout: NavTemplate })

</script>

<template>
  <div id="home-screen">

    <h2>
      <InfoIcon size="24" />

      <span>
        Welcome to my technical assesment
      </span>
    </h2>

    <p>
      Hello! This is my technical assessment for Curotec. Thank you for your time — I hope you enjoy reviewing it.
    </p>

    <p>
      In this project, I implemented a dynamic data grid system with filtering and pagination.
    </p>

    <p>
      The backend structure is designed to be dynamic and easily extendable. I used a base repository abstract class,
      and each list is powered by a generator command that makes it effortless to scaffold new endpoints. To add a new
      list, you only need to create a controller and resource to consume the generated structure.
    </p>


    <h3>Some of the features I developed</h3>

    <ul>
      <li>
        Dynamic data grids on the Movies and Users pages, consuming backend list API endpoints.
      </li>

      <li>
        Scheduled jobs and queued workers that automatically generate new users and movies.
      </li>

      <li>
        Comprehensive feature tests to ensure all core functionality works as expected.
      </li>
    </ul>

  </div>
</template>

<style scoped>
#home-screen {
  color: #5f5f5f;

  h2,
  h3 {
    display: flex;
    align-items: center;
    gap: 5px;
    font-weight: 500;
  }
}
</style>
