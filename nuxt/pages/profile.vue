<template>
  <div class="bg-white shadow p-4 mt-8">
    <nuxt-link
      class="font-bold py-2 px-4 mr-4 rounded"
      :class="{'bg-blue-500 hover:bg-blue-700 text-white': $route.path === '/profile/account'}"
      to="/profile/account"
    >
      Account
    </nuxt-link>
    <nuxt-link
      class="font-bold py-2 px-4 rounded"
      :class="{'bg-blue-500 hover:bg-blue-700 text-white': $route.path === '/profile/information'}"
      to="/profile/information"
    >
      Information
    </nuxt-link>

    <nuxt-child keep-alive/>
  </div>
</template>
