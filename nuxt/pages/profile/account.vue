<template>
  <div class="mt-8">
    <div class="flex">
      <div class="w-32 h-32">
        <img class="w-32 h-32" :src="userinfo.avatar">
      </div>
      <div class="ml-4">
        <h4 class="text-2xl font-semibold">{{ userinfo.name }}</h4>
        <div>
          <label
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4 cursor-pointer"
          >
            Update
            <input
              ref="avatar"
              type="file"
              accept="image/png, image/jpeg"
              class="hidden"
              @change="updateAvatar"
            >
          </label>
          <button
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
            @click="removeAvatar"
          >
            Remove
          </button>
        </div>
      </div>
    </div>

    <div class="mt-4 flex -mx-4">
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Username</label>
        <input
          v-model="userinfo.username"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Name</label>
        <input
          v-model="userinfo.name"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Email</label>
        <input
          v-model="userinfo.email"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
    </div>
    <div class="mt-4 flex -mx-4">
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Status</label>
        <select
          v-model="userinfo.status.id"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
        >
          <option
            v-for="status in statuses"
            :key="status.id"
            :value="status.id"
          >
            {{ status.name }}
          </option>
        </select>
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Role</label>
        <select
          v-model="userinfo.role.id"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
        >
          <option
            v-for="role in roles"
            :key="role.id"
            :value="role.id"
          >
            {{ role.name }}
          </option>
        </select>
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Company</label>
        <input
          v-model="userinfo.company"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
    </div>

    <div class="mt-8">
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4"
        @click="fakeUpdate"
      >
        Save change
      </button>
      <button
        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
        @click="reset"
      >
        Reset
      </button>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  async asyncData({ store: { state, dispatch }, error }) {
    try {
      if (!state.role.roles.length) {
        await dispatch('role/fetchRoles');
      }
      if (!state.status.statuses.length) {
        await dispatch('status/fetchStatuses');
      }
    } catch (e) {
      error({ statusCode: 500 });
    }
  },
  data: () => ({
    userinfo: {
      name: null,
      username: null,
      email: null,
      status: null,
      role: null,
      company: null,
      avatar: null,
    },
  }),
  computed: {
    ...mapState('auth', {
      user: state => state.user,
    }),
    ...mapState('role', {
      roles: state => state.roles,
    }),
    ...mapState('status', {
      statuses: state => state.statuses,
    }),
  },
  created() {
    this.reset();
  },
  methods: {
    reset() {
      this.userinfo = JSON.parse(JSON.stringify(this.user));
    },
    removeAvatar() {
      this.userinfo.avatar = null;
    },
    updateAvatar(e) {
      const file = e.target.files[0];
      this.userinfo.avatar = URL.createObjectURL(file);
    },
    async fakeUpdate() {
      try {
        await this.$store.dispatch('user/updateUser', {
          id: this.user.id,
          payload: {},
        });
        alert('update success');
      } catch (e) {
        alert('error');
      }
    },
  }
}
</script>
