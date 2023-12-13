import { createRouter, createWebHistory } from 'vue-router';
import WordDetail from '../Pages/WordDetail.vue';
import Word from '../Pages/Word.vue';
import Upload from '../Pages/Upload.vue';
import Store from '../Pages/Store.vue';

const router = createRouter({
    history : createWebHistory(),
    routes : [
      {
        path: '/word',
        component: Word
      },
      {
        path: '/upload',
        component: Upload
      },
      {
        path: '/store',
        component: Store
      },
      {
        path: '/worddetail/:id',
        component: WordDetail
      }
    ]
});

export default router;
