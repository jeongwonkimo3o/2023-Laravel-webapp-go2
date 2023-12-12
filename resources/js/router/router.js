import { createRouter, createWebHistory } from 'vue-router';
import WordsTable from '../components/WordsTable.vue';

const router = createRouter({
    history : createWebHistory(),
    routes : [
      {
        path: '/worddetail/:id',
        component: WordsTable
      }
    ]
});

export default router;
