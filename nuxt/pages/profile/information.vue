<template>
  <div>
    <h3 class="mt-8 text-3xl font-bold">
      Personal information
    </h3>
    <div class="mt-4 flex -mx-4">
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Birth date</label>
        <input
          v-model="userinfo.birth_date"
          type="date"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Mobile</label>
        <input
          v-model="userinfo.phone"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Website</label>
        <input
          v-model="userinfo.website"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
    </div>
    <div class="mt-4 flex -mx-4">
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Language</label>
        <select
          v-model="userinfo.language"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
        >
          <option
            v-for="language in languages"
            :key="language"
            :value="language"
          >
            {{ language }}
          </option>
        </select>
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Gender</label>
        <div>
          <label class="mr-10">
            <input v-model="userinfo.gender" type="radio" :value="true"> Male
          </label>
          <label>
            <input v-model="userinfo.gender" type="radio" :value="false"> Female
          </label>
        </div>
      </div>

      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Gender</label>
        <div>
          <label class="mr-10">
            <input v-model="userinfo.contact_options" type="checkbox" value="Email"> Email
          </label>
          <label class="mr-10">
            <input v-model="userinfo.contact_options" type="checkbox" value="Message"> Message
          </label>
          <label class="mr-10">
            <input v-model="userinfo.contact_options" type="checkbox" value="Phone"> Phone
          </label>
        </div>
      </div>
    </div>

    <h3 class="mt-8 text-3xl font-bold">
      Personal information
    </h3>
    <div class="mt-4 flex -mx-4">
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Address line 1</label>
        <input
          v-model="userinfo.address_line_1"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Address line 2</label>
        <input
          v-model="userinfo.address_line_2"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Postal code</label>
        <input
          v-model="userinfo.postal_code"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
    </div>
    <div class="mt-4 flex -mx-4">
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">City</label>
        <input
          v-model="userinfo.city"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">State</label>
        <input
          v-model="userinfo.state"
          type="text"
          class="border bg-gray-100 py-2 w-full px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded"
          placeholder="Your name"
        />
      </div>
      <div class="w-4/12 px-4">
        <label class="mr-4 text-gray-700 font-bold inline-block mb-2">Country</label>
        <input
          v-model="userinfo.country"
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
import { mapState } from "vuex";

export default {
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
    languages() {
      return [
        'English',
        'Spanish',
        'French',
        'Russian',
        'German',
      ];
    }
  },
  created() {
    this.reset();
  },
  methods: {
    reset() {
      this.userinfo = JSON.parse(JSON.stringify(this.user));
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
