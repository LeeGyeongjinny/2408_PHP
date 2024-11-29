import { createStore } from 'vuex';
import board from './modules/board';

export default createStore({
    modules: {
        board,
    }
})