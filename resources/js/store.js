import { createStore } from 'vuex';

const store = createStore({
  state() {
    return {
      isFileUploaded: false,
      wordTitles: [],
      wordAddModal: false,
    };
  },
  mutations: {
    SET_FILE_UPLOADED(state, status) {
      state.isFileUploaded = status;
    },
    SET_WORD_TITLES(state, wordTitles) {
      state.wordTitles = wordTitles;
    },
    toggleWordAddModal(state) {
      state.wordAddModal = !state.wordAddModal;
    }
  },
  actions: {
    setFileUploaded({ commit }, status) {
      commit('SET_FILE_UPLOADED', status);
    },
    setWordTitles({ commit }, wordTitles) {
      commit('SET_WORD_TITLES', wordTitles);
    }
  }
});

export default store;