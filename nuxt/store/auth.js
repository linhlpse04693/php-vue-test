import Cookie from 'js-cookie';

export const state = () => ({
  user: null,
  loggedIn: false,
  token: '',
  refreshTask: null,
  tokenExpiredIn: 0,
});

export const actions = {
  async login({ commit, dispatch }, { credentials, remember }) {
    try {
      const {
        user,
        access_token: accessToken,
        expires_in: expiresIn,
        user: { remember_token: refreshToken }
      } = await this.$axios.post('/api/v1/auth/login', credentials);

      commit('SET_USER', user);
      commit('SET_TOKEN', accessToken);
      commit('SET_TOKEN_EXPIRED_IN', expiresIn);
      Cookie.set('accessToken', accessToken, {
        sameSite: 'None',
        secure: true,
        expires: (expiresIn / 3600) / 24,
      });

      if (remember) {
        Cookie.set('refreshToken', refreshToken, {
          expires: 30,
        });
      }

      const timeUntilRefresh = expiresIn * 1000 - 5 * 60 * 1000;
      const task = setInterval(() => dispatch('refresh'), timeUntilRefresh);
      commit('SET_REFRESH_TASK', task);
    } catch (e) {
      Cookie.remove('refreshToken');

      return Promise.reject(e);
    }
  },

  async loginWithRefreshToken({ commit, dispatch }, refreshToken) {
    try {
      const {
        user,
        access_token: accessToken,
        expires_in: expiresIn,
      } = await this.$axios.post('/api/v1/auth/login-with-remember-token', {
        refresh_token: refreshToken
      });

      commit('SET_USER', user);
      commit('SET_TOKEN', accessToken);
      commit('SET_TOKEN_EXPIRED_IN', expiresIn);

      Cookie.set('accessToken', accessToken, {
        sameSite: 'None',
        secure: true,
        expires: (expiresIn / 3600) / 24,
      });

      const timeUntilRefresh = expiresIn * 1000 - 5 * 60 * 1000;
      commit('SET_TIME_UNTIL_REFRESH', timeUntilRefresh);
    } catch (e) {
      Cookie.remove('accessToken');
      Cookie.remove('refreshToken');
    }
  },

  logout({ commit, state }) {
    commit('SET_USER', null);
    commit('SET_TOKEN', '');
    clearInterval(state.refreshTask);
    Cookie.remove('accessToken');
    Cookie.remove('refreshToken');
  },

  async refresh({ commit, dispatch }) {
    try {
      const {
        user,
        access_token: accessToken,
        expires_in: expiresIn,
      } = await this.$axios.post('/api/v1/auth/refresh');

      commit('SET_USER', user);
      commit('SET_TOKEN', accessToken);
      commit('SET_TOKEN_EXPIRED_IN', expiresIn);

      Cookie.set('accessToken', accessToken, {
        sameSite: 'None',
        secure: true,
        expires: (expiresIn / 3600) / 24,
      });

      const timeUntilRefresh = expiresIn * 1000 - 5 * 60 * 1000;
      commit('SET_TIME_UNTIL_REFRESH', timeUntilRefresh);
    } catch (e) {
      dispatch('logout');
    }
  }
};

export const mutations = {
  SET_TOKEN(state, token) {
    state.token = token;
  },

  SET_TOKEN_EXPIRED_IN(state, tokenExpiredIn) {
    state.tokenExpiredIn = tokenExpiredIn;
  },

  SET_USER(state, user) {
    state.user = user;
  },

  SET_REFRESH_TASK(state, task) {
    state.refreshTask = task;
  },

  SET_TIME_UNTIL_REFRESH(state, timeUntilRefresh) {
    state.timeUntilRefresh = timeUntilRefresh;
  }
};
