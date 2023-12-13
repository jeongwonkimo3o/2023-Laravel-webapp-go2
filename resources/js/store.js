import { createStore } from 'vuex';

const store = createStore({
  state() {
    return {
      isFileUploaded: false,
      wordTitles: [],
      selectedLanguage: 'EN',
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
    },
    setSelectedLanguage(state, language) {
      state.selectedLanguage = language;
    },
    setWordTitles(state, titles) {
      state.wordTitles = titles;
    },
  },
  actions: {
    setFileUploaded({ commit }, status) {
      commit('SET_FILE_UPLOADED', status);
    },
    setWordTitles({ commit }, wordTitles) {
      commit('SET_WORD_TITLES', wordTitles);
    },
  }
});

export default store;